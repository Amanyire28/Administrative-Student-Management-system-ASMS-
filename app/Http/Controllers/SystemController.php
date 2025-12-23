<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SystemController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->can('system.users'), 403);

        return view('modules.system.index');
    }

    public function users()
    {
        abort_unless(auth()->user()->can('system.users'), 403);

        $users = User::with('roles')->get();
        return view('modules.system.users', compact('users'));
    }

    public function roles()
    {
        abort_unless(auth()->user()->can('system.roles'), 403);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::all()->groupBy(function($permission) {
            return explode('.', $permission->name)[0]; // Group by module
        });

        return view('modules.system.roles', compact('roles', 'permissions'));
    }

    public function editUserPermissions(User $user)
    {
        abort_unless(auth()->user()->can('system.users'), 403);

        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        $permissions = Permission::all()->groupBy(function($permission) {
            return explode('.', $permission->name)[0];
        });
        $userPermissions = $user->getAllPermissions()->pluck('id')->toArray();

        return view('modules.system.user-permissions', compact('user', 'roles', 'userRoles', 'permissions', 'userPermissions'));
    }

    public function updateUserPermissions(Request $request, User $user)
    {
        abort_unless(auth()->user()->can('system.users'), 403);

        // Validate input
        $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Sync roles
        $user->syncRoles($request->roles ?? []);

        // Sync direct permissions
        $user->syncPermissions($request->permissions ?? []);

        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->route('system.users')
            ->with('success', 'User permissions updated successfully!');
    }
}
