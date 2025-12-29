<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'employee_id',
        'first_name',
        'last_name',
        'other_names',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'national_id',
        'qualifications',
        'employment_date',
        'designation',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'employment_date' => 'date',
        'is_active' => 'boolean',
    ];

    protected $appends = ['full_name', 'profile_photo_url'];

    /**
     * Relationships - FIXED: Find user by email
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
        // This means: teacher.email = user.email
    }

    // OR if you want to use staff_id/employee_id:
    /*
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'staff_id');
        // This means: teacher.employee_id = user.staff_id
    }
    */

    public function classes()
    {
        return $this->belongsToMany(ClassStream::class, 'class_stream_teacher', 'teacher_id', 'class_stream_id')
            ->withPivot('is_class_teacher')
            ->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject')
            ->withTimestamps();
    }

    public function taughtClasses()
    {
        return $this->classes()->wherePivot('is_class_teacher', false);
    }

    public function classTeacherOf()
    {
        return $this->classes()->wherePivot('is_class_teacher', true);
    }

    /**
     * Accessors
     */
    public function getFullNameAttribute()
    {
        $name = $this->first_name . ' ' . $this->last_name;
        if ($this->other_names) {
            $name .= ' ' . $this->other_names;
        }
        return $name;
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        if ($this->user && $this->user->profile_photo_path) {
            return asset('storage/' . $this->user->profile_photo_path);
        }

        $initials = strtoupper(
            substr($this->first_name, 0, 1) .
            substr($this->last_name, 0, 1)
        );
        return 'https://ui-avatars.com/api/?name=' .
               urlencode($this->full_name) .
               '&color=7F9CF5&background=EBF4FF';
    }

    public function getFormattedEmployeeIdAttribute()
    {
        return strtoupper($this->employee_id);
    }

    /**
     * Get the user's role safely
     */
    public function getRoleNameAttribute()
    {
        if (!$this->user) {
            return null;
        }
        return $this->user->roles->first()->name ?? null;
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('employee_id', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /**
     * Helper Methods
     */
    public function assignToClass($classStreamId, $isClassTeacher = false)
    {
        return $this->classes()->syncWithoutDetaching([
            $classStreamId => ['is_class_teacher' => $isClassTeacher]
        ]);
    }

    public function assignSubject($subjectId)
    {
        return $this->subjects()->syncWithoutDetaching([$subjectId]);
    }

    public function isClassTeacherOf($classStreamId)
    {
        return $this->classes()
            ->where('class_stream_id', $classStreamId)
            ->where('is_class_teacher', true)
            ->exists();
    }

    public function getTotalStudentsAttribute()
    {
        return $this->classes()->withCount('students')->get()->sum('students_count');
    }
}
