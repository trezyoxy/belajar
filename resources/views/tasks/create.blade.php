@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create New Task</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Task Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Task Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter task description"></textarea>
                </div>

                <!-- File Upload -->
                <div class="mb-3">
                    <label for="file" class="form-label fw-bold">Upload File (Optional)</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>

                <!-- Submit & Cancel Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
