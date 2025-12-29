<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function classStreams()
    {
        return $this->hasMany(ClassStream::class, 'stream_id');
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