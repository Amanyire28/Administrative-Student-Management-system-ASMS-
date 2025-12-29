<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'default_classes',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'default_classes' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get the class levels for this school type
     */
    public function classLevels()
    {
        return $this->hasMany(ClassLevel::class)->orderBy('sort_order');
    }

    /**
     * Get active class levels for this school type
     */
    public function activeClassLevels()
    {
        return $this->hasMany(ClassLevel::class)->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Scope to get only active school types
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
     * Get the default classes as an array
     */
    public function getDefaultClassesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Set the default classes as JSON
     */
    public function setDefaultClassesAttribute($value)
    {
        $this->attributes['default_classes'] = is_array($value) ? json_encode($value) : $value;
    }

    /**
     * Get a code-like identifier from the name
     */
    public function getCodeAttribute()
    {
        return strtolower(str_replace([' ', '-'], ['_', '_'], $this->name));
    }
}