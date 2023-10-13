<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateDocument extends Model
{
    protected $table = 'template_documents';
    protected $fillable = [
        'name',
        'status',
        'type',
        'view',
    ];
}
