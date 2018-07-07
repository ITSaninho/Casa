<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_Category extends Model
{
    protected $table = 'transaction_category';

    public function action()
    {
        return $this->belongsTo('App\Action');
    }

    public function payments() {
        return $this->belongsToMany('App\Payment', 'transactioncategory_payment', 'transiactioncategory_id', 'payment_id');
    }
}
