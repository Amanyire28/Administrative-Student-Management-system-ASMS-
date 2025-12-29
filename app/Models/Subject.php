<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function classes()
    {
        return $this->belongsToMany(ClassStream::class, 'class_subject', 'subject_id', 'class_stream_id')
            ->withPivot('teacher_id')
            ->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject')
            ->withTimestamps();
    }

    /**
     * Scope for active subjects
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered subjects
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    /**
     * Accessors
     */
    public function getStatusBadgeAttribute()
    {
        return $this->is_active
            ? '<span class="badge badge-success">Active</span>'
            : '<span class="badge badge-danger">Inactive</span>';
    }

    /**
     * Check if subject is assigned to any class
     */
    public function isAssignedToClass()
    {
        return $this->classes()->exists();
    }

    /**
     * Get total students enrolled in this subject
     */
    public function getTotalStudentsAttribute()
    {
        return $this->classes->sum(function($class) {
            return $class->students()->count();
        });
    }
}
