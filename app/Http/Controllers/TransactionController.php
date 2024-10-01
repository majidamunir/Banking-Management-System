<?php
//
//namespace App\Http\Controllers;
//
//use App\Mail\TransactionCreatedMail;
//use App\Models\Transaction;
//use App\Models\Account;
//use Illuminate\Http\Request;
//use App\Events\TransactionCreationRequested;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Mail;
//use Barryvdh\DomPDF\Facade\Pdf;
//
//class TransactionController extends Controller
//{
////    public function index()
////    {
////        if (Auth::user()->role === 'admin') {
////            $transactions = Transaction::all();
////        } else {
////            $transactions = Transaction::whereIn('account_id', Auth::user()
////                ->accounts->pluck('id'))->get();
////        }
////        return view('Admin.transaction.index', compact('transactions'));
////    }
//
//    public function index(Request $request)
//    {
//        $search = $request->input('search');
//        $query = Transaction::query();
//
//        if (Auth::user()->role === 'admin') {
//            if ($search) {
//                $query->where(function($q) use ($search) {
//                    $q->where('transaction_type', 'LIKE', "%{$search}%")
//                        ->orWhere('date', 'LIKE', "%{$search}%");
//                });
//            }
//        } else {
//            $accountIds = Auth::user()->accounts->pluck('id');
//            $query->whereIn('account_id', $accountIds);
//
//            if ($search) {
//                $query->where(function($q) use ($search) {
//                    $q->where('transaction_type', 'LIKE', "%{$search}%")
//                        ->orWhere('date', 'LIKE', "%{$search}%");
//                });
//            }
//        }
//        $transactions = $query->get();
//        if ($request->ajax()) {
//            return view('Admin.transaction.partials.transactions', compact('transactions'))
//                ->render();
//        }
//        return view('Admin.transaction.index', compact('transactions'));
//    }
//
//    public function create()
//    {
//        return view('Admin.transaction.create');
//    }
//
//    public function store(Request $request)
//    {
//        $validated = $request->validate([
//            'account_id' => 'required|exists:accounts,id',
//            'transaction_type' => 'required|string|in:deposit,withdrawal,transfer',
//            'amount' => 'required|numeric|min:0',
//            'date' => 'required|date',
//            'status' => 'required|string|in:pending,completed',
//            'target_account_id' => 'nullable|exists:accounts,id'
//        ]);
//
//        $account = Account::find($validated['account_id']);
//        $amount = $validated['amount'];
//
//        if ($validated['transaction_type'] === 'deposit') {
//            $account->balance += $amount;
//        } elseif ($validated['transaction_type'] === 'withdrawal') {
//            if ($account->balance < $amount) {
//                return redirect()->back()->with('error', 'Insufficient balance for withdrawal.');
//            }
//            $account->balance -= $amount;
//        } elseif ($validated['transaction_type'] === 'transfer') {
//            if (empty($validated['target_account_id'])) {
//                return redirect()->back()->with('error', 'Target account ID is required for transfers.');
//            }
//
//            $targetAccount = Account::find($validated['target_account_id']);
//
//            if (!$targetAccount) {
//                return redirect()->back()->with('error', 'Target Account Not Found.');
//            }
//            if ($account->id === $targetAccount->id) {
//                return redirect()->back()->with('error', 'Cannot Transfer to the Same Account.');
//            }
//            if ($account->balance < $amount) {
//                return redirect()->back()->with('error', 'Insufficient Balance For Transfer.');
//            }
//
//            $account->balance -= $amount;
//            $targetAccount->balance += $amount;
//            $targetAccount->save();
//        }
//
//        $account->save();
//
//        $transaction = Transaction::create([
//            'account_id' => $account->id,
//            'transaction_type' => $validated['transaction_type'],
//            'amount' => $amount,
//            'date' => $validated['date'],
//            'status' => $validated['status'],
//            'target_account_id' => $validated['target_account_id']
//        ]);
//
//        Mail::to($account->user->email)->send(new TransactionCreatedMail($transaction));
//
//        return redirect()->route('transactions.index')
//            ->with('success', 'Transaction Created!! Email Sent to the Customer Successfully.');
//    }
//
//    public function show(Transaction $transaction)
//    {
//        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::id() === $transaction->account->user_id))
//        {
//            return view('Admin.transaction.view', compact('transaction'));
//        }
//        return redirect()->route('transactions.index');
//    }
//
//    public function downloadPDF($id)
//    {
//        $transaction = Transaction::findOrFail($id);
//
//        if (Auth::check() && (Auth::user()->role === 'customer' || Auth::id() === $transaction->account->user_id))
//        {
//            $pdf = Pdf::loadView('Admin.transaction.transaction_pdf', compact('transaction'));
//            return $pdf->download('transaction_details.pdf');
//        }
//        return redirect()->back()
//            ->with('error', 'You are not authorized to download this transaction.');
//    }
//
//    public function edit(Transaction $transaction)
//    {
//        return view('Admin.transaction.edit', compact('transaction'));
//    }
//
//    public function update(Request $request, Transaction $transaction)
//    {
//        $request->validate([
//            'account_id' => 'required|integer|exists:accounts,id',
//            'transaction_type' => 'required|string|in:deposit,withdrawal,transfer',
//            'amount' => 'required|numeric|min:0',
//            'date' => 'required|date',
//            'status' => 'required|string|in:pending,completed'
//        ]);
//
//        $account = Account::find($request->input('account_id'));
//
//        if ($account) {
//            $amount = $request->input('amount');
//            $transactionType = $request->input('transaction_type');
//
//            if ($transactionType === 'deposit') {
//                $account->balance += $amount;
//            } elseif ($transactionType === 'withdrawal') {
//                if ($account->balance < $amount) {
//                    return redirect()->back()
//                        ->with('error', 'Insufficient balance for withdrawal.');
//                }
//                $account->balance -= $amount;
//            } elseif ($transactionType === 'transfer') {
//                $targetAccountId = $request->input('target_account_id');
//
//                if (empty($targetAccountId)) {
//                    return redirect()->back()
//                        ->with('error', 'Target account ID is required for transfers.');
//                }
//
//                $targetAccount = Account::find($targetAccountId);
//
//                if (!$targetAccount) {
//                    return redirect()->back()
//                        ->with('error', 'Target account not found.');
//                }
//
//                if ($account->id === $targetAccount->id) {
//                    return redirect()->back()
//                        ->with('error', 'Cannot transfer to the same account.');
//                }
//
//                if ($account->balance < $amount) {
//                    return redirect()->back()
//                        ->with('error', 'Insufficient balance for transfer.');
//                }
//
//                $account->balance -= $amount;
//                $targetAccount->balance += $amount;
//                $targetAccount->save();
//            }
//            $account->save();
//        }
//        $transaction->update($request->all());
//        return redirect()->route('transactions.index')
//            ->with('success', 'Transaction Updated Successfully!');
//    }
//
//
//    public function destroy(Transaction $transaction)
//    {
//        $transaction->delete();
//        return redirect()->route('transactions.index')
//            ->with('success', 'Transaction Deleted Successfully!!!!');
//    }
//
//    public function createRequest() {
//        return view('Admin.transaction.requestForm');
//    }
//
//    public function storeRequest(Request $request)
//    {
//        $request->validate([
//            'transaction_type' => 'required|string|in:deposit,withdraw,transfer',
//            'amount' => 'required|numeric|min:0',
//            'account_type' => 'required|string',
//        ]);
//
//        $transaction = Transaction::create([
//            'account_id' => $request->account_id,
//            'transaction_type' => $request->input('transaction_type'),
//            'amount' => $request->input('amount'),
//            'account_type' => $request->input('account_type'),
//            'date' => $request->date,
//            'status' => 'pending',
//            'target_account_id' => $request->target_account_id,
//        ]);
//
//        event(new TransactionCreationRequested([
//            'user_name' => auth()->user()->name,
//            'transaction_type' => $request->input('transaction_type'),
//            'amount' => $request->input('amount'),
//            'account_type' => $request->input('account_type'),
//            'date' => $transaction->date,
//            'status' => $transaction->status,
//            'target_account_id' => $request->target_account_id,
//        ]));
//
//        return redirect()->route('Home')
//            ->with('status', 'Transaction Request Submitted Successfully! Your transaction is currently pending.');
//    }
//
//}


namespace App\Http\Controllers;

//use App\Mail\TransactionCreatedMail;
//use App\Exports\TransactionsExport;
use App\Mail\AcceptedTransactionMail;
use App\Mail\RejectedTransactionMail;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Events\TransactionCreationRequested;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Mail;
//use Maatwebsite\Excel\Excel;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Transaction::query();

        if (Auth::user()->role === 'admin') {
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('transaction_type', 'LIKE', "%{$search}%")
                        ->orWhere('date', 'LIKE', "%{$search}%");
                });
            }
        } else {
            $query->where('status', '!=', 'pending');
            $accountIds = Auth::user()->accounts->pluck('id');
            $query->whereIn('account_id', $accountIds);

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('transaction_type', 'LIKE', "%{$search}%")
                        ->orWhere('date', 'LIKE', "%{$search}%");
                });
            }
        }
        $transactions = $query->get();
        if ($request->ajax()) {
            return view('Admin.transaction.partials.transactions', compact('transactions'))
                ->render();
        }
        return view('Admin.transaction.index', compact('transactions'));
    }

    public function createRequest()
    {
        $user = auth()->user();
        $activeAccounts = Account::where('status', 'active')->get();

        return view('Admin.transaction.requestForm', compact('user', 'activeAccounts'));
    }


    public function storeRequest(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_type' => 'required|string|in:deposit,withdraw,transfer',
            'amount' => 'required|numeric|min:0',
            'account_id' => 'required|exists:accounts,id',
            'date' => 'required|date|date_equals:today',
            'target_account_id' => 'nullable|exists:accounts,id',
        ], [
            'date.date_equals' => 'The date must be today.',
            'target_account_id.exists' => 'The selected target account is invalid.',
        ]);

        $transactionType = $validatedData['transaction_type'];
        $accountId = $validatedData['account_id'];
        $amount = $validatedData['amount'];
        $date = $validatedData['date'];
        $targetAccountId = $validatedData['target_account_id'] ?? null;

        $user = auth()->user();
        $userId = $user->id;

        $account = Account::findOrFail($accountId);

        if ($account->status !== 'active') {
            return redirect()->back()
                ->withErrors('The selected account is not active.')
                ->withInput();
        }

        if ($user->role === 'customer') {
            if ($account->user_id !== $userId) {
                return redirect()->back()
                    ->withErrors('You can only use your own accounts for transactions.')
                    ->withInput();
            }

            if ($transactionType === 'transfer') {
                if (!$targetAccountId) {
                    return redirect()->back()
                        ->withErrors('Target account is required for transfers.')
                        ->withInput();
                }

                $targetAccount = Account::find($targetAccountId);
                if (!$targetAccount || $targetAccount->status !== 'active') {
                    return redirect()->back()
                        ->withErrors('Invalid or inactive target account.')
                        ->withInput();
                }

                if ($targetAccount->user_id === $userId) {
                    return redirect()->back()
                        ->withErrors('You cannot transfer to your own account.')
                        ->withInput();
                }
            }
        } else {
            if ($transactionType === 'transfer') {
                if (!$targetAccountId) {
                    return redirect()->back()
                        ->withErrors('Target account is required for transfers.')
                        ->withInput();
                }

                $targetAccount = Account::find($targetAccountId);
                if (!$targetAccount || $targetAccount->status !== 'active') {
                    return redirect()->back()
                        ->withErrors('Invalid or inactive target account.')
                        ->withInput();
                }
            }
        }
        $transactionData = [
            'account_id' => $accountId,
            'transaction_type' => $transactionType,
            'amount' => $amount,
            'date' => $date,
            'status' => 'pending',
            'target_account_id' => $transactionType === 'transfer' ? $targetAccountId : null,
        ];

        $transaction = Transaction::create($transactionData);

        event(new TransactionCreationRequested([
            'user_name' => $user->name,
            'transaction_type' => $transaction->transaction_type,
            'amount' => $transaction->amount,
            'date' => $transaction->date,
            'status' => $transaction->status,
            'target_account_id' => $transaction->target_account_id ?? null,
            'id' => $transaction->id,
        ]));

        return redirect()->route('Home')
            ->with('status', 'Transaction Request Submitted Successfully!');
    }

//    public function storeRequest(Request $request)
//    {
//        $request->validate([
//            'transaction_type' => 'required|string|in:deposit,withdraw,transfer',
//            'amount' => 'required|numeric|min:0',
//            'account_id' => 'required|exists:accounts,id',
//            'date' => 'required|date|date_equals:today',
//            'target_account_id' => 'nullable|exists:accounts,id',
//        ], [
//            'date.date_equals' => 'The date must be valid.',
//        ]);
//
//        $transactionType = $request->input('transaction_type');
//        $accountId = $request->input('account_id');
//        $amount = $request->input('amount');
//        $date = $request->input('date');
//        $targetAccountId = $request->input('target_account_id');
//
//        $isCustomer = auth()->user()->role === 'customer';
//        $userId = auth()->id();
//
//        $account = Account::find($accountId);
//
//        if ($isCustomer) {
//            if ($transactionType === 'transfer') {
//                if (!$targetAccountId) {
//                    return redirect()->back()->withErrors('Target account is required for transfer.');
//                }
//
//                if ($account->user_id !== $userId) {
//                    return redirect()->back()->withErrors('You can only transfer from your own accounts.');
//                }
//
//                $targetAccount = Account::find($targetAccountId);
//                if (!$targetAccount || $targetAccount->id === $account->id) {
//                    return redirect()->back()->withErrors('Invalid target account.');
//                }
//            } else {
//                if ($transactionType === 'deposit' || $transactionType === 'withdraw') {
//                    if ($account->user_id !== $userId) {
//                        return redirect()->back()->withErrors('You can only deposit or withdraw from your own accounts.');
//                    }
//                } else {
//                    return redirect()->back()->withErrors('Invalid transaction type for a customer.');
//                }
//            }
//        } else {
//            if ($transactionType === 'transfer') {
//                if (!$targetAccountId) {
//                    return redirect()->back()->withErrors('Target account is required for transfer.');
//                }
//
//                $targetAccount = Account::find($targetAccountId);
//                if (!$targetAccount || $targetAccount->id === $accountId) {
//                    return redirect()->back()->withErrors('Invalid target account.');
//                }
//            }
//        }
//
//        $transactionData = [
//            'account_id' => $accountId,
//            'transaction_type' => $transactionType,
//            'amount' => $amount,
//            'date' => $date,
//            'status' => 'pending',
//            'target_account_id' => $transactionType === 'transfer' ? $targetAccountId : null,
//        ];
//
//        $transaction = Transaction::create($transactionData);
//
//        event(new TransactionCreationRequested([
//            'user_name' => auth()->user()->name,
//            'transaction_type' => $transaction->transaction_type,
//            'amount' => $transaction->amount,
//            'date' => $transaction->date,
//            'status' => $transaction->status,
//            'target_account_id' => $transaction->target_account_id ?? null,
//            'id' => $transaction->id,
//        ]));
//
//        return redirect()->route('Home')
//            ->with('status', 'Transaction Request Submitted Successfully!');
//    }

    public function showRequestDetails($id)
    {
        $transaction = Transaction::find($id);
        return view('Admin.transaction.requestDetailForm', compact('transaction'));
    }

    public function show(Transaction $transaction)
    {
        return view('Admin.transaction.view', compact('transaction'));
    }

//    public function downloadPDF($id)
//    {
//        $transaction = Transaction::findOrFail($id);
//
//        if (Auth::check() && (Auth::user()->role === 'customer' || Auth::id() === $transaction->account->user_id)) {
//            $pdf = Pdf::loadView('Admin.transaction.transaction_pdf', compact('transaction'));
//            return $pdf->download('transaction_details.pdf');
//        }
//        return redirect()->back()
//            ->with('error', 'You are not authorized to download this transaction.');
//    }

//    public function edit(Transaction $transaction)
//    {
//        return view('Admin.transaction.edit', compact('transaction'));
//    }
//
//
//    public function update(Request $request, Transaction $transaction)
//    {
//        // Validate common fields
//        $request->validate([
//            'account_id' => 'required|integer|exists:accounts,id',
//            'transaction_type' => 'required|string|in:deposit,withdrawal,transfer',
//            'amount' => 'required|numeric|min:0',
//            'date' => 'required|date',
//            'status' => 'required|string|in:pending,completed',
//        ]);
//
//        // Retrieve the account to which the transaction is related
//        $account = Account::find($request->input('account_id'));
//
//        if (!$account) {
//            return redirect()->back()->withErrors('Account not found.');
//        }
//
//        $amount = $request->input('amount');
//        $transactionType = $request->input('transaction_type');
//
//        // Handle deposit transactions
//        if ($transactionType === 'deposit') {
//            $account->balance += $amount;
//        }
//        // Handle withdrawal transactions
//        elseif ($transactionType === 'withdrawal') {
//            if ($account->balance < $amount) {
//                return redirect()->back()->withErrors('Insufficient balance for withdrawal.');
//            }
//            $account->balance -= $amount;
//        }
//        // Handle transfer transactions
//        elseif ($transactionType === 'transfer') {
//            // Validate target account
//            $request->validate([
//                'target_account_id' => 'required|integer|exists:accounts,id',
//            ]);
//
//            $targetAccountId = $request->input('target_account_id');
//            $targetAccount = Account::find($targetAccountId);
//
//            if (!$targetAccount) {
//                return redirect()->back()->withErrors('Target account not found.');
//            }
//
//            if ($account->id === $targetAccount->id) {
//                return redirect()->back()->withErrors('Cannot transfer to the same account.');
//            }
//
//            // Check for sufficient balance
//            if ($account->balance < $amount) {
//                return redirect()->back()->withErrors('Insufficient balance for transfer.');
//            }
//
//            // Perform the transfer: deduct from source, add to target
//            $account->balance -= $amount;
//            $targetAccount->balance += $amount;
//
//            // Save both accounts
//            $account->save();
//            $targetAccount->save();
//        }
//
//        // Save account balance changes
//        $account->save();
//
//        // Update the transaction with new data
//        $transaction->update([
//            'account_id' => $request->input('account_id'),
//            'transaction_type' => $request->input('transaction_type'),
//            'amount' => $request->input('amount'),
//            'date' => $request->input('date'),
//            'status' => $request->input('status'),
//            'target_account_id' => $transactionType === 'transfer' ? $request->input('target_account_id') : null,
//        ]);
//
//        // Redirect to transaction list with success message
//        return redirect()->route('transactions.index')
//            ->with('success', 'Transaction Updated Successfully!');
//    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('success', 'Transaction Deleted Successfully!');
    }

    public function accept($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction || $transaction->status !== 'pending') {
            return redirect()->route('transactions.index')
                ->withErrors('Transaction not found or has already been processed.');
        }

        $account = Account::find($transaction->account_id);
        $targetAccount = $transaction->target_account_id ? Account::find($transaction->target_account_id) : null;

        DB::beginTransaction();

        if ($transaction->transaction_type === 'deposit') {
            $account->balance += $transaction->amount;
        } elseif ($transaction->transaction_type === 'withdraw') {
            if ($account->balance < $transaction->amount) {
                DB::rollBack();
                return redirect()->route('transactions.index')
                    ->withErrors('Insufficient balance for withdrawal.');
            }
            $account->balance -= $transaction->amount;
        } elseif ($transaction->transaction_type === 'transfer') {
            if ($account->balance < $transaction->amount || !$targetAccount) {
                DB::rollBack();
                return redirect()->route('transactions.index')
                    ->withErrors('Insufficient balance or target account not found.');
            }
            $account->balance -= $transaction->amount;
            $targetAccount->balance += $transaction->amount;
            $targetAccount->save();
        } else {
            DB::rollBack();
            return redirect()->route('transactions.index')
                ->withErrors('Invalid transaction type.');
        }

        $account->save();
        $transaction->status = 'completed';
        $transaction->save();

        DB::commit();

        $userEmail = $transaction->account->user->email;
        Mail::to($userEmail)->send(new AcceptedTransactionMail($transaction));

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction Accepted!');
    }


    public function reject($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction || $transaction->status !== 'pending') {
            return redirect()->route('transactions.index')
                ->withErrors('Transaction not found or has already been processed.');
        }

        DB::beginTransaction();

        $transaction->status = 'failed';
        $transaction->save();

        DB::commit();

        $userEmail = $transaction->account->user->email;
        Mail::to($userEmail)->send(new RejectedTransactionMail($transaction));

        return redirect()->route('transactions.index')
            ->with('success', 'Sorry, Transaction Rejected!');
    }

    public function downloadPdf()
    {
        $transactions = auth()->user()->transactions()->get();
        $pdf = Pdf::loadView('Admin.transaction.fullPdf', compact('transactions'));
        return $pdf->download('transactions_report.pdf');
    }
}

