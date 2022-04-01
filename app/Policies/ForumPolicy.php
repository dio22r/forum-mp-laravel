<?php

namespace App\Policies;

use App\Models\MhForumTopic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ForumPolicy
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
     * @param  \App\Models\MhForumTopic  $mhForumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MhForumTopic $mhForumTopic)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhForumTopic  $mhForumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MhForumTopic $mhForumTopic)
    {
        $userRoles = $user->Role->whereIn("id", [1, 2]);
        return $user->id === $mhForumTopic->created_by || $userRoles->count() > 0;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhForumTopic  $mhForumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MhForumTopic $mhForumTopic)
    {
        $userRoles = $user->Role->whereIn("id", [1, 2]);
        return $user->id === $mhForumTopic->created_by || $userRoles->count() > 0;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhForumTopic  $mhForumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MhForumTopic $mhForumTopic)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhForumTopic  $mhForumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MhForumTopic $mhForumTopic)
    {
        //
    }
}
