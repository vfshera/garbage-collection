<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $appends = ['serial' , 'created'];

    protected $fillable = ['user_id','waste_id','cost','weight','pickup','status' ,'progress'];

    public function waste(){
        return $this->hasOne(Waste::class , 'id' , 'waste_id');
    }


    public function getSerialAttribute(){
        return "#".strtoupper(dechex($this->id . date('U' ,strtotime($this->created_at))));
    }

    public function getCreatedAttribute(){
        return date('H:i \- jS M Y' ,strtotime($this->created_at));
    }


    public function scopePaid($query){
        return $query->where('status', 1);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }



    public function payment(){
        return $this->hasOne(Payment::class);
    }
}