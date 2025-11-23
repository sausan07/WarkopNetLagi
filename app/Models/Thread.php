<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'content', 
        'slug', 
        'user_id', 
        'category_id'
    ];

    protected static function boot() {
        parent::boot();
        
        static::creating(function ($thread) {
            if (empty($thread->slug)) {
                $thread->slug = Str::slug($thread->title) . '-' . Str::random(3);
            }
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function postsCount() {
        return $this->posts()->where('status', 'active')->count();
    }
}
