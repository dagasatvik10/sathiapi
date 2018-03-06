<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Make title and description fillable
    protected $fillable = ['user_id', 'title', 'description'];

    /**
     * Get the user that owns the post
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
