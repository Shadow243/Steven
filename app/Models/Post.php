<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getPhotoAttribute($value)
    {
        return asset('uploads/Post/'. $value);
    }

    /**
     * @param int $nbr
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function lastComments($nbr = 5)
    {
        return Comments::with('user')->where('post_id', $this->id)->latest()->limit($nbr)->get();
    }
}
