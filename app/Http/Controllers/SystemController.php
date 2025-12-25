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

    public function users(Request $request)
{
    abort_unless(auth()->user()->can('system.users'), 403);

    $query = User::with('roles');

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('staff_id', 'like', "%{$search}%");
        });
    }

    // Sorting
    $sort = $request->get('sort', 'id');
    $direction = $request->get('direction', 'desc');

    if (in_array($sort, ['name', 'email', 'staff_id', 'created_at'])) {
        $query->orderBy($sort, $direction);
    }

    $users = $query->paginate(10)->withQueryString();

    // Check if it's an AJAX request for SPA navigation
    if ($request->ajax() && $request->header('X-SPA-Request')) {
        // Return HTML wrapped in JSON for SPA router
        return response()->json([
            'html' => view('modules.system.users', compact('users'))->render(),
            'title' => 'User Management'
        ]);
    }

    // Return JSON for AJAX search (non-SPA)
    if ($request->ajax()) {
        return response()->json([
            'table' => view('modules.system.partials.users-table', compact('users'))->render(),
            'total' => $users->total(),
            'activeCount' => $users->where('is_active', true)->count(),
            'inactiveCount' => $users->where('is_active', false)->count(),
        ]);
    }

    // Regular request
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

    // Check if it's an AJAX request for SPA navigation
    if (request()->ajax() && request()->header('X-SPA-Request')) {
        // Return HTML wrapped in JSON for SPA router
        return response()->json([
            'html' => view('modules.system.user-permissions', compact('user', 'roles', 'userRoles', 'permissions', 'userPermissions'))->render(),
            'title' => 'Edit User Permissions - ' . $user->name
        ]);
    }

    // Regular request (full page load or non-SPA AJAX)
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

        try {
            // Get role IDs and fetch role models
            $roleIds = $request->roles ?? [];
            $roles = Role::whereIn('id', $roleIds)->get();

            // Sync roles using models
            $user->syncRoles($roles);

            // Get permission IDs and fetch permission models
            $permissionIds = $request->permissions ?? [];
            $permissions = Permission::whereIn('id', $permissionIds)->get();

            // Sync permissions using models
            $user->syncPermissions($permissions);

            // Clear cache
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            // Handle response
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User permissions updated successfully!',
                    'user' => $user->load('roles', 'permissions')
                ]);
            }

            return redirect()->route('system.users')
                ->with('success', 'User permissions updated successfully!');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }



    // Add this method to SystemController
public function settings()
{
    abort_unless(auth()->user()->can('system.settings'), 403);

    // Get current settings
    $settings = [
        'general' => [
            'site_name' => config('app.name', 'ASMS'),
            'site_url' => config('app.url'),
            'timezone' => config('app.timezone', 'UTC'),
            'locale' => config('app.locale', 'en'),
        ],
        'academic' => [
            'current_academic_year' => setting('academic.current_year', date('Y')),
            'grading_system' => setting('academic.grading_system', 'percentage'),
            'passing_percentage' => setting('academic.passing_percentage', 40),
            'max_marks_per_subject' => setting('academic.max_marks', 100),
        ],
        'email' => [
            'mail_from_name' => config('mail.from.name'),
            'mail_from_address' => config('mail.from.address'),
            'mail_mailer' => config('mail.default'),
        ],
        'features' => [
            'enable_student_registration' => setting('features.student_registration', true),
            'enable_teacher_portal' => setting('features.teacher_portal', true),
            'enable_parent_portal' => setting('features.parent_portal', false),
            'enable_online_payments' => setting('features.online_payments', false),
        ]
    ];

    // Get available timezones
    $timezones = \DateTimeZone::listIdentifiers();

    // Get available locales
    $locales = [
        'en' => 'English',
        'es' => 'Spanish',
        'fr' => 'French',
        // Add more as needed
    ];

    return view('modules.system.settings', compact('settings', 'timezones', 'locales'));
}

// Add this method for saving settings
public function updateSettings(Request $request)
{
    abort_unless(auth()->user()->can('system.settings'), 403);

    $validated = $request->validate([
        'general.site_name' => 'required|string|max:255',
        'general.timezone' => 'required|string|timezone',
        'general.locale' => 'required|string|max:10',

        'academic.current_academic_year' => 'required|digits:4',
        'academic.grading_system' => 'required|in:percentage,letter_grade,gpa',
        'academic.passing_percentage' => 'required|numeric|min:0|max:100',
        'academic.max_marks_per_subject' => 'required|numeric|min:1|max:1000',

        'email.mail_from_name' => 'required|string|max:255',
        'email.mail_from_address' => 'required|email|max:255',
        'email.mail_mailer' => 'required|in:smtp,mailgun,ses,postmark,log,array',

        'features.enable_student_registration' => 'boolean',
        'features.enable_teacher_portal' => 'boolean',
        'features.enable_parent_portal' => 'boolean',
        'features.enable_online_payments' => 'boolean',
    ]);

    try {
        // Save settings to database or config file
        foreach ($validated as $category => $categorySettings) {
            foreach ($categorySettings as $key => $value) {
                // You can use a settings package like spatie/laravel-settings
                // For now, we'll store in config cache
                setting()->set($category . '.' . $key, $value);
            }
        }

        // Persist settings
        setting()->save();

        // Clear config cache
        \Artisan::call('config:clear');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'System settings updated successfully!',
                'settings' => $validated
            ]);
        }

        return redirect()->route('system.settings')
            ->with('success', 'System settings updated successfully!');

    } catch (\Exception $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update settings: ' . $e->getMessage()
            ], 500);
        }

        return back()->with('error', 'Failed to update settings: ' . $e->getMessage());
    }
}



}
