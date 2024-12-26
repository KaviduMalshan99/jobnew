<body>
    <div class="container">
        <h2 class="section-header">School Education</h2>
        <form method="POST" action="{{ route('education.store-or-update') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-row">
                <input type="hidden" name="job_seeker_id" value="{{ auth()->id() }}">
                <div class="form-group col-md-6">
                    <label for="institution_name">School/Institute <span class="required"></span></label>
                    <input type="text" id="institution_name" name="educations[0][institution_name]"
                        value="{{ optional(auth()->user()->jobEducations->first())->institution_name }}"
                        class="form-control @error('educations.0.institution_name') is-invalid @enderror">
                    @error('educations.0.institution_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="degree">Program <span class="required"></span></label>
                    <input type="text" id="degree" name="educations[0][degree]"
                        value="{{ optional(auth()->user()->jobEducations->first())->degree }}"
                        class="form-control @error('educations.0.degree') is-invalid @enderror">
                    @error('educations.0.degree')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="field_of_study">Field of Study <span class="required"></span></label>
                    <textarea name="educations[0][field_of_study]" id="field_of_study"
                        class="form-control @error('educations.0.field_of_study') is-invalid @enderror" rows="10">{{ optional(auth()->user()->jobEducations->first())->field_of_study }}</textarea>
                    @error('educations.0.field_of_study')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start_date">Start Date <span class="required"></span></label>
                    <input type="date" id="start_date" name="educations[0][start_date]"
                        value="{{ optional(auth()->user()->jobEducations->first())->start_date }}"
                        class="form-control @error('educations.0.start_date') is-invalid @enderror">
                    @error('educations.0.start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="end_date">End Date <span class="required"></span></label>
                    <input type="date" id="end_date" name="educations[0][end_date]"
                        value="{{ optional(auth()->user()->jobEducations->first())->end_date }}"
                        class="form-control @error('educations.0.end_date') is-invalid @enderror">
                    @error('educations.0.end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</body>
