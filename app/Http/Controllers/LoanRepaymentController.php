<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoanRepaymentController extends Controller
{
    public function index()
    {
        $repayments = LoanRepayment::whereHas('loan', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('loan')->get();

        $loans = Loan::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->get();

        $bankAccount = BankAccount::first();
        return view('Loan-Repay.index', compact('repayments', 'loans', 'bankAccount'));
    }

//    public function create()
//    {
//        $loans = Loan::where('user_id', auth()->id())
//            ->where('status', 'approved')
//            ->get();
//
//        $bankAccount = BankAccount::first();
//        return view('Loan-Repay.create', compact('loans', 'bankAccount'));
//    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric|min:0',
            'repayment_date' => 'required|date',
            'bank_account_id' => 'required|exists:bank_accounts,id',
        ]);

        $loan = Loan::findOrFail($validated['loan_id']);
        $repaymentAmount = $validated['amount'];
        $repaymentDate = Carbon::parse($validated['repayment_date']);
        $bankAccount = BankAccount::findOrFail($validated['bank_account_id']);

        if ($repaymentAmount <= 0) {
            return redirect()->back()->with('error', 'Invalid Repayment Amount!!!');
        }

        $dueDate = Carbon::parse($loan->end_date);
        $isLate = $repaymentDate->greaterThan($dueDate);

        $interestRate = $loan->interest_rate;
        $interestAmount = $isLate ? $repaymentAmount * ($interestRate / 100) : 0;
        $totalRepaymentAmount = $repaymentAmount + $interestAmount;

        DB::transaction(function () use ($loan, $repaymentAmount, $repaymentDate, $bankAccount, $totalRepaymentAmount, $isLate, $interestAmount) {
            if ($repaymentAmount >= $loan->amount) {
                $repaymentAmount = $loan->amount;
                $loan->amount = 0;
                $repaymentStatus = 'paid';
                $totalRepaymentAmount = $repaymentAmount + $interestAmount;
            } else {
                $loan->amount -= $repaymentAmount;
                $repaymentStatus = 'pending';
                $totalRepaymentAmount = $repaymentAmount + $interestAmount;
            }

            $bankAccount->balance += $totalRepaymentAmount;

            if ($bankAccount->disbursed_amount > $repaymentAmount) {
                $bankAccount->disbursed_amount -= $repaymentAmount;
            } else {
                $bankAccount->disbursed_amount = 0;
            }

            $bankAccount->returned_amount += $totalRepaymentAmount;
            if ($isLate) {
                $bankAccount->interest_rate = $interestAmount;
            } else {
                $bankAccount->interest_rate = null;
            }

            LoanRepayment::updateOrCreate(
                ['loan_id' => $loan->id, 'repayment_date' => $repaymentDate],
                [
                    'amount' => $repaymentAmount,
                    'status' => $repaymentStatus,
                    'interest_rate' => $interestAmount,
                ]
            );

            $loan->save();
            $bankAccount->save();
        });

        return redirect()->route('loan-repayments.index')
            ->with('success', 'Repayment Recorded and Bank Account Updated Successfully!!!');
    }

    public function show(LoanRepayment $loanRepayment)
    {
        return view('Loan-Repay.show', compact('loanRepayment'));
    }
}
