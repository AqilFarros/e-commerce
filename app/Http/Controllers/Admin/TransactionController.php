<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::with('user')->select('id', 'user_id', 'name', 'slug', 'email', 'phone', 'courier', 'status', 'total_price', 'payment', 'payment_url')->latest()->get();

        return view('pages.admin.transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);

        try {
            $transaction->update([
                'status' => $request->status
            ]);

            return redirect()->route('admin.transaction.index')->with('success', 'Success To Update Status');
        } catch (\Throwable $th) {
            return redirect()->route('admin.transaction.index')->with('error', 'Failed To Update Status');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showDataByAdmin($slug, $id)
    {
        $transaction = Transaction::where('slug', $slug)->where('id', $id)->firstOrFail();

        return view('pages.admin.transaction.show', compact('transaction'));
    }
}
