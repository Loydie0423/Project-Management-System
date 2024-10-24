<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectResources extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'uploader_id',
        'title',
        'description',
        'type',
        'image_path',
        'link'
    ];

    public function type(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value)
        );
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
