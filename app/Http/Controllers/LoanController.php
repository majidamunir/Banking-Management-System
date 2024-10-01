<?php

//namespace App\Http\Controllers;
//
//use App\Events\LoanRequested;
//use App\Mail\LoanApprovedMail;
//use App\Models\Loan;
//use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Mail;
//
//class LoanController extends Controller
//{
//    public function index()
//    {
//        $loans = Loan::with('user')->get();
//        return view('Admin.loan.index', compact('loans'));
//    }
//
//    public function create()
//    {
//        $users = User::all();
//        return view('Admin.loan.create', compact('users'));
//    }
//
//    public function store(Request $request)
//    {
//        $request->validate([
//            'user_id' => 'required|exists:users,id',
//            'amount' => 'required|numeric|min:0',
//            'interest_rate' => 'required|numeric|min:0|max:100',
//            'start_date' => 'required|date',
//            'end_date' => 'required|date|after:start_date',
//        ]);
//
//        $loan = Loan::create($request->all());
//
//        $user = $loan->user;
//        Mail::to($user->email)->send(new LoanApprovedMail($loan));
//
//        return redirect()->route('loans.index')
//            ->with('success', 'Loan Created Successfully and Email Sended!!!');
//    }
//
//    public function show(Loan $loan)
//    {
//        return view('Admin.loan.view', compact('loan'));
//    }
//
//    public function edit(Loan $loan)
//    {
//        $users = User::all();
//        return view('Admin.loan.edit', compact('loan', 'users'));
//    }
//
//    public function update(Request $request, Loan $loan)
//    {
//        $request->validate([
//            'user_id' => 'required|exists:users,id',
//            'amount' => 'required|numeric|min:0',
//            'interest_rate' => 'required|numeric|min:0|max:100',
//            'start_date' => 'required|date',
//            'end_date' => 'required|date|after:start_date',
//        ]);
//
//        $loan->update($request->all());
//        return redirect()->route('loans.index')
//            ->with('success', 'Loan Updated Successfully!');
//    }
//
//    public function destroy(Loan $loan)
//    {
//        $loan->delete();
//
//        return redirect()->route('loans.index')
//            ->with('success', 'Loan Deleted successfully!');
//    }
//
//    public function loanForm()
//    {
//        return view('Admin.loan.requestForm');
//    }
//
//    public function requestLoan(Request $request)
//    {
//        $request->validate([
//            'user_id' => 'required|exists:users,id',
//            'amount' => 'required|numeric|min:0',
//            'interest_rate' => 'nullable|numeric|min:0|max:100',
//            'start_date' => 'nullable|date',
//            'end_date' => 'nullable|date|after:start_date',
//        ]);
//
//        $loan = Loan::create([
//            'user_id' => $request->input('user_id'),
//            'amount' => $request->input('amount'),
//            'interest_rate' => $request->input('interest_rate', 0),
//            'start_date' => $request->input('start_date'),
//            'end_date' => $request->input('end_date'),
//            'status' => 'pending',
//        ]);
//
//        event(new LoanRequested($loan));
//        return redirect()->route('Home')
//            ->with('success', 'Loan Request Sent Successfully!');
//    }
//
//    public function view($id)
//    {
//        $loan = Loan::findOrFail($id);
//        return view('Admin.loan.requestFormDetail', compact('loan'));
//    }
//}

namespace App\Http\Controllers;

use App\Events\LoanApprovedEvent;
use App\Events\LoanRejected;
use App\Events\LoanRequested;
//use App\Mail\LoanApprovedMail;
//use App\Mail\LoanRejectionMail;
use App\Models\BankAccount;
use App\Models\Loan;
//use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Mail;


class LoanController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                $loans = Loan::with('user')->get();
            } else {
                $loans = Loan::with('user')
                    ->where('user_id', $user->id)
                    ->whereIn('status', ['approved', 'rejected'])
                    ->get();
            }

            return view('Admin.loan.index', compact('loans'));
        } else {
            return redirect()->route('login')
                ->with('error', 'You need to be logged in to view loans.');
        }
    }

//    public function index()
//    {
//        $loans = Loan::with('user')->get();
//        return view('Admin.loan.index', compact('loans'));
//    }

    public function show(Loan $loan)
    {
        return view('Admin.loan.view', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        return view('Admin.loan.edit', compact('loan'));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
            'bank_account_id' => 'nullable|exists:bank_accounts,id',
        ]);

        $status = $request->input('status');
        $loan->status = $status;

        if ($status === 'approved') {
            $bankAccountId = $request->input('bank_account_id');
            if ($bankAccountId) {
                $bankAccount = BankAccount::find($bankAccountId);
                if ($bankAccount) {
                    $loanAmount = $loan->amount;
                    $bankAccount->balance -= $loanAmount;
                    $bankAccount->disbursed_amount += $loanAmount;
                    $bankAccount->save();
                }
            }

            event(new LoanApprovedEvent($loan));
        } elseif ($status === 'rejected') {
            event(new LoanRejected($loan));
        }

        $loan->save();

        return redirect()->route('loans.index')
            ->with('success', 'Loan status updated successfully!');
    }

//    public function update(Request $request, Loan $loan)
//    {
//        $request->validate([
//            'status' => 'required|in:approved,rejected,pending',
//        ]);
//
//        $status = $request->input('status');
//
//        $loan->status = $status;
//        $loan->save();
//
//        if ($status === 'approved') {
////            Mail::to($loan->user->email)->send(new LoanApprovedMail($loan));
//            event(new LoanApprovedEvent($loan));
//        } elseif ($status === 'rejected') {
////            Mail::to($loan->user->email)->send(new LoanRejectionMail($loan));
//            event(new LoanRejected($loan));
//        }
//
//        return redirect()->route('loans.index')
//            ->with('success', 'Loan status updated successfully!');
//    }

    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Loan deleted successfully!');
    }

    public function loanForm()
    {
        return view('Admin.loan.requestForm');
    }

    public function requestLoan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:100|max:5000',
            'interest_rate' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'required|date|date_equals:today',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $loan = Loan::create([
            'user_id' => $request->input('user_id'),
            'amount' => $request->input('amount'),
            'interest_rate' => $request->input('interest_rate', 0),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => 'pending',
        ]);

        event(new LoanRequested($loan));

        return redirect()->route('Home')
            ->with('success', 'Loan request sent successfully!');
    }

//    public function view($id)
//    {
//        $loan = Loan::findOrFail($id);
//        return view('Admin.loan.requestFormDetail', compact('loan'));
//    }

    public function view($id)
    {
        $loan = Loan::findOrFail($id);
        $bankAccounts = BankAccount::all(); // Get all bank accounts
        return view('Admin.loan.requestFormDetail', compact('loan', 'bankAccounts'));
    }
}
