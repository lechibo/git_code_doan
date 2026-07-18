<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table='users';
    public $timestamps=true;
    protected $fillable = [
    'name',
    'email',
    'password',
    'level',
    'phone',
    'address',
    'id_country',
    'avatar'
];
}
