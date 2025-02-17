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
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Menampilkan form untuk menambahkan tugas baru
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048'
        ]);

        // Simpan file jika ada
        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->store('tasks', 'public');
        }

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $fileName,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tasks.index')->with('message', 'Task berhasil ditambahkan!');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048'
        ]);

        // Simpan file baru jika ada
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($task->file) {
                Storage::disk('public')->delete($task->file);
            }
            $fileName = $request->file('file')->store('tasks', 'public');
            $task->file = $fileName;
        }

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $task->file,
        ]);

        return redirect()->route('tasks.index')->with('message', 'Task berhasil diperbarui!');
    }

    public function destroy(Task $task)
    {
        if ($task->file) {
            Storage::disk('public')->delete($task->file);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task dan file berhasil dihapus!');
    }

    public function download(Task $task)
    {
        if (auth()->id() !== $task->user_id) {
            abort(403, "You do not have permission to access this file.");
        }

        return response()->download(storage_path("app/public/" . $task->file));
    }
}
