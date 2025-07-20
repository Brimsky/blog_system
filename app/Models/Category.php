<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($category) => $category->slug = Str::slug($category->name));
    }

    public function posts() { return $this->belongsToMany(Post::class); }
    public function getRouteKeyName() { return 'slug'; }
}
