<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'manager_id',
        'code',
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'current_status',
        'readme'
    ];

    public function startDateTime(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('F d, Y', strtotime($value))
        );
    }

    public function endDateTime(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('F d, Y', strtotime($value))
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('F d, Y', strtotime($value))
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    public function collaborators(): HasMany
    {
        return $this->hasMany(ProjectCollaborator::class, 'project_id');
    }

    public function resources(): HasMany
    {
        return $this->hasMany(ProjectResources::class, 'project_id');
    }

    public function updates(): HasMany
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(ProjectAnnouncement::class, 'project_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
