@extends('layouts.app')

@section('content')
    <h2>Create Task</h2>
    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required><br>
    
        <label>Description:</label>
        <textarea name="description"></textarea><br>
    
        <label>File (Optional):</label>
        <input type="file" name="file" id="fileInput" onchange="previewFile()"><br>

        <label>Category:</label>
        <select name="category" class="form-control">
            <option value="Work">Work</option>
            <option value="Personal">Personal</option>
            <option value="Other">Other</option>
        </select><br>

    
        <!-- Preview File -->
        <div id="filePreview" style="margin-top: 10px;"></div>
    
        <button type="submit">Create Task</button>
    </form>
    
    <script>
    function previewFile() {
        let file = document.getElementById("fileInput").files[0];
        let preview = document.getElementById("filePreview");
        preview.innerHTML = ""; // Reset preview
    
        if (file) {
            let reader = new FileReader();
    
            reader.onload = function(e) {
                let fileType = file.type;
    
                if (fileType.startsWith("image")) {
                    let img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.maxWidth = "200px";
                    img.style.borderRadius = "5px";
                    img.style.boxShadow = "0px 0px 10px rgba(0,0,0,0.2)";
                    preview.appendChild(img);
                } else {
                    let fileName = document.createElement("p");
                    fileName.innerText = "Selected File: " + file.name;
                    preview.appendChild(fileName);
                }
            };
    
            reader.readAsDataURL(file);
        }
    }
    </script>
    
@endsection
