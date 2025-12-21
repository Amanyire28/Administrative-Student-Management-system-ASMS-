<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'priority',
        'type',
        'is_active',
        'expires_at',
        'created_by',
    ];

    protected $casts = [
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function ($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>=', now()->toDateString());
                    });
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at < now()->toDateString();
    }

    public function getPriorityBadgeClass()
    {
        return match($this->priority) {
            'high' => 'bg-danger',
            'medium' => 'bg-warning',
            'low' => 'bg-info',
            default => 'bg-secondary'
        };
    }

    public function getTypeBadgeClass()
    {
        return match($this->type) {
            'urgent' => 'bg-danger',
            'academic' => 'bg-primary',
            'event' => 'bg-success',
            'general' => 'bg-secondary',
            default => 'bg-secondary'
        };
    }
}
