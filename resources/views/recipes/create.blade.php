@extends('layouts.app')

@section('content')

<style>
body {
  font-family: 'Quicksand', sans-serif;
  background-color: #fef9f4;
  color: #3e2f21;
}

.navbar {
  background-color: #5c3d2e;
  position: sticky;
  top: 0;
  z-index: 1030;
}

.navbar a, .nav-link {
  color: white !important;
  font-weight: 600;
}

.navbar-brand {
  color: white !important;
  font-weight: 700;
  font-size: 28px;
  text-transform: uppercase !important;
}

.navbar a:hover {
  color: rgb(205, 208, 208) !important;
}

.navbar-toggler {
  background-color: white;
}

.dropdown-toggle {
  text-transform: uppercase !important;
}

.dropdown-item {
  color: white;
  font-weight: bold;
}

.dropdown-item:hover {
  color: rgb(205, 208, 208) !important;
  font-weight: bold;
}

.dropdown-menu {
  background-color: #5c3d2e;
}

.btn {
  background-color: #5c3d2e;
  color: white;
  border: none;
}

.btn:hover {
  background-color: #3e2f21;
  color: white;
}

label.block {
  display: block;
  font-weight: 600;
  font-size: 15px;
  margin: 12px 0px 5px 0px;
  color: black;
}

input[type="text"], input[type="file"] {
  background-color: white;
  border: 1px solid #dac4a2;
  color: black;
  border-radius: 8px;
  padding: 8px 12px;
  width: 100%;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

textarea {
  background-color: white;
  border: 1px solid #dac4a2;
  color: black;
  resize: vertical;
  border-radius: 8px;
  padding: 8px 12px;
  width: 100%;
  height: 100px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input:focus,
textarea:focus {
  border-color: #5c3d2e;
  box-shadow: 0 0 0 2px rgba(92, 61, 46, 0.1);
  outline: none;
}
</style>

<div class="container" style="max-width: 680px; padding: 1.5rem 1rem;">
    <h2 class="fw-bold mb-3" style="font-size: 1.5rem;">Submit a New Recipe</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="title" class="block">Recipe Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label for="ingredients" class="block">Ingredients</label>
            <textarea name="ingredients" id="ingredients" rows="3" required>{{ old('ingredients') }}</textarea>
        </div>

        <div>
            <label for="steps" class="block">Steps</label>
            <textarea name="steps" id="steps" rows="4" required>{{ old('steps') }}</textarea>
        </div>

        <div>
            <label for="images" class="block">Upload Images (optional)</label>
            <input type="file" name="images[]" id="images" multiple accept="image/*">
            <div id="preview" class="d-flex flex-wrap gap-2 mt-2"></div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn px-4 py-2 rounded">Submit Recipe</button>
        </div>

    </form>
</div>

<script>
    document.getElementById('images').addEventListener('change', function (event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        Array.from(event.target.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.cssText = 'height:80px; width:80px; object-fit:cover; border-radius:8px; border:1px solid #dac4a2;';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

@endsection