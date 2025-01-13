<!DOCTYPE html>
<html lang="en">
<style>
   
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Experience</title>
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css', 'resources/css/expirienceprofile.css'])
</head>

<body>
@include('user.jobseekerprofile.mainview.profilelayout')
    <div class="experience-container">
        <h2 class="section-header">Professional Experience</h2>

        {{-- Display existing experience entries --}}
        @foreach (auth()->user()->jobExperiences ?? [] as $experience)
            <form method="POST" action="{{ route('experience.update', $experience->id) }}" class="mb-4">
                @csrf
                @method('PUT')
                <div class="experience-entry">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Organisation <span class="required">*</span></label>
                            <input type="text" name="company_name" value="{{ $experience->company_name }}"
                                class="form-control" placeholder="Company Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Designation <span class="required">*</span></label>
                            <input type="text" name="job_title" value="{{ $experience->job_title }}"
                                class="form-control" placeholder="Job Title" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Job Description <span class="required">*</span></label>
                            <textarea name="job_description" class="form-control" rows="3" placeholder="Job Description" required>{{ $experience->job_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Start Date <span class="required">*</span></label>
                            <input type="date" name="start_date" value="{{ $experience->start_date }}"
                                class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>End Date <span class="required">*</span></label>
                            <input type="date" name="end_date" value="{{ $experience->end_date }}"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="form-row mt-2">
                        <div class="col">
                            <button type="submit" class="btn btn-education">Update</button>
                            <a href="{{ route('experience.delete', $experience->id) }}"
                                onclick="return confirm('Are you sure you want to delete this experience record?')"
                                class="btn btn-primary">Delete</a>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach

        {{-- Add new experience form --}}
        <h3 class="mt-4">Add New Experience</h3>
        <form method="POST" action="{{ route('experience.store') }}" id="newExperienceForm">
            @csrf
            <input type="hidden" name="job_seeker_id" value="{{ auth()->id() }}">

            <div id="experienceContainer">
                <div class="experience-entry mb-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Organisation <span class="required">*</span></label>
                            <input type="text" name="experiences[0][company_name]" class="form-control"
                                placeholder="Company Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Designation <span class="required">*</span></label>
                            <input type="text" name="experiences[0][job_title]" class="form-control"
                                placeholder="Job Title" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Job Description <span class="required">*</span></label>
                            <textarea name="experiences[0][job_description]" class="form-control" rows="3" placeholder="Job Description"
                                required></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Start Date <span class="required">*</span></label>
                            <input type="date" name="experiences[0][start_date]" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>End Date <span class="required">*</span></label>
                            <input type="date" name="experiences[0][end_date]" class="form-control" required>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <div class="form-row mt-3 mb-4">
                <div class="col">
                    <button type="button" class="btn btn-education" onclick="addExperienceField()">Add Another
                        Experience</button>
                    <button type="submit" class="btn btn-success">Save All Experience Details</button>
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
        let experienceCount = 1;

        function addExperienceField() {
            const container = document.getElementById('experienceContainer');
            const newExperience = document.createElement('div');
            newExperience.className = 'experience-entry mb-4';

            newExperience.innerHTML = `
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Organisation <span class="required">*</span></label>
                    <input type="text" name="experiences[${experienceCount}][company_name]" class="form-control"
                        placeholder="Company Name" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Designation <span class="required">*</span></label>
                    <input type="text" name="experiences[${experienceCount}][job_title]" class="form-control"
                        placeholder="Job Title" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Job Description <span class="required">*</span></label>
                    <textarea name="experiences[${experienceCount}][job_description]" class="form-control" rows="3"
                        placeholder="Job Description" required></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Start Date <span class="required">*</span></label>
                    <input type="date" name="experiences[${experienceCount}][start_date]" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label>End Date <span class="required">*</span></label>
                    <input type="date" name="experiences[${experienceCount}][end_date]" class="form-control" required>
                </div>
            </div>
            <button type="button" class="btn btn-danger" onclick="removeExperience(this)">Remove</button>
            <hr>
        `;

            container.appendChild(newExperience);
            experienceCount++;
        }

        function removeExperience(button) {
            button.closest('.experience-entry').remove();
        }
    </script>
</body>

</html>
