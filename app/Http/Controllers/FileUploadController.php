<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
    
        // Simpan file ke dalam storage/app/public/uploads/
        $path = $request->file('file')->store('public/uploads');
    
        return response()->json([
            'message' => 'File berhasil diunggah!',
            'file_path' => Storage::url($path)
        ]);
    }
    
}

