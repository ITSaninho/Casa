<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Payment;
use App\Transaction;
use App\TransactionCategory_Payment;
use App\Transaction_Category;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction_category = Transaction_Category::all();
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        $payments = Payment::all();
        $actions = Action::all();

        $nalichni_add = Transaction::where('paymend_id', 1)->where('action_id', 1)->sum('price');
        $nalichni_delete = Transaction::where('paymend_id', 1)->where('action_id', 2)->sum('price');
        $nalichni = $nalichni_add - $nalichni_delete;

        $nenalicni_add = Transaction::where('paymend_id', 2)->where('action_id', 1)->sum('price');
        $nenalicni_delete = Transaction::where('paymend_id', 2)->where('action_id', 2)->sum('price');
        $nenalicni = $nenalicni_add - $nenalicni_delete;

        return view('transaction', compact('transactions', 'transaction_category', 'payments', 'actions', 'nalichni', 'nenalicni'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transiaction = new Transaction();
        $transiaction->transaction_category_id = $request->transaction_category;
        $transiaction->paymend_id = $request->payment;
        $transiaction->action_id = $request->action;
        $transiaction->price = $request->price;
        $transiaction->save();
        if($transiaction->save()){
            return redirect()->back()->with('status', 'Transaction was successful!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rollback($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction->delete()) {
            return redirect()->back()->with('status', 'Transaction rollback was successful!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
