<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    //
    protected $fillable = ['quantity','item_id'];

    public function item(){
        return $this->hasOne(Item::class,'id');
    }
}
