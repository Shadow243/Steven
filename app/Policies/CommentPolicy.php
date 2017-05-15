<?php

namespace App\Policies;

use App\User;
use App\Models\Comments;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the comments.
     *
     * @param  \App\User  $user
     * @param  \App\Comments  $comments
     * @return mixed
     */
    public function view(User $user, Comments $comments)
    {
        //
    }

    /**
     * Determine whether the user can update the comments.
     *
     * @param  \App\User  $user
     * @param  \App\Comments  $comments
     * @return mixed
     */
    public function update(User $user, Comments $comments)
    {
        return $user->id === $comments->user_id;
    }

    /**
     * Determine whether the user can delete the comments.
     *
     * @param  \App\User  $user
     * @param  \App\Comments  $comments
     * @return mixed
     */
    public function delete(User $user, Comments $comments)
    {
        return $user->id === $comments->user_id;
    }
}
