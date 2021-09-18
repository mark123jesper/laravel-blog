<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Question extends Model
{
    use HasFactory;

    // protected $table = 'questions';

    protected $fillable = [
        "title",
        "slug",
        "body",
        "category_id",
        "user_id"
    ];

    // protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::creating(function($question){
            $question->slug = Str::slug($question->title);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPathAttribute()
    {
        return "question/$this->slug";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
