<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->roles['offer']['viewAny'];
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(Admin $admin, User $model)
    {
        return $admin->roles['offer']['view'];
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->roles['offer']['create'];
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(Admin $admin, User $model)
    {
        return $admin->roles['offer']['update'];
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(Admin $admin, User $model)
    {
        return $admin->roles['offer']['delete'];
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(Admin $admin, User $model)
    {
        return $admin->roles['offer']['restore'];
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(Admin $admin, User $model)
    {
        return $admin->roles['offer']['forceDelete'];
    }
}