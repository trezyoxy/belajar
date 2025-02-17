<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    // Menampilkan semua tugas
    public function index()
    {
        $tasks = Task::all(); // Ambil semua data dari tabel tasks
        return view('tasks.index', compact('tasks'));
    }

    // Menampilkan form untuk menambahkan tugas baru
    public function create()
    {
        return view('tasks.create');
    }
    
    // Menyimpan tugas baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,docx|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath, // Menyimpan path file ke database
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil ditambahkan!');
    }

    

    // Menampilkan satu tugas berdasarkan ID
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    // Menampilkan form edit tugas
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // Menyimpan perubahan tugas
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        // Update data di database
        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    // Menghapus tugas
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus!');

    }

    

    
    
   

    
}
