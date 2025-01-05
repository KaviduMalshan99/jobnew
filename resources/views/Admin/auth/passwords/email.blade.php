@extends('layouts.admin.app')



@section('content')
    <h2>Reset Password</h2>
    <form action="{{ route('admin.password.email') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <button type="submit">Send Password Reset Link</button>
    </form>
@endsection
