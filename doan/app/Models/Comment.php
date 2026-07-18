<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\blog;

class Comment extends Model
{
    protected $table='comments';
    protected $fillable=[
        'cmt','id_user','id_blog','avatar_user','name_user','level'
    ];
    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function blog(){
        return $this->belongsTo(Blog::class,'id_blog');
    }
}
