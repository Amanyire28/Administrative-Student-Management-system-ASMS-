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
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_subject')
                    ->withPivot('teacher_id')
                    ->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'class_subject')
                    ->withPivot('class_id')
                    ->withTimestamps();
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
