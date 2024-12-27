<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Experience</title>
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css', 'resources/css/expirienceprofile.css'])
</head>

<body>
    <div class="container">
        <h2 class="section-header">Professional Experience</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('experience.store-or-update') }}">
            @csrf

            <input type="hidden" name="job_seeker_id" value="{{ auth()->id() }}">

            @php
                $experience = auth()->user()->jobExperiences->first();
            @endphp

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="organisation">Organisation <span class="required">*</span></label>
                    <input type="text" id="organisation" name="experiences[0][organisation]"
                        value="{{ old('experiences.0.organisation', optional($experience)->company_name) }}"
                        class="form-control @error('experiences.0.organisation') is-invalid @enderror">
                    @error('experiences.0.organisation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="designation">Designation <span class="required">*</span></label>
                    <input type="text" id="designation" name="experiences[0][designation]"
                        value="{{ old('experiences.0.designation', optional($experience)->job_title) }}"
                        class="form-control @error('experiences.0.designation') is-invalid @enderror">
                    @error('experiences.0.designation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="commenced_date">Commenced Date <span class="required">*</span></label>
                    <input type="date" id="commenced_date" name="experiences[0][commenced_date]"
                        value="{{ old('experiences.0.commenced_date', optional($experience)->start_date) }}"
                        class="form-control @error('experiences.0.commenced_date') is-invalid @enderror">
                    @error('experiences.0.commenced_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="completion_date">Completion Date <span class="required">*</span></label>
                    <input type="date" id="completion_date" name="experiences[0][completion_date]"
                        value="{{ old('experiences.0.completion_date', optional($experience)->end_date) }}"
                        class="form-control @error('experiences.0.completion_date') is-invalid @enderror">
                    @error('experiences.0.completion_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="job_description">Description <span class="required">*</span></label>
                    <textarea id="job_description" name="experiences[0][job_description]" rows="4"
                        class="form-control @error('experiences.0.job_description') is-invalid @enderror">{{ optional(auth()->user()->jobExperiences->first())->job_description }}</textarea>
                    @error('experiences.0.job_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save Experience</button>
        </form>
    </div>
</body>

</html>
