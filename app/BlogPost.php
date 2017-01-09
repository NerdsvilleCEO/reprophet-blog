<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = "blogposts";
    protected $fillable = [
        'title', 'content', 'public'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
