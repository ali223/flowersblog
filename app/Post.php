<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'image_path'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }   
    
    public function scopeByUserAndAllPublished($query, $userId)
    {
        return $query->where('published', true)
                    ->orWhere('user_id', $userId);
    }
 

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }

    public function scopeCreatedBy($query, $userId)
    {
        return $query->orWhere('user_id', $userId);
    }

    public function isUnpublished()
    {
        return ! $this->published;
    }

    public function isPublished()
    {
        return $this->published;
    }


}
