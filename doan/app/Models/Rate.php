<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';

    protected $fillable = [
        'id_blog',
        'id_user',
        'rate'
    ];

    public function blog()
    {
        return $this->belongsTo(blog::class, 'id_blog');
    }

    public function user()
    {
        return $this->belongsTo(Profile::class, 'id_user');
    }
}
