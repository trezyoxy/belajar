<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Menentukan kolom yang bisa diisi secara massal
    protected $fillable = ['title', 'description', 'file_path'];

}
return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan!');
