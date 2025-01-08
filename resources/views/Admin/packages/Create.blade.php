@extends('layouts.admin.master')

@section('title', 'Create Terms and Conditions')

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" rel="stylesheet">

    <style>
        .note-editor {
            border: 1px solid #ddd !important;
            background-color: #fff !important;
        }

        .note-toolbar {
            background-color: #f8f9fa !important;
        }

        .note-editable {
            min-height: 300px !important;
            background-color: #fff !important;
        }
    </style>

</head>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Package Contact</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('package-contacts.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="contact">Main Contact</label>
                                <input type="text" name="contact" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description_one">Description 1</label>
                                <textarea id="description_one" name="description_one" class="form-control"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description_two">Description 2</label>
                                <textarea id="description_two" name="description_two" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description_one').summernote({
                placeholder: 'Enter your description here...',
                height: 300, // Height of the editor
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'italic', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#description_two').summernote({
                placeholder: 'Enter your description here...',
                height: 300
            });
        });
    </script>

@endsection
