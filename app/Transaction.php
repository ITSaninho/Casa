<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['transaction_category_id', 'paymend_id', 'action_id', 'price', 'created_at', 'updated_at'];

    public function action()
    {
        return $this->belongsTo('App\Action');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment', 'id', 'paymend_id');
    }

    public function transactionCategory()
    {
        return $this->belongsTo('App\Transaction_Category');
    }
}
