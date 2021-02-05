<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['published_at'];

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'image',
        'published_at',
        'category_id',
        'user_id'
    ];
}