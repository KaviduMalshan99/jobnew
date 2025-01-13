
<head>
@vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css', 'resources/css/education.css'])
</head>
<body>
@include('user.jobseekerprofile.mainview.profilelayout')
<div class="education-container">
    <h2 class="section-header">School Education</h2>

    {{-- Display existing education entries --}}
    @foreach (auth()->user()->jobEducations ?? [] as $education)
        <form method="POST" action="{{ route('education.update', $education->id) }}" class="mb-4">
            @csrf
            @method('PUT')
            <div class="education-entry">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>School/Institute <span class="required">*</span></label>
                        <input type="text" name="institution_name" value="{{ $education->institution_name }}"
                            class="form-control" placeholder="Institution Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Program <span class="required">*</span></label>
                        <input type="text" name="degree" value="{{ $education->degree }}" class="form-control"
                            placeholder="Degree" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Field of Study <span class="required">*</span></label>
                        <textarea name="field_of_study" class="form-control" rows="3" placeholder="Field of Study" required>{{ $education->field_of_study }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Start Date <span class="required">*</span></label>
                        <input type="date" name="start_date" value="{{ $education->start_date }}"
                            class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>End Date <span class="required">*</span></label>
                        <input type="date" name="end_date" value="{{ $education->end_date }}" class="form-control"
                            required>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div class="col">
                        <button type="submit" class="btn btn-education">Update</button>
                        <a href="{{ route('education.delete', $education->id) }}"
                            onclick="return confirm('Are you sure you want to delete this education record?')"
                            class="btn btn-primary">Delete</a>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

    {{-- Add new education form --}}
    <h3 class="mt-4">Add New Education</h3>
    <form method="POST" action="{{ route('education.store') }}" id="newEducationForm">
        @csrf
        <input type="hidden" name="job_seeker_id" value="{{ auth()->id() }}">

        <div id="educationContainer">
            <div class="education-entry mb-4">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>School/Institute <span class="required">*</span></label>
                        <input type="text" name="educations[0][institution_name]" class="form-control"
                            placeholder="Institution Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Program <span class="required">*</span></label>
                        <input type="text" name="educations[0][degree]" class="form-control" placeholder="Degree"
                            required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Field of Study <span class="required">*</span></label>
                        <textarea name="educations[0][field_of_study]" class="form-control" rows="3" placeholder="Field of Study"
                            required></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Start Date <span class="required">*</span></label>
                        <input type="date" name="educations[0][start_date]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>End Date <span class="required">*</span></label>
                        <input type="date" name="educations[0][end_date]" class="form-control" required>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <div class="form-row mt-3 mb-4">
            <div class="col">
                <button type="button" class="btn btn-education" onclick="addEducationField()">Add Another
                    Education</button>
                <button type="submit" class="btn btn-success">Save All Education Details</button>
            </div>
        </div>
    </form>
</div>

<style>
    .required {
        color: red;
    }
</style>

<script>
    let educationCount = 1;

    function addEducationField() {
        const container = document.getElementById('educationContainer');
        const newEducation = document.createElement('div');
        newEducation.className = 'education-entry mb-4';

        newEducation.innerHTML = `
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>School/Institute <span class="required">*</span></label>
                <input type="text" name="educations[${educationCount}][institution_name]" class="form-control"
                    placeholder="Institution Name" required>
            </div>
            <div class="form-group col-md-6">
                <label>Program <span class="required">*</span></label>
                <input type="text" name="educations[${educationCount}][degree]" class="form-control"
                    placeholder="Degree" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Field of Study <span class="required">*</span></label>
                <textarea name="educations[${educationCount}][field_of_study]" class="form-control" rows="3"
                    placeholder="Field of Study" required></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Start Date <span class="required">*</span></label>
                <input type="date" name="educations[${educationCount}][start_date]" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label>End Date <span class="required">*</span></label>
                <input type="date" name="educations[${educationCount}][end_date]" class="form-control" required>
            </div>
        </div>
        <button type="button" class="btn btn-danger" onclick="removeEducation(this)">Remove</button>
        <hr>
    `;

        container.appendChild(newEducation);
        educationCount++;
    }

    function removeEducation(button) {
        button.closest('.education-entry').remove();
    }
</script>
</body>