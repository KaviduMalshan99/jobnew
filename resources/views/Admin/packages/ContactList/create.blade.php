@extends('layouts.admin.master')

@section('title', 'Create Contact List')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Create Contact List</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Create Contact List</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Contacts</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('contacts.store-multiple') }}" method="POST" id="contactsForm">
                            @csrf
                            <div id="contacts-container">
                                <div class="contact-item">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="contacts[0][name]" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="contacts[0][phone]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="addContact" class="btn btn-success">Add Another Contact</button>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let contactIndex = 1;

            document.getElementById('addContact').addEventListener('click', function() {
                const container = document.getElementById('contacts-container');
                const newContact = `
                    <div class="contact-item mt-3">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="contacts[${contactIndex}][name]" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="contacts[${contactIndex}][phone]" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-danger remove-contact">Remove</button>
                    </div>`;
                container.insertAdjacentHTML('beforeend', newContact);
                contactIndex++;
            });

            document.getElementById('contacts-container').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-contact')) {
                    e.target.closest('.contact-item').remove();
                }
            });
        });
    </script>
@endsection
