<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Lead;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   public function index()
{
    $transactions = Transaction::with('lead')->latest()->paginate(10);
    return view('transactions.index', compact('transactions'));
}

  public function create()
{
    $leads = Lead::orderBy('business_name')->get();
    return view('transactions.form', compact('leads'));
}
    public function store(Request $request)
    {
        $data = $request->validate([
            'lead_id' => 'nullable|exists:leads,id',
            'type' => 'required|in:income,expense',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'payment_status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        Transaction::create($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction saved!');
    }

   public function edit(Transaction $transaction)
{
    $leads = Lead::orderBy('business_name')->get();
    return view('transactions.form', compact('transaction', 'leads'));
}

    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'lead_id' => 'nullable|exists:leads,id',
            'type' => 'required|in:income,expense',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'payment_status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return back()->with('success', 'Transaction deleted!');
    }
}