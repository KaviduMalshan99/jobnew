@extends('layouts.admin.master')

@section('title', 'Job')

@section('css')
    <style>
        .custom-select-wrapper {
            position: relative;
        }

        .custom-select-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            max-height: 280px;
            overflow-y: auto;
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            margin-top: 5px;
        }

        .custom-select-option {
            padding: 8px 15px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .custom-select-option:hover,
        .custom-select-option.highlighted {
            background-color: #f8f9fa;
        }

        .custom-select-option.selected {
            background-color: #e9ecef;
        }

        /* Scrollbar Styling */
        .custom-select-dropdown::-webkit-scrollbar {
            width: 6px;
        }

        .custom-select-dropdown::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .custom-select-dropdown::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .custom-select-dropdown::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Active state for dropdown */
        .custom-select-dropdown.show {
            display: block;
        }
    </style>

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Jobs</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Create Job</li>
@endsection

@section('content')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1>Create Job Posting</h1>
        <form action="{{ route('admin.job_postings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group position-relative">
                <label for="employer_id" class="form-label">Employer</label>

                <!-- Hidden select -->
                <select name="employer_id" id="employer_id" class="d-none" required>
                    @foreach ($employers as $employer)
                        <option value="{{ $employer->id }}">{{ $employer->company_name }}</option>
                    @endforeach
                </select>

                <!-- Custom dropdown -->
                <div class="custom-select-wrapper">
                    <input type="text" id="employerSearch" class="form-control" placeholder="Search employer...">

                    <div id="employerList" class="custom-select-dropdown">
                        @foreach ($employers as $employer)
                            <div class="custom-select-option" data-value="{{ $employer->id }}">
                                {{ $employer->company_name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                    required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>


                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subcategory_id" class="form-label">Subcategory</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                    <option value="">Select a subcategory</option>

                </select>
                @error('subcategory_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}"
                    required>
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="salary_range" class="form-label">Salary Range</label>
                <input type="number" name="salary_range" id="salary_range" class="form-control"
                    value="{{ old('salary_range') }}">
                @error('salary_range')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <div id="imagePreviewContainer" class="mt-3">
                    <img id="imagePreview" src="" alt="Image Preview" style="max-width: 100%; display: none;">
                </div>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="requirements" class="form-label">Requirements</label>
                <textarea name="requirements" id="requirements" class="form-control" rows="4" required>{{ old('requirements') }}</textarea>
                @error('requirements')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>




            <div class="mb-3">
                <label for="closing_date" class="form-label">Closing Date</label>
                <input type="date" name="closing_date" id="closing_date" class="form-control"
                    value="{{ old('closing_date') }}" required>
                @error('closing_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="hidden" name="status" value="pending">
            </div>

            {{-- <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="reject">Reject</option>
                    <option value="approved">Approved</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

            <button type="submit" class="btn btn-primary">Create Job</button>
        </form>
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/clock.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            const subcategorySelect = document.getElementById('subcategory_id');

            // Clear existing subcategory options
            subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';

            if (categoryId) {
                fetch(`/subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            }
        });
    </script>
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('employerSearch');
            const employerList = document.getElementById('employerList');
            const selectElement = document.getElementById('employer_id');
            const options = document.querySelectorAll('.employer-option');

            // Show dropdown on input focus
            searchInput.addEventListener('focus', () => {
                employerList.classList.remove('hidden');
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !employerList.contains(e.target)) {
                    employerList.classList.add('hidden');
                }
            });

            // Filter options based on search input
            searchInput.addEventListener('input', (e) => {
                const searchText = e.target.value.toLowerCase();

                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    option.style.display = text.includes(searchText) ? 'block' : 'none';
                });

                employerList.classList.remove('hidden');
            });

            // Handle option selection
            options.forEach(option => {
                option.addEventListener('click', () => {
                    const value = option.getAttribute('data-value');
                    const text = option.textContent.trim();

                    searchInput.value = text;
                    selectElement.value = value;
                    employerList.classList.add('hidden');

                    // Trigger change event on the original select
                    const event = new Event('change');
                    selectElement.dispatchEvent(event);
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('employerSearch');
            const employerList = document.getElementById('employerList');
            const selectElement = document.getElementById('employer_id');
            const options = document.querySelectorAll('.custom-select-option');
            let selectedIndex = -1;

            // Initial value setup
            if (selectElement.value) {
                const selectedOption = Array.from(options).find(opt =>
                    opt.getAttribute('data-value') === selectElement.value
                );
                if (selectedOption) {
                    searchInput.value = selectedOption.textContent.trim();
                    selectedOption.classList.add('selected');
                }
            }

            // Show dropdown on focus
            searchInput.addEventListener('focus', () => {
                employerList.classList.add('show');
            });

            // Handle outside clicks
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !employerList.contains(e.target)) {
                    employerList.classList.remove('show');
                }
            });

            // Filter options
            searchInput.addEventListener('input', (e) => {
                const searchText = e.target.value.toLowerCase();
                let visibleOptions = 0;

                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    const isVisible = text.includes(searchText);
                    option.style.display = isVisible ? 'block' : 'none';
                    if (isVisible) visibleOptions++;
                });

                employerList.classList.toggle('show', visibleOptions > 0);
                selectedIndex = -1;
                updateHighlight();
            });

            // Keyboard navigation
            searchInput.addEventListener('keydown', (e) => {
                const visibleOptions = Array.from(options).filter(
                    opt => opt.style.display !== 'none'
                );

                switch (e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        selectedIndex = Math.min(selectedIndex + 1, visibleOptions.length - 1);
                        updateHighlight(visibleOptions);
                        break;

                    case 'ArrowUp':
                        e.preventDefault();
                        selectedIndex = Math.max(selectedIndex - 1, -1);
                        updateHighlight(visibleOptions);
                        break;

                    case 'Enter':
                        e.preventDefault();
                        if (selectedIndex >= 0 && visibleOptions[selectedIndex]) {
                            selectOption(visibleOptions[selectedIndex]);
                        }
                        break;

                    case 'Escape':
                        employerList.classList.remove('show');
                        break;
                }
            });

            // Option selection
            options.forEach(option => {
                option.addEventListener('click', () => {
                    selectOption(option);
                });

                option.addEventListener('mouseover', () => {
                    selectedIndex = Array.from(options).indexOf(option);
                    updateHighlight();
                });
            });

            function selectOption(option) {
                options.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');

                searchInput.value = option.textContent.trim();
                selectElement.value = option.getAttribute('data-value');
                employerList.classList.remove('show');

                selectElement.dispatchEvent(new Event('change'));
            }

            function updateHighlight(visibleOptions = Array.from(options).filter(
                opt => opt.style.display !== 'none'
            )) {
                options.forEach(opt => opt.classList.remove('highlighted'));
                if (selectedIndex >= 0 && visibleOptions[selectedIndex]) {
                    visibleOptions[selectedIndex].classList.add('highlighted');
                    visibleOptions[selectedIndex].scrollIntoView({
                        block: 'nearest',
                        behavior: 'smooth'
                    });
                }
            }
        });
    </script>


@endsection
