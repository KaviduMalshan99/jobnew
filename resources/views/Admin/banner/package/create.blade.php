@extends('layouts.admin.master')

@section('title', 'Create Banner Package')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Create Banner Package</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item"><a href="{{ route('banner_packages.index') }}">Banner Packages</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('banner_packages.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price_lkr_7days" class="form-label">7 Days Price (LKR)</label>
                                    <input type="number"
                                        class="form-control @error('price_lkr_7days') is-invalid @enderror"
                                        id="price_lkr_7days" name="price_lkr_7days" value="{{ old('price_lkr_7days') }}"
                                        step="0.01" required>
                                    @error('price_lkr_7days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="price_usd_7days" class="form-label">7 Days Price (USD)</label>
                                    <input type="number"
                                        class="form-control @error('price_usd_7days') is-invalid @enderror"
                                        id="price_usd_7days" name="price_usd_7days" value="{{ old('price_usd_7days') }}"
                                        step="0.01" required>
                                    @error('price_usd_7days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="price_lkr_21days" class="form-label">21 Days Price (LKR)</label>
                                    <input type="number"
                                        class="form-control @error('price_lkr_21days') is-invalid @enderror"
                                        id="price_lkr_21days" name="price_lkr_21days" value="{{ old('price_lkr_21days') }}"
                                        step="0.01" required>
                                    @error('price_lkr_21days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="price_usd_21days" class="form-label">21 Days Price (USD)</label>
                                    <input type="number"
                                        class="form-control @error('price_usd_21days') is-invalid @enderror"
                                        id="price_usd_21days" name="price_usd_21days" value="{{ old('price_usd_21days') }}"
                                        step="0.01" required>
                                    @error('price_usd_21days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Banner Package</button>
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
@endsection
