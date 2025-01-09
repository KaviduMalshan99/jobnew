@extends('layouts.employer.master')

@section('title', 'Job')

@section('css')

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
            <div id="contacts-container">
                <div class="mb-3">
                    <label for="package_id" class="form-label">Package</label>
                    <select name="package_id" id="package_id" class="form-control" required>
                        <option value="">Select a package</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">
                                {{ $package->package_size }}ads - Rs. {{ $package->lkr_price }}/{{ $package->usd_price }}USD
                                ({{ $package->duration_days }} days)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="contact-item">


                    <div class="mb-3">
                        <label for="title_0" class="form-label">Job Title</label>
                        <input type="text" name="job_postings[0][title]" id="title_0" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description_0" class="form-label">Description</label>
                        <textarea name="job_postings[0][description]" id="description_0" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category_id_0" class="form-label">Category</label>
                        <select name="job_postings[0][category_id]" id="category_id_0" class="form-control category-select"
                            required>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subcategory_id_0" class="form-label">Subcategory</label>
                        <select name="job_postings[0][subcategory_id]" id="subcategory_id_0" class="form-control" required>
                            <option value="">Select a subcategory</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="location_0" class="form-label">Location</label>
                        <input type="text" name="job_postings[0][location]" id="location_0" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="salary_range_0" class="form-label">Salary Range</label>
                        <input type="number" name="job_postings[0][salary_range]" id="salary_range_0" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="image_0" class="form-label">Image</label>
                        <input type="file" name="job_postings[0][image]" id="image_0" class="form-control image-input"
                            accept="image/*">
                        <div class="image-preview-container mt-3">
                            <img class="image-preview" src="" alt="Image Preview"
                                style="max-width: 100%; display: none;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="requirements_0" class="form-label">Requirements</label>
                        <textarea name="job_postings[0][requirements]" id="requirements_0" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="closing_date_0" class="form-label">Closing Date</label>
                        <input type="date" name="job_postings[0][closing_date]" id="closing_date_0" class="form-control"
                            required>
                    </div>

                    <input type="hidden" name="job_postings[0][status]" value="pending">
                </div>
            </div>

            <button type="button" id="addContact" class="btn btn-success mb-3">Add Another Job</button>
            <button type="submit" class="btn btn-primary">Create Jobs</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let contactIndex = 1;

            // Handle category change for initial form
            setupCategoryListener(document.querySelector('.category-select'));

            // Add new job form
            document.getElementById('addContact').addEventListener('click', function() {
                const container = document.getElementById('contacts-container');
                const newContact = document.createElement('div');
                newContact.className = 'contact-item';

                newContact.innerHTML = `
            <span class="remove-contact">&times;</span>


            <div class="mb-3">
                <label for="title_${contactIndex}" class="form-label">Job Title</label>
                <input type="text" name="job_postings[${contactIndex}][title]" id="title_${contactIndex}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description_${contactIndex}" class="form-label">Description</label>
                <textarea name="job_postings[${contactIndex}][description]" id="description_${contactIndex}" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id_${contactIndex}" class="form-label">Category</label>
                <select name="job_postings[${contactIndex}][category_id]" id="category_id_${contactIndex}" class="form-control category-select" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="subcategory_id_${contactIndex}" class="form-label">Subcategory</label>
                <select name="job_postings[${contactIndex}][subcategory_id]" id="subcategory_id_${contactIndex}" class="form-control" required>
                    <option value="">Select a subcategory</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="location_${contactIndex}" class="form-label">Location</label>
                <input type="text" name="job_postings[${contactIndex}][location]" id="location_${contactIndex}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="salary_range_${contactIndex}" class="form-label">Salary Range</label>
                <input type="number" name="job_postings[${contactIndex}][salary_range]" id="salary_range_${contactIndex}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="image_${contactIndex}" class="form-label">Image</label>
                <input type="file" name="job_postings[${contactIndex}][image]" id="image_${contactIndex}" class="form-control image-input" accept="image/*">
                <div class="image-preview-container mt-3">
                    <img class="image-preview" src="" alt="Image Preview" style="max-width: 100%; display: none;">
                </div>
            </div>

            <div class="mb-3">
                <label for="requirements_${contactIndex}" class="form-label">Requirements</label>
                <textarea name="job_postings[${contactIndex}][requirements]" id="requirements_${contactIndex}" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="closing_date_${contactIndex}" class="form-label">Closing Date</label>
                <input type="date" name="job_postings[${contactIndex}][closing_date]" id="closing_date_${contactIndex}" class="form-control" required>
            </div>

            <input type="hidden" name="job_postings[${contactIndex}][status]" value="pending">
        `;

                container.appendChild(newContact);

                // Setup listeners for the new form
                setupCategoryListener(newContact.querySelector('.category-select'));
                setupImagePreview(newContact.querySelector('.image-input'));

                contactIndex++;
            });

            // Remove contact form
            document.getElementById('contacts-container').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-contact')) {
                    e.target.closest('.contact-item').remove();
                }
            });

            // Setup category change listener
            // Fixed setupCategoryListener function
            function setupCategoryListener(categorySelect) {
                categorySelect.addEventListener('change', function() {
                    const categoryId = this.value;
                    const contactItem = this.closest('.contact-item');
                    // Fixed selector to match the correct name format with job_postings array
                    const subcategorySelect = contactItem.querySelector('select[id^="subcategory_id_"]');

                    // Clear existing options
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
            }
            // Setup image preview
            function setupImagePreview(input) {
                input.addEventListener('change', function(event) {
                    const preview = this.nextElementSibling.querySelector('.image-preview');
                    const file = event.target.files[0];

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.style.display = 'none';
                    }
                });
            }

            // Setup initial image preview
            document.querySelectorAll('.image-input').forEach(setupImagePreview);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const packageSelect = document.getElementById("package_id");
            const addJobButton = document.getElementById("addContact");
            const contactsContainer = document.getElementById("contacts-container");
            let maxJobs = 0;

            packageSelect.addEventListener("change", function() {
                const selectedOption = packageSelect.options[packageSelect.selectedIndex];
                if (selectedOption.value) {
                    maxJobs = parseInt(selectedOption.getAttribute("data-max-jobs"), 10);
                } else {
                    maxJobs = 0;
                }
                validateJobLimit();
            });

            addJobButton.addEventListener("click", function() {
                if (contactsContainer.children.length >= maxJobs) {
                    alert(`You cannot add more than ${maxJobs} jobs for this package.`);
                    return;
                }

                // Add job logic here
            });

            function validateJobLimit() {
                const currentJobs = contactsContainer.children.length;
                if (currentJobs >= maxJobs) {
                    addJobButton.disabled = true;
                    alert(`You have reached the maximum job limit (${maxJobs}) for this package.`);
                } else {
                    addJobButton.disabled = false;
                }
            }
        });
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

@endsection
