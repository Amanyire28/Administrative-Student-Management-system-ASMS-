<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_level_id',
        'stream_id',
        'class_teacher_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the class level this stream belongs to
     */
    public function classLevel()
    {
        return $this->belongsTo(ClassLevel::class, 'class_level_id');
    }

    /**
     * Get the stream
     */
    public function stream()
    {
        return $this->belongsTo(Stream::class, 'stream_id');
    }

    /**
     * Get the class teacher
     */
    public function classTeacher()
    {
        return $this->belongsTo(Teacher::class, 'class_teacher_id');
    }

    /**
     * Get students in this class stream
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'class_stream_id');
    }

    /**
     * Get subjects assigned to this class stream
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject', 'class_stream_id', 'subject_id')
                    ->withPivot('teacher_id')
                    ->withTimestamps();
    }
}