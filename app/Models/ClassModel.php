<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'level',
        'capacity',
        'classroom',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject')
                    ->withPivot('teacher_id')
                    ->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_subject')
                    ->withPivot('subject_id')
                    ->withTimestamps();
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'class_id');
    }

    // Accessors
    public function getStudentCountAttribute()
    {
        return $this->students()->count();
    }
}
