<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'sort_order',
        'level_teacher_id',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(ClassCategory::class, 'category_id');
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'class_level_id');
    }

    public function levelTeacher()
    {
        return $this->belongsTo(Teacher::class, 'level_teacher_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}