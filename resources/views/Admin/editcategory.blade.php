@extends('layouts.admin.master')

@section('title', 'Add Category')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Add Category</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Add Category</li>
@endsection
@section('content')
    <h1>Edit Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Category Form -->
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Category Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $category->name) }}" placeholder="Enter Category Name" required>
        </div>

        <!-- Status Dropdown -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <!-- Subcategories Section -->
        <h4 class="mb-3">Subcategories</h4>
        <div id="subcategory-container">
            @if ($category->subcategories->count() > 0)
                @foreach ($category->subcategories as $subcategory)
                    <div class="mb-3 d-flex align-items-center subcategory-input">
                        <input type="text" class="form-control" name="subcategories[]" value="{{ $subcategory->name }}"
                            placeholder="Enter Subcategory Name">
                        <button type="button" class="btn btn-danger ms-2 remove-subcategory">Remove</button>
                    </div>
                @endforeach
            @else
                <!-- Default Subcategory Input -->
                <div class="mb-3 d-flex align-items-center subcategory-input">
                    <input type="text" class="form-control" name="subcategories[]" placeholder="Enter Subcategory Name">
                    <button type="button" class="btn btn-danger ms-2 remove-subcategory"
                        style="display:none;">Remove</button>
                </div>
            @endif
        </div>

        <!-- Add Subcategory Button -->
        <button type="button" id="add-subcategory" class="btn btn-secondary btn-sm mb-3">
            + Add Subcategory
        </button>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>

    <!-- JavaScript for Adding/Removing Subcategories -->
    <script>
        document.getElementById('add-subcategory').addEventListener('click', function() {
            const container = document.getElementById('subcategory-container');

            // Create subcategory input field
            const inputGroup = document.createElement('div');
            inputGroup.classList.add('mb-3', 'd-flex', 'align-items-center', 'subcategory-input');

            inputGroup.innerHTML = `
                    <input type="text" class="form-control" name="subcategories[]" placeholder="Enter Subcategory Name">
                    <button type="button" class="btn btn-danger ms-2 remove-subcategory">Remove</button>
                `;

            container.appendChild(inputGroup);

            // Add event listener to the remove button
            inputGroup.querySelector('.remove-subcategory').addEventListener('click', function() {
                inputGroup.remove();
            });
        });

        // Handle existing remove buttons
        document.querySelectorAll('.remove-subcategory').forEach(button => {
            button.addEventListener('click', function() {
                button.parentElement.remove();
            });
        });
    </script>
@endsection
@section('script')
    <script>
        document.getElementById('add-subcategory').addEventListener('click', function() {
            const container = document.getElementById('subcategory-container');

            const inputGroup = document.createElement('div');
            inputGroup.classList.add('mb-3', 'd-flex', 'align-items-center', 'subcategory-input');

            inputGroup.innerHTML = `
                <input type="text" class="form-control" name="subcategories[]" placeholder="Enter Subcategory Name">
                <button type="button" class="btn btn-danger ms-2 remove-subcategory">Remove</button>
            `;

            container.appendChild(inputGroup);

            inputGroup.querySelector('.remove-subcategory').addEventListener('click', function() {
                inputGroup.remove();
            });
        });

        document.querySelectorAll('.remove-subcategory').forEach(button => {
            button.addEventListener('click', function() {
                button.parentElement.remove();
            });
        });
    </script>
@endsection
