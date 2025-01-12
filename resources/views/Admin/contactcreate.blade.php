@extends('layouts.admin.master')

@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Contact</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Contact</li>
@endsection

@section('content')
    <div class="container">
        <h1>{{ isset($contactus) ? 'Edit Contact Details' : 'Add Contact Details' }}</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ isset($contactus) ? route('contactus.update', $contactus->id) : route('contactus.store') }}"
                    method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @if (isset($contactus))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ $contactus->email ?? old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="valid-feedback">Looks good!</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ $contactus->phone ?? old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="valid-feedback">Looks good!</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" required>{{ $contactus->address ?? old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="valid-feedback">Looks good!</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-12">
                            <label for="logo_img" class="form-label">Logo</label>
                            <input type="file" name="logo_img" id="logo_img"
                                class="form-control @error('logo_img') is-invalid @enderror" onchange="previewLogo(event)">
                            @if (isset($contactus) && $contactus->logo_img)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $contactus->logo_img) }}" alt="Logo"
                                        class="img-fluid" style="max-width: 200px; max-height: 200px; object-fit: contain;">
                                </div>
                            @endif
                            <div id="logoPreview" class="mt-3">
                                <!-- Preview will be displayed here -->
                            </div>
                            @error('logo_img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="termsCheck" required>
                        <label class="form-check-label" for="termsCheck">
                            Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">
                        {{ isset($contactus) ? 'Update' : 'Create' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function previewLogo(event) {
            const preview = document.getElementById('logoPreview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML =
                    `<img src="${e.target.result}" alt="Logo Preview" class="img-fluid" style="max-width: 200px; max-height: 200px; object-fit: contain;">`;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        document.getElementById('logo_img').addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.size > 2048 * 1024) { // 2 MB limit
                alert('The logo image size must not exceed 2 MB.');
                this.value = ''; // Clear the file input
            }
        });
    </script>
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
@endsection
