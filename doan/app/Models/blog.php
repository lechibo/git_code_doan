<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $table='blogs';
    public $timestamps=true;
    protected $fillable=[
        'title',
        'image',
        'description',
        'content'
    ];
    public function rates()
    {
        return $this->hasMany(Rate::class, 'id_blog');
    }
}
