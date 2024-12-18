@extends('layouts.employer')

@section('content')
    <div class="container">
        <h2>Update Profile</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('employer.updateProfile') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" id="company_name" name="company_name" class="form-control"
                    value="{{ old('company_name', $employer->company_name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="{{ old('email', $employer->email) }}" required>
            </div>

            <div class="form-group">
                <label for="contact_details">Contact Details</label>
                <input type="text" id="contact_details" name="contact_details" class="form-control"
                    value="{{ old('contact_details', $employer->contact_details) }}">
            </div>

            <div class="form-group">
                <label for="business_info">Business Information</label>
                <textarea id="business_info" name="business_info" class="form-control">{{ old('business_info', $employer->business_info) }}</textarea>
            </div>

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control">
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control">
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
