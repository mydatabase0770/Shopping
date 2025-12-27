<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'post'])
            ->latest()
            ->paginate(10);

        return view('admin.transaction.index', compact('transactions'));
    }

    /**
     * Update transaction state (Pending / Completed).
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);

        // toggle state: 0 => 1 | 1 => 0
        $transaction->state = ! $transaction->state;
        $transaction->save();

        return redirect()
            ->route('transaction.index')
            ->with('success', 'ستەیتی فرۆشتن نوێکرایەوە ✅');
    }
    

    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()
            ->route('transaction.index')
            ->with('success', 'فرۆشتن سڕایەوە ❌');
    }
}
