<?php

namespace App\Policies;

use App\Models\MhForumTag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
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
     * @param  \App\Models\MhForumTag  $mhForumTag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MhForumTag $mhForumTag)
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
        $userRoles = $user->Role->whereIn("id", [1, 2]);
        return $userRoles->count() > 0;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhForumTag  $mhForumTag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MhForumTag $mhForumTag)
    {
        $userRoles = $user->Role->whereIn("id", [1, 2]);
        return $userRoles->count() > 0;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhForumTag  $mhForumTag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MhForumTag $mhForumTag)
    {
        $userRoles = $user->Role->whereIn("id", [1, 2]);
        return $userRoles->count() > 0;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhForumTag  $mhForumTag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MhForumTag $mhForumTag)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhForumTag  $mhForumTag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MhForumTag $mhForumTag)
    {
        //
    }
}
