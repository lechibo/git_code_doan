<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table= 'country';
    public $timestamps= true;
    protected $fillable=[ 'name'];
}
