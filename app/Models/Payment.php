<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','amount','payment_date','comment','status'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
