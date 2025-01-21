@extends('layouts.admin.master')

@section('title', 'Create Banner')

@section('css')
    <style>
        .image-preview-container {
            margin-top: 15px;
            border: 2px dashed #ddd;
            border-radius: 6px;
            padding: 15px;
            text-align: center;
            background: #f8f9fa;
        }

        .image-preview-container img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .preview-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 10px;
            display: block;
        }


        .payment-methods .form-check {
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-methods .form-check:hover {
            background-color: #f8f9fa;
            border-color: #0d6efd;
        }

        .payment-methods .form-check-input:checked+.form-check-label {
            font-weight: bold;
        }

        .image-preview {
            max-width: 300px;
            margin-top: 10px;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Banners</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Create Banner</li>
@endsection

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Banner</h5>
                    </div>
                    <div class="card-body">
                        <form id="bannerForm" action="{{ route('banners.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="package_id" class="form-label">Package</label>
                                <select name="package_id" class="form-control">
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">
                                            {{ ucfirst($package->duration) }} - LKR {{ $package->price_lkr }} / USD
                                            {{ $package->price_usd }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Banner Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Banner Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                    required>
                                <div class="image-preview-container mt-2">
                                    <img id="imagePreview" src="" alt="Preview"
                                        style="display: none; max-width: 100%;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="placement" class="form-label">Banner Placement</label>
                                <select name="placement" id="placement" class="form-control" required>
                                    <option value="banner">Main Banner</option>
                                    <option value="category_page">Category Page</option>
                                </select>
                            </div>

                            <div class="mb-3" id="categorySection" style="display: none;">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Create Banner</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Method Modal -->
    <div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentMethodModalLabel">Select Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="payment-methods">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="contactAdmin"
                                value="contact_admin">
                            <label class="form-check-label" for="contactAdmin">
                                Contact Admin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="onlinePayment"
                                value="online">
                            <label class="form-check-label" for="onlinePayment">
                                Online Payment
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmPayment">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('bannerForm');
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentMethodModal'));

            // Image preview handler
            document.getElementById('image').addEventListener('change', function(event) {
                const preview = document.getElementById('imagePreview');
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

            // Form submission handler
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                paymentModal.show();
            });

            // Payment confirmation handler
            document.getElementById('confirmPayment').addEventListener('click', function() {
                const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

                if (!selectedPaymentMethod) {
                    alert('Please select a payment method');
                    return;
                }

                // Add payment method to form
                const paymentMethodInput = document.createElement('input');
                paymentMethodInput.type = 'hidden';
                paymentMethodInput.name = 'payment_method';
                paymentMethodInput.value = selectedPaymentMethod.value;
                form.appendChild(paymentMethodInput);

                if (selectedPaymentMethod.value === 'contact_admin') {
                    // Submit form directly for admin contact
                    paymentModal.hide();
                    form.submit();
                } else {
                    // For online payment, redirect to payment gateway
                    const formData = new FormData(form);
                    fetch('/store-banner-data', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = '/payment/checkout';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        });
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const placementSelect = document.getElementById('placement');
            const categorySection = document.getElementById('categorySection');
            const categorySelect = document.getElementById('category_id');

            // Function to toggle category field
            function toggleCategoryField() {
                if (placementSelect.value === 'category_page') {
                    categorySection.style.display = 'block';
                    categorySelect.required = true;
                } else {
                    categorySection.style.display = 'none';
                    categorySelect.required = false;
                    categorySelect.value = ''; // Reset category selection
                }
            }

            // Initial check
            toggleCategoryField();

            // Add event listener for placement changes
            placementSelect.addEventListener('change', toggleCategoryField);
        });
    </script>
@endsection
