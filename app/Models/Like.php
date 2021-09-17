<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // protected $table = 'questions';

    // protected $fillable = [
    //     "title",
    //     "slug",
    //     "body",
    //     "category_id",
    //     "user_id"
    // ];

    protected $guarded = [];
}
