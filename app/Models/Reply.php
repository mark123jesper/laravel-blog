<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    // protected $table = 'categories';

    // protected $fillable = [
    //     "title",
    //     "slug",
    // ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($reply){
            $reply->user_id = auth()->id();
        });
    }

    protected $guarded = [];

    public function question()
    {
        return $this->belongsTO(Question::class);
    }

    public function user()
    {
        return $this->belongsTO(User::class);
    }

    //One to many relationship
    public function like()
    {
        return $this->hasMany(Like::class);
    }
}
