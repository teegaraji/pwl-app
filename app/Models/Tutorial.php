<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course_code',
        'kode_matkul', // Tambahkan ini
        'nama_matkul', // Tambahkan ini
        'url_presentation',
        'url_finished',
        'creator_email',
    ];

    // Relasi: Satu Tutorial punya banyak Detail
    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
