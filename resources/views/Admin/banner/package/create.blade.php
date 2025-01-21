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
                    <div class="card-header">
                        <h5>Create New Banner Package</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('banner_packages.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Duration</label>
                                    <select name="duration" class="form-control @error('duration') is-invalid @enderror"
                                        required>
                                        <option value="7days">7 Days</option>
                                        <option value="21days">21 Days</option>
                                    </select>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price (LKR)</label>
                                    <input type="number" step="0.01" name="price_lkr"
                                        class="form-control @error('price_lkr') is-invalid @enderror" required>
                                    @error('price_lkr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price (USD)</label>
                                    <input type="number" step="0.01" name="price_usd"
                                        class="form-control @error('price_usd') is-invalid @enderror" required>
                                    @error('price_usd')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Package</button>
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
