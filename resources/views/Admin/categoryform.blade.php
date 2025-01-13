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
    <div class="container-fluid">
        <div class="card content-card">
            <div class="card-header">

            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Category Name" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <h6>Subcategories</h6>
                    <div id="subcategory-container">
                        <div class="mb-3 d-flex align-items-center subcategory-input">
                            <input type="text" class="form-control" name="subcategories[]"
                                placeholder="Enter Subcategory Name">
                            <button type="button" class="btn btn-danger ms-2 remove-subcategory"
                                style="display:none;">Remove</button>
                        </div>
                    </div>
                    <button type="button" id="add-subcategory" class="btn btn-secondary btn-sm mb-3">
                        + Add Subcategory
                    </button>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
