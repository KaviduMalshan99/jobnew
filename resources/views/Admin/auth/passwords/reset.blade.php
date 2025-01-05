@extends('layouts.admin.app')




@section('content')
    <h2>Reset Your Password</h2>
    <form action="{{ route('admin.password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required value="{{ old('email') }}">
        </div>
        <div>
            <label for="password">New Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Reset Password</button>
    </form>
@endsection
