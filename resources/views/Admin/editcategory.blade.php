@extends('layouts.admin.master')

@section('title', 'Add Category')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <style>
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            padding: 15px;
            border-top: 1px solid #eee;
            background: #f8f9fa;
        }

        @media (max-width: 576px) {
            .button-group {
                flex-direction: column;
                gap: 15px;
            }

            .action-btn {
                width: 100%;
                text-align: center;
            }
        }

        .action-btn {
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-block;
        }

        .subcategory-input {
            margin-bottom: 15px;
        }

        @media (max-width: 576px) {
            .subcategory-input {
                flex-direction: column;
                gap: 10px;
            }

            .subcategory-input .btn {
                width: 100%;
            }

            .remove-subcategory {
                margin-left: 0 !important;
            }
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Edit Category</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $category->name) }}" placeholder="Enter Category Name" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-4">
                    <h4 class="mb-3">Subcategories</h4>
                    <div id="subcategory-container">
                        @if ($category->subcategories->count() > 0)
                            @foreach ($category->subcategories as $subcategory)
                                <div class="mb-3 d-flex align-items-center subcategory-input">
                                    <input type="text" class="form-control" name="subcategories[]"
                                        value="{{ $subcategory->name }}" placeholder="Enter Subcategory Name">
                                    <button type="button" class="btn btn-danger ms-2 remove-subcategory">Remove</button>
                                </div>
                            @endforeach
                        @else
                            <div class="mb-3 d-flex align-items-center subcategory-input">
                                <input type="text" class="form-control" name="subcategories[]"
                                    placeholder="Enter Subcategory Name">
                                <button type="button" class="btn btn-danger ms-2 remove-subcategory"
                                    style="display:none;">Remove</button>
                            </div>
                        @endif
                    </div>

                    <button type="button" id="add-subcategory" class="btn btn-secondary">
                        + Add Subcategory
                    </button>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary action-btn">Update Category</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary action-btn">Cancel</a>
                </div>
            </form>
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
