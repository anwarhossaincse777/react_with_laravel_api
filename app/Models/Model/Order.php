<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [

        'user_id',
        'firstname',
        'lastname',
        'phone',
        'email',
        'city',
        'state',
        'zipcode',
        'payment_id',
        'payment_mode',
        'tracking_no',
        'status',

    ];

    public function orderitems(){

        return $this->hasMany(OrderItems::class,'order_id','id');
    }

}
