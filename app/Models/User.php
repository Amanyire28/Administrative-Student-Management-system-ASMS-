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
        'role',
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






}
