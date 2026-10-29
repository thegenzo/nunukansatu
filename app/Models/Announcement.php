<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'message', 'reference_number', 'published_on',
        'is_active', 'show_qr', 'starts_at', 'ends_at',
        'pdf_disk', 'pdf_path', 'pdf_file_name', 'pdf_url',
    ];

    protected $casts = [
        'is_active' => 'boolean', 'show_qr' => 'boolean',
        'published_on' => 'date', 'starts_at' => 'datetime', 'ends_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $announcement) {
            $announcement->public_id ??= (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'public_id';
    }

    public function scopeVisible(Builder $query): Builder
    {
        $now = now();

        return $query->where('is_active', true)
            ->where(fn (Builder $q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now))
            ->where(fn (Builder $q) => $q->whereNull('ends_at')->orWhere('ends_at', '>', $now));
    }

    public function isCurrentlyVisible(): bool
    {
        $now = now();

        return $this->is_active
            && (! $this->starts_at || $this->starts_at->lte($now))
            && (! $this->ends_at || $this->ends_at->gt($now));
    }
}
