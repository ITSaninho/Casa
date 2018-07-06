<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    public function transiactionCategories() {
        return $this->belongsToMany('App\Transiactioncategory', 'transiactioncategory_payment', 'payment_id', 'transiactioncategory_id');
    }
}
