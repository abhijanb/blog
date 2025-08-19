<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    /** @use HasFactory<\Database\Factories\BlogCategoryFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'is_parent',
        'parent_id',
        'position',
        'is_active',
    ];
    protected $casts = [
        'is_parent' => 'boolean',
        'is_active' => 'boolean',
    ];
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }
}
