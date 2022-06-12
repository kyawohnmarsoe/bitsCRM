<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name','phone_no','address'];

    public function payments(){
        return $this->hasMany(Payment::class,'customer_id','id');
    }
}
