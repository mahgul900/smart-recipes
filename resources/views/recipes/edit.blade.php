@extends('layouts.app')

@section('content')

<style>
body {
  font-family: 'Quicksand', sans-serif;
  background-color: #fef9f4;
  color: #3e2f21;
}
.dropdown-item{
    color: white;
    font-weight: bold;
}
.dropdown-item:hover{
    color:rgb(205, 208, 208) !important;
    font-weight:bold;
}

.dropdown-menu{
    background-color: #5c3d2e;
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
.dropdown-toggle{
    text-transform: uppercase !important;
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

.form {
  color: black;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 10px;
}

label.block {
  display: block;
  font-weight: 600;
  font-size: 16px;
  margin: 20px 0px 8px 0px;
  color: black;
}
input[type="text"], input[type="file"] {
    font-size: 17px;
  background-color: white;
  border: 1px solid #dac4a2;
  color: black;
  resize: none;
  border-radius: 8px;
  padding: 10px 14px;
  width: 100%;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}
textarea{
    font-size: 16px;
  background-color: white;
  border: 1px solid #dac4a2;
  color: black;
  resize: none;
  border-radius: 8px;
  padding: 10px 14px;
  width: 100%;
  height: 250px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input:focus,
textarea:focus {
  border-color: #5c3d2e;
  box-shadow: 0 0 0 2px rgba(92, 61, 46, 0.1);
  outline: none;
}
.h2, h2{
    font-size: 24px;
    font-weight: 600;
    color: black;
    margin-bottom: 20px;
}

</style>


    <div style="max-width: 600px; margin: auto;">
        <h2>Edit Recipe</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('recipes.update', $recipe->id) }}">
            @csrf
            @method('PUT')

            <label class="form">Title:</label><br>
            <input type="text" name="title" value="{{ old('title', $recipe->title) }}" required style="width:100%;"><br><br>

            <label class="form">Ingredients:</label><br>
            <textarea name="ingredients" rows="5" required style="width:100%;">{{ old('ingredients', $recipe->ingredients) }}</textarea><br><br>

            <label class="form">Steps:</label><br>
            <textarea name="steps" rows="5" required style="width:100%;">{{ old('steps', $recipe->steps) }}</textarea><br><br>

            <button type="submit" class="btn px-6 py-2 rounded shadow">💾 Update Recipe</button>
        </form>
        <br>
        <a href="{{ route('recipes.list') }}" class="btn px-6 py-2 rounded shadow">⬅ Back to All Recipes</a>
    </div>
@endsection

