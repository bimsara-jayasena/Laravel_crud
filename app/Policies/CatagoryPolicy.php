<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Catagory;
use Illuminate\Auth\Access\Response;

class CatagoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Catagory $catagory): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Catagory $catagory): bool
    {
        return $admin->role==='admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Catagory $catagory): bool
    {
        return $admin->role==='admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Catagory $catagory): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Catagory $catagory): bool
    {
        //
    }
}
