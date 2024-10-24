<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
