<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Keep for backward compatibility
        'is_active',
        'staff_id',
        'phone',
        'must_change_password',
        'password_changed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'must_change_password' => 'boolean',
        'password_changed_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Generate school email: ksamuel@asms.ac.ug
     */
    public static function generateSchoolEmail(string $name, ?string $staffId = null): string
    {
        $domain = config('app.school_domain', 'asms.ac.ug');

        if ($staffId) {
            $username = strtolower($staffId);
        } else {
            $parts = explode(' ', $name);
            $firstName = strtolower($parts[0]);
            $lastName = isset($parts[1]) ? strtolower($parts[1]) : '';
            $username = $firstName . ($lastName ? '.' . $lastName : '');
        }

        // Remove special characters
        $username = preg_replace('/[^a-z0-9.]/', '', $username);
        $email = $username . '@' . $domain;

        // Ensure uniqueness
        $counter = 1;
        while (self::where('email', $email)->exists()) {
            $email = $username . $counter . '@' . $domain;
            $counter++;
        }

        return $email;
    }

    /**
     * Generate default password: ASMS@2025
     */
    public static function generateDefaultPassword(): string
    {
        return 'ASMS@' . date('Y');
    }

    /**
     * Check if needs password change
     */
    public function needsPasswordChange(): bool
    {
        return $this->must_change_password === true;
    }

    /**
     * Mark password as changed
     */
    public function markPasswordChanged(): void
    {
        $this->update([
            'must_change_password' => false,
            'password_changed_at' => now(),
        ]);
    }

    /**
     * Scope for active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get primary role name (from Spatie roles)
     */
    public function getPrimaryRoleAttribute(): ?string
    {
        return $this->roles->first()?->name;
    }

    /**
     * Check if user is an admin (using Spatie)
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('Super Admin');
    }

    /**
     * Check if user is staff (using Spatie)
     */
    public function isStaff(): bool
    {
        return $this->hasRole('Admin Staff');
    }

    /**
     * Check if user is a teacher (using Spatie)
     */
    public function isTeacher(): bool
    {
        return $this->hasRole('Teacher');
    }

    /**
     * Check if user is a parent (using Spatie)
     */
    public function isParent(): bool
    {
        return $this->hasRole('Parent');
    }

    /**
     * Check if user is a student (using Spatie)
     */
    public function isStudent(): bool
    {
        return $this->hasRole('Student');
    }

    /**
     * Get role name for display (accessor)
     * Note: The Spatie package provides the 'roles' relationship
     */
    public function getRoleNameAttribute(): string
    {
        return $this->roles->first()?->name ?? 'No Role';
    }

    /**
     * Accessor for backward compatibility with 'role' field
     * This returns the first role name from Spatie roles
     */
    public function getRoleAttribute(): string
    {
        return $this->roles->first()?->name ?? 'user';
    }

    /**
     * Mutator for backward compatibility with 'role' field
     * This assigns the role using Spatie package
     */
    public function setRoleAttribute(string $role): void
    {
        $this->syncRoles([$role]);
    }



    /**
     * Boot method to handle role synchronization
     */
    protected static function boot()
    {
        parent::boot();

        // When creating a user, assign the role from the role attribute
        static::creating(function ($user) {
            if (isset($user->attributes['role']) && $user->attributes['role']) {
                $role = $user->attributes['role'];
                unset($user->attributes['role']); // Remove from attributes to avoid conflict

                // Store role temporarily to assign after creation
                $user->roleToAssign = $role;
            }
        });

        // After creating a user, assign the role
        static::created(function ($user) {
            if (isset($user->roleToAssign)) {
                $user->assignRole($user->roleToAssign);
                unset($user->roleToAssign);
            }
        });

        // When updating, sync the role if role attribute is present
        static::updating(function ($user) {
            if (array_key_exists('role', $user->attributes)) {
                $role = $user->attributes['role'];
                unset($user->attributes['role']); // Remove from attributes to avoid direct update

                // Store role temporarily to sync after update
                $user->roleToSync = $role;
            }
        });

        // After updating, sync the role
        static::updated(function ($user) {
            if (isset($user->roleToSync)) {
                $user->syncRoles([$user->roleToSync]);
                unset($user->roleToSync);
            }
        });
    }

}
