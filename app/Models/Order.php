<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    public function waste(){
        return $this->hasOne(Waste::class , 'id' , 'waste_id');
    }
}