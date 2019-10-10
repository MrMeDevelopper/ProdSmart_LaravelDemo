<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['ordered_quantity','quantity','completed','user_id','item_id'];
}
