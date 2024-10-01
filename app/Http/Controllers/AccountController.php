<?php

namespace App\Http\Controllers;

use App\Events\AccountCreationRequested;
use App\Mail\AccountActivated;
use App\Mail\AccountDeactivated;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                $accounts = Account::with('user')->get();
            } else {
                $accounts = Account::with('user')
                    ->where('user_id', Auth::id())
                    ->where('status', '!=', 'pending')
                    ->get();
            }
            return view('Admin.account.index', compact('accounts'));
        } else {
            return redirect()->route('login')
                ->with('error', 'You need to be logged in to view accounts.');
        }
    }

    public function show(Account $account)
    {
        return view('Admin.account.view', compact('account'));
    }

    public function edit(Account $account)
    {
        return view('Admin.account.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'balance' => 'required|numeric|min:0',
        ]);

        $account = Account::findOrFail($id);
        if ($account->status === 'reject') {
            return redirect()->route('accounts.index')
                ->with('error', 'This Account has been Rejected and cannot be Update the Balance!');
        }
        $account->balance = $request->input('balance');
        $account->save();

        return redirect()->route('accounts.index')
            ->with('success', 'Account Balance Updated Successfully!');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('accounts.index')
            ->with('success', 'Account Deleted Successfully!');
    }

    public function showRequestForm()
    {
        return view('Admin.account.requestForm');
    }

    public function requestAccountCreation(Request $request)
    {
        $request->validate([
            'account_type' => 'required|in:savings,checking',
            'deposit_balance' => 'required|numeric|min:100',
        ]);

        $accountNumber = $this->generateAccountNumber();

        $account = Account::create([
            'user_id' => Auth::id(),
            'account_type' => $request->input('account_type'),
            'balance' => $request->input('deposit_balance'),
            'account_number' => $accountNumber,
            'status' => 'pending',
        ]);

        event(new AccountCreationRequested([
            'user_name' => Auth::user()->name,
            'account_type' => $request->input('account_type'),
            'deposit_balance' => $request->input('deposit_balance'),
            'account_number' => $accountNumber,
            'user_id' => Auth::id(),
        ]));

        return redirect()->route('Home')
            ->with('success', 'Account Creation Request Sent Successfully!');
    }

    public function view($id)
    {
        $account = Account::where('account_number', $id)->first();
        return view('Admin.account.requestFormDetail', compact('account'));
    }

    public function activate($id)
    {
        $account = Account::findOrFail($id);
        $account->status = 'active';
        $account->save();

        Mail::to($account->user->email)->send(new AccountActivated($account));

        return redirect()->route('accounts.index')
            ->with('success', 'Account Activated Successfully!');
    }

    public function reject($id)
    {
        $account = Account::findOrFail($id);
        $account->status = 'reject';
        $account->save();

        Mail::to($account->user->email)->send(new AccountDeactivated($account));

        return redirect()->route('accounts.index')
            ->with('success', 'Sorry, Account Rejected!');
    }

    private function generateAccountNumber()
    {
        return strtoupper(bin2hex(random_bytes(5)));
    }
}
