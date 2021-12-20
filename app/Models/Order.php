<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Represents an instance of an order `orders table`
 */
class Order extends Model
{
    use HasFactory;

    protected $appends = ['serial' , 'created' ,'progressMsg','statusMsg'];

    protected $fillable = ['user_id','waste_id','cost','weight','pickup','status' ,'progress'];


    
    public function waste(){
        return $this->hasOne(Waste::class , 'id' , 'waste_id');
    }


    /**
     * Attribute for order hex serial number from date
     */
    public function getSerialAttribute(){
        return "#".strtoupper(dechex($this->id . date('U' ,strtotime($this->created_at))));
    }



    /**
     * Attribute for order created_at i.e 00:20 - 20th Dec 2021
     */
    public function getCreatedAttribute(){
        return date('H:i \- jS M Y' ,strtotime($this->created_at));
    }



    /**
     * Attribute for order progress ie Completed , Scheduled or N/A
     */
    public function getProgressMsgAttribute(){
        if($this->isCompleted()){
            return  "Completed";
        }


        if($this->isScheduled()){
            return  "Scheduled";
        }


        return  "N/A";
    }



    /**
     * Attribute for order status ie Paid or Unpaid
     */
    public function getStatusMsgAttribute(){
        return $this->status == '1' ? "Paid" : "UnPaid";
    }


    /**
     * Scope order paid orders ie with status of 1
     */
    public function scopePaid($query){
        return $query->where('status', 1);
    }

    
    /**
     * Scope order for currently authenticated user
     */
    public function scopeForAuthUser($query){
        return $query->where('user_id', Auth::user()->id);
    }


    /**
     * Scope orders for user with id $id
     */
    public function scopeForUser($query,$id){
        return $query->where('user_id', $id);
    }


    /**
     * Check if progress is completed
     */
    public function isCompleted(){
        return $this->progress == '2';
    }

    /**
     * Check if progress is scheduled
     */
    public function isScheduled(){
        return $this->progress == '1';
    }


    

    

    public function user(){
        return $this->belongsTo(User::class);
    }



    public function transaction(){
        return $this->hasOne(Transaction::class);
    }

}