<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table='checkouts';
    public $timestamps= true;
    protected $fillable = [
        'id_user',
        'name',
        'phone',
        'email',   
        'price'
       
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
