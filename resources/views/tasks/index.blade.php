@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Task Manager</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Task List</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="align-middle">{{ $task->id }}</td>
                            <td class="align-middle">{{ $task->title }}</td>
                            <td class="align-middle">{{ $task->description }}</td>
                            <td class="align-middle">
                                @if ($task->file_path)
                                    <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        View File
                                    </a>
                                @else
                                    <span class="text-muted">No File</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#taskModal{{ $task->id }}">
                                    View
                                </button>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal View Task -->
                        <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1" aria-labelledby="taskModalLabel{{ $task->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="taskModalLabel{{ $task->id }}">{{ $task->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Description:</strong> {{ $task->description }}</p>

                                        <!-- Menampilkan file yang di-upload -->
                                        @if($task->file_path)
                                            <p><strong>Uploaded File:</strong></p>
                                            @if (in_array(pathinfo($task->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset('storage/' . $task->file_path) }}" class="img-fluid rounded shadow-sm">
                                            @else
                                                <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank" class="btn btn-primary">
                                                    Download File
                                                </a>
                                            @endif
                                        @else
                                            <p class="text-muted">No file uploaded.</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
