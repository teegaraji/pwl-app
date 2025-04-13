<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutorial_id',
        'text',
        'image',
        'code',
        'url',
        'order',
        'status',
    ];

    // Relasi: Detail milik satu Tutorial
    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}
