<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }


    public function scopeCompleted($query){
        return $query->where('Status',1);
    }

}