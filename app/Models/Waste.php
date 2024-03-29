<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    use HasFactory;


    protected $fillable = ['title','cost','description'];




    public function orders(){
        return $this->hasMany(Order::class);
    }
}