<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'keywords',
        'publish_date',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'social_share_image',
        'social_share_description',
        'category_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_categories_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);}
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
