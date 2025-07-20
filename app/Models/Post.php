<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'status', 'user_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($post) => $post->slug = Str::slug($post->title));
        static::updating(function($post) {
            if ($post->isDirty('title')) $post->slug = Str::slug($post->title);
        });
    }

    public function user() { return $this->belongsTo(User::class); }
    public function categories() { return $this->belongsToMany(Category::class); }
    public function comments() { return $this->hasMany(Comment::class); }

    public function scopePublished(Builder $query) { return $query->where('status', 'published'); }
    public function scopeSearch(Builder $query, $search) {
        return $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('body', 'LIKE', "%{$search}%");
    }
    public function getRouteKeyName() { return 'slug'; }
}
