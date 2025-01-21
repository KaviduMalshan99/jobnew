@extends('layouts.admin.master')
@section('title', 'Edit Banner Package')
@section('css')
@endsection
@section('style')
@endsection
@section('breadcrumb-title')
    <h3>Edit Banner Package</h3>
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Banner Packages</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Banner Package</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('banner_packages.update', $bannerPackage) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Duration</label>
                                    <select name="duration" class="form-control @error('duration') is-invalid @enderror"
                                        required>
                                        <option value="7days" {{ $bannerPackage->duration == '7days' ? 'selected' : '' }}>7
                                            Days</option>
                                        <option value="21days" {{ $bannerPackage->duration == '21days' ? 'selected' : '' }}>
                                            21 Days</option>
                                    </select>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price (LKR)</label>
                                    <input type="number" step="0.01" name="price_lkr"
                                        value="{{ old('price_lkr', $bannerPackage->price_lkr) }}"
                                        class="form-control @error('price_lkr') is-invalid @enderror" required>
                                    @error('price_lkr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price (USD)</label>
                                    <input type="number" step="0.01" name="price_usd"
                                        value="{{ old('price_usd', $bannerPackage->price_usd) }}"
                                        class="form-control @error('price_usd') is-invalid @enderror" required>
                                    @error('price_usd')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Package</button>
                                    <a href="{{ route('banner_packages.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Add any custom JavaScript validation or functionality here
        });
    </script>
@endsection
