<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'title' , 'content', 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

}
