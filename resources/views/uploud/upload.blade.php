@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Upload File</h2>
        <form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Pilih File:</label>
                <input type="file" class="form-control" name="file" id="file" required>
            </div>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>
    </div>
@endsection
