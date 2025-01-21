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
                        <form action="{{ route('banner_packages.update', $bannerPackage->id) }}" method="POST"
                            class="needs-validation">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price_lkr_7days" class="form-label">7 Days Price (LKR)</label>
                                    <input type="number" class="form-control" id="price_lkr_7days" name="price_lkr_7days"
                                        required value="{{ old('price_lkr_7days', $bannerPackage->price_lkr_7days) }}">
                                    @error('price_lkr_7days')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price_usd_7days" class="form-label">7 Days Price (USD)</label>
                                    <input type="number" class="form-control" id="price_usd_7days" name="price_usd_7days"
                                        required value="{{ old('price_usd_7days', $bannerPackage->price_usd_7days) }}">
                                    @error('price_usd_7days')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price_lkr_21days" class="form-label">21 Days Price (LKR)</label>
                                    <input type="number" class="form-control" id="price_lkr_21days" name="price_lkr_21days"
                                        required value="{{ old('price_lkr_21days', $bannerPackage->price_lkr_21days) }}">
                                    @error('price_lkr_21days')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price_usd_21days" class="form-label">21 Days Price (USD)</label>
                                    <input type="number" class="form-control" id="price_usd_21days" name="price_usd_21days"
                                        required value="{{ old('price_usd_21days', $bannerPackage->price_usd_21days) }}">
                                    @error('price_usd_21days')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Update Package</button>
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
