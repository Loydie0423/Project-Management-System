<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id');
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('M d, Y h:i:s A', strtotime($value))
        );
    }
}
