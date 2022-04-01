<?php

namespace App\Policies;

use App\Models\ThForumComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ThForumComment  $thForumComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ThForumComment $thForumComment)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return  Auth::user()->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ThForumComment  $thForumComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ThForumComment $thForumComment)
    {
        $userRoles = $user->Role->whereIn("id", [1, 2]);
        return $user->id === $thForumComment->created_by || $userRoles->count() > 0;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ThForumComment  $thForumComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ThForumComment $thForumComment)
    {
        $userRoles = $user->Role->whereIn("id", [1, 2]);
        return $user->id === $thForumComment->created_by || $userRoles->count() > 0;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ThForumComment  $thForumComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ThForumComment $thForumComment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ThForumComment  $thForumComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ThForumComment $thForumComment)
    {
        //
    }
}
