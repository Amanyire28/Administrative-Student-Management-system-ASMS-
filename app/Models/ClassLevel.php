<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLevel extends Model
{
    use HasFactory;

    protected $table = 'class_levels';

    protected $fillable = [
        'name',
        'school_type_id',
        'sort_order',
        'level_teacher_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the school type this class level belongs to
     */
    public function schoolType()
    {
        return $this->belongsTo(SchoolType::class, 'school_type_id');
    }

    /**
     * Get the class streams for this class level
     */
    public function classStreams()
    {
        return $this->hasMany(ClassStream::class, 'class_level_id');
    }

    /**
     * Get the level teacher
     */
    public function levelTeacher()
    {
        return $this->belongsTo(Teacher::class, 'level_teacher_id');
    }

    /**
     * Scope to get only active class levels
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the category name (for backward compatibility)
     */
    public function getCategoryAttribute()
    {
        return $this->schoolType ? $this->schoolType->name : null;
    }
}