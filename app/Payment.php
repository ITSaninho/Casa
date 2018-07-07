<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    public function transactionCategories() {
        return $this->belongsToMany('App\Transaction_Сategory', 'transactioncategory_payment', 'payment_id', 'transiactioncategory_id');
    }
}
