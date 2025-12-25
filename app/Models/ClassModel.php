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
<<<<<<< HEAD
        'level',
        'capacity',
        'classroom',
        'description',
=======
        'class_level_id',
        'stream_id',
        'classroom',
        'class_teacher_id',
>>>>>>> julius2
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

<<<<<<< HEAD
=======
    public function classTeacher()
    {
        return $this->belongsTo(Teacher::class, 'class_teacher_id');
    }

    public function classLevel()
    {
        return $this->belongsTo(ClassLevel::class, 'class_level_id');
    }

    public function stream()
    {
        return $this->belongsTo(Stream::class, 'stream_id');
    }

>>>>>>> julius2
    public function marks()
    {
        return $this->hasMany(Mark::class, 'class_id');
    }

    // Accessors
    public function getStudentCountAttribute()
    {
        return $this->students()->count();
    }
<<<<<<< HEAD
=======

    public function getFullNameAttribute()
    {
        return $this->classLevel->name . ' ' . $this->stream->name;
    }
>>>>>>> julius2
}
