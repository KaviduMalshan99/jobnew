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
    <h1>{{ isset($contactus) ? 'Edit Contact Details' : 'Add Contact Details' }}</h1>

    <form action="{{ isset($contactus) ? route('contactus.update', $contactus->id) : route('contactus.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($contactus))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ $contactus->email ?? old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control"
                value="{{ $contactus->phone ?? old('phone') }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control" required>{{ $contactus->address ?? old('address') }}</textarea>
        </div>

        <div class="form-group">
            <label for="logo_img">Logo</label>
            <input type="file" name="logo_img" id="logo_img" class="form-control">
            @if (isset($contactus) && $contactus->logo_img)
                <img src="{{ asset('storage/' . $contactus->logo_img) }}" alt="Logo" style="width: 100px;">
            @endif
        </div>

        <button type="submit" class="btn btn-success">
            {{ isset($contactus) ? 'Update' : 'Create' }}
        </button>
    </form>

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
@endsection
