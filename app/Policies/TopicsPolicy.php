<?php

namespace App\Policies;

use App\Models\Topics;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicsPolicy
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
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Topics $topics)
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
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Topics $topics)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Topics $topics)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Topics $topics)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topics  $topics
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Topics $topics)
    {
        //
    }
}
