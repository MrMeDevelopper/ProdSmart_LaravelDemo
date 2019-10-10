<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseStock extends Model
{
    //
    protected $fillable = ['item_id','quantity'];
}
