<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    /**
     * Send notification to users with specific permission
     * Returns the number of users notified
     */
    public function notifyByPermission($notification, $permission): int
    {
        $users = User::active()
            ->whereHas('roles.permissions', function ($query) use ($permission) {
                $query->where('name', $permission);
            })
            ->get();

        if ($users->isEmpty()) {
            return 0;
        }

        NotificationFacade::send($users, $notification);
        return $users->count();
    }

    /**
     * Send notification to users with specific roles
     * Returns the number of users notified
     */
    public function notifyByRole($notification, array $roles): int
    {
        $users = User::active()
            ->whereHas('roles', function ($query) use ($roles) {
                $query->whereIn('name', $roles);
            })
            ->get();

        if ($users->isEmpty()) {
            return 0;
        }

        NotificationFacade::send($users, $notification);
        return $users->count();
    }

    /**
     * Send notification to users with EITHER permission OR roles
     * Prevents duplicates - each user gets notified only once
     */
    // In App\Services\NotificationService
 public function notifyByPermissionOrRole($notification, $permission = null, array $roles = []): int
    {
        Log::info('=== NOTIFICATION SERVICE CALLED ===');
        Log::info('Notification class:', [get_class($notification)]);
        Log::info('Permission:', [$permission]);
        Log::info('Roles:', $roles);

        $query = User::active();

        if ($permission && !empty($roles)) {
            // Users with either permission OR roles
            $query->where(function ($q) use ($permission, $roles) {
                $q->whereHas('roles.permissions', function ($subQuery) use ($permission) {
                    $subQuery->where('name', $permission);
                })->orWhereHas('roles', function ($subQuery) use ($roles) {
                    $subQuery->whereIn('name', $roles);
                });
            });
        } elseif ($permission) {
            // Only permission
            $query->whereHas('roles.permissions', function ($q) use ($permission) {
                $q->where('name', $permission);
            });
        } elseif (!empty($roles)) {
            // Only roles
            $query->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('name', $roles);
            });
        } else {
            Log::warning('No permission or roles specified for notification');
            return 0;
        }

        $users = $query->get()->unique('id');

        Log::info('Users found to notify:', [
            'count' => $users->count(),
            'emails' => $users->pluck('email')->toArray()
        ]);

        if ($users->isEmpty()) {
            Log::warning('No users found to notify');
            return 0;
        }

        try {
            Log::info('Attempting to send notification...');
            Notification::send($users, $notification);
            Log::info('✅ Notifications sent successfully');

            return $users->count();

        } catch (\Exception $e) {
            Log::error('Failed to send notification:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 0;
        }
    }


    /**
     * Send notification to specific users with permission check
     * Returns the number of users notified
     */
    public function notifyUsers($users, $notification): int
    {
        // If it's a collection, send to all users
        if ($users instanceof \Illuminate\Database\Eloquent\Collection) {
            $users = $users->unique('id');
            NotificationFacade::send($users, $notification);
            return $users->count();
        }

        // If it's a single user
        if ($users instanceof User) {
            NotificationFacade::send($users, $notification);
            return 1;
        }

        // If it's an array of user IDs
        if (is_array($users)) {
            $users = User::whereIn('id', $users)->get()->unique('id');
            NotificationFacade::send($users, $notification);
            return $users->count();
        }

        return 0;
    }

    /**
     * Check if a user has permission to view a notification
     */
    public function canViewNotification(User $user, array $notificationData): bool
    {
        // 1. Check if notification has permission data
        if (!isset($notificationData['required_permission']) &&
            !isset($notificationData['allowed_roles'])) {
            return true; // No restrictions, show to all
        }

        // 2. Check required permission
        if (isset($notificationData['required_permission']) &&
            $notificationData['required_permission'] &&
            !$user->can($notificationData['required_permission'])) {
            return false;
        }

        // 3. Check allowed roles
        if (isset($notificationData['allowed_roles']) &&
            $notificationData['allowed_roles'] &&
            !$this->userHasAnyRole($user, $notificationData['allowed_roles'])) {
            return false;
        }

        // 4. Check notification preference (in_app for display)
        if (isset($notificationData['category']) &&
            !$user->hasNotificationPreference('in_app', $notificationData['category'])) {
            return false;
        }

        return true;
    }

    /**
     * Filter notifications for a user (for frontend display)
     */
    public function filterUserNotifications(User $user, $notifications)
    {
        return $notifications->filter(function ($notification) use ($user) {
            return $this->canViewNotification($user, $notification->data);
        });
    }

    /**
     * Check if user has any of the specified roles
     */
    private function userHasAnyRole(User $user, array $roles): bool
    {
        if (empty($roles)) {
            return true; // No role restriction
        }

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get users who should receive a notification based on its configuration
     * Useful for previewing who will get notified
     */
    public function getEligibleUsersForNotification($notificationClass): array
    {
        // Create a dummy instance to get its configuration
        $reflection = new \ReflectionClass($notificationClass);
        $properties = $reflection->getDefaultProperties();

        $permission = $properties['requiredPermission'] ?? null;
        $roles = $properties['allowedRoles'] ?? [];

        $query = User::active();

        if ($permission && !empty($roles)) {
            $query->where(function ($q) use ($permission, $roles) {
                $q->whereHas('roles.permissions', function ($subQuery) use ($permission) {
                    $subQuery->where('name', $permission);
                })->orWhereHas('roles', function ($subQuery) use ($roles) {
                    $subQuery->whereIn('name', $roles);
                });
            });
        } elseif ($permission) {
            $query->whereHas('roles.permissions', function ($q) use ($permission) {
                $q->where('name', $permission);
            });
        } elseif (!empty($roles)) {
            $query->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('name', $roles);
            });
        } else {
            return []; // No criteria
        }

        return $query->get()->unique('id')->pluck('email')->toArray();
    }
}
