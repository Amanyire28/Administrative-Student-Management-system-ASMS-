<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    /**
     * Get user permission data for modal
     */
    private function getUserPermissionData(): array
    {
        $user = auth()->user();

        if (!$user) {
            return [
                'role' => 'No Role',
                'permissions' => []
            ];
        }

        return [
            'role' => $user->roles->first()?->name ?? 'No Role',
            'permissions' => $user->getAllPermissions()
                ->pluck('name')
                ->toArray()
        ];
    }

    /**
     * Create permission denied response
     */
    private function permissionDeniedResponse(string $permission): array
    {
        $userData = $this->getUserPermissionData();

        return [
            'success' => false,
            'message' => 'Permission denied',
            'error' => 'Access Denied',
            'required_permission' => $permission,
            'show_permission_modal' => true,
            'modal_data' => [
                'title' => 'Access Denied',
                'message' => 'You do not have permission to perform this action.',
                'required_permission' => $permission,
                'user_role' => $userData['role'],
                'user_permissions' => $userData['permissions']
            ],
            'notification' => [
                'type' => 'error',
                'title' => 'Permission Required',
                'message' => 'You need "' . $permission . '" permission.'
            ]
        ];
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Handle authorization exceptions
        if ($exception instanceof AuthorizationException) {
            $permission = $exception->getMessage() ?? 'Unknown permission';
            $userData = $this->getUserPermissionData();

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(
                    $this->permissionDeniedResponse($permission),
                    403
                );
            }

            // For non-AJAX requests
            return back()->with('permission_error', [
                'message' => 'You do not have permission to access this feature.',
                'required_permission' => $permission,
                'show_modal' => true,
                'user_role' => $userData['role'],
                'user_permissions' => $userData['permissions']
            ]);
        }

        return parent::render($request, $exception);
    }
}
