<?php

namespace App;

use App\Models\Comments;
use App\Models\Post;
//use App\Treits\freindable;
use App\Models\Profil;
use Illuminate\Notifications\Notifiable;
use Hootlex\Friendships\Traits\Friendable;
use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kim\Activity\Activity;

class User extends Authenticatable
{
    use Notifiable, Friendable, UsersOnlineTrait;

    //use freindable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'avatar',
    ];

    public function UserActivity()
    {
        $activities = Activity::users()->get();

      // Loop through and echo user's name
        foreach ($activities as $activity) {
            echo $activity->user->name . '<br>';
        }

    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function profile()
    {
        return $this->hasOne(Profil::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }


    /**
     * @param Post $post
     * @return bool
     */
    public function hasLikePost(Post $post)
    {
        return (bool) $post->likes->where('user_id', $this->id)->count();
    }

    /**
     * @param $value
     * @return string return name user in uppercase
     */
    public function getNameAttribute($value)
    {
        return ucfirst(strtolower($value)) ;
    }

    /**
     * @param $value
     * @return string user picture profile
     */
    public function GetPhoto()
    {
        return ($this->photo !== null) ? asset('uploads/Profiles/' . $this->photo) : asset('uploads/Profiles/avatar.jpg') ;
    }

    /**
     * @param $value
     * @return string user picture mur
     */
    public function getMurphotoAttribute($value)
    {
        return ($value !== null) ? asset('uploads/Profiles/Mur/'. $value) : asset('uploads/Profiles/Mur/defaultmur.png') ;
    }

    public function getfilterUser()
    {
        return Friendship::whereRecipient($this)->whereStatus(Status::PENDING)->get();
    }

    // public function haslikedPost(Post $post)
    // {
    //     return (bool) $post->likes->where('user_id', $this->id)->count();
    // }

    public function getAvatarAttribute()
    {
        return $this->GetPhoto();
    }

}
