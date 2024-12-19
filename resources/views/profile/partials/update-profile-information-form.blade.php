<!-- resources/views/profile/edit.blade.php -->
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH') <!-- Add this for PATCH or PUT methods -->

    <!-- Basic Profile Fields -->
    <input type="text" name="name" value="{{ $user->name }}" placeholder="Full Name">
    <input type="email" name="email" value="{{ $user->email }}" placeholder="Email">
    <input type="tel" name="phone_number" value="{{ $user->phone_number }}" placeholder="Phone">
    <textarea name="address" placeholder="Address">{{ $user->address }}</textarea>

    <!-- Resume Upload -->
    <input type="file" name="resume_file" accept=".pdf,.doc,.docx">

    <h3>Work Experience</h3>
    <div id="experiences-container">
        @forelse($experiences as $index => $experience)
            <div class="experience-entry">
                <input type="text" name="experiences[{{ $index }}][company_name]"
                    value="{{ $experience->company_name }}" placeholder="Company Name">
                <input type="text" name="experiences[{{ $index }}][job_title]"
                    value="{{ $experience->job_title }}" placeholder="Job Title">
                <input type="date" name="experiences[{{ $index }}][start_date]"
                    value="{{ $experience->start_date }}">
                <input type="date" name="experiences[{{ $index }}][end_date]"
                    value="{{ $experience->end_date }}">
                <textarea name="experiences[{{ $index }}][job_description]" placeholder="Job Description">{{ $experience->job_description }}</textarea>
            </div>
        @empty
            <div class="experience-entry">
                <input type="text" name="experiences[0][company_name]" placeholder="Company Name">
                <input type="text" name="experiences[0][job_title]" placeholder="Job Title">
                <input type="date" name="experiences[0][start_date]">
                <input type="date" name="experiences[0][end_date]">
                <textarea name="experiences[0][job_description]" placeholder="Job Description"></textarea>
            </div>
        @endforelse
    </div>
    <button type="button" id="add-experience">Add Experience</button>

    <h3>Education</h3>
    <div id="educations-container">
        @forelse($educations as $index => $education)
            <div class="education-entry">
                <input type="text" name="educations[{{ $index }}][institution_name]"
                    value="{{ $education->institution_name }}" placeholder="Institution Name">
                <input type="text" name="educations[{{ $index }}][degree]" value="{{ $education->degree }}"
                    placeholder="Degree">
                <input type="text" name="educations[{{ $index }}][field_of_study]"
                    value="{{ $education->field_of_study }}" placeholder="Field of Study">
                <input type="date" name="educations[{{ $index }}][start_date]"
                    value="{{ $education->start_date }}">
                <input type="date" name="educations[{{ $index }}][end_date]"
                    value="{{ $education->end_date }}">
            </div>
        @empty
            <div class="education-entry">
                <input type="text" name="educations[0][institution_name]" placeholder="Institution Name">
                <input type="text" name="educations[0][degree]" placeholder="Degree">
                <input type="text" name="educations[0][field_of_study]" placeholder="Field of Study">
                <input type="date" name="educations[0][start_date]">
                <input type="date" name="educations[0][end_date]">
            </div>
        @endforelse
    </div>
    <button type="button" id="add-education">Add Education</button>

    <button type="submit">Update Profile</button>
</form>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Experience Dynamic Addition
            document.getElementById('add-experience').addEventListener('click', function() {
                const container = document.getElementById('experiences-container');
                const entries = container.getElementsByClassName('experience-entry');
                const newIndex = entries.length;

                const newEntry = document.createElement('div');
                newEntry.className = 'experience-entry';
                newEntry.innerHTML = `
            <input type="text" name="experiences[${newIndex}][company_name]" placeholder="Company Name">
            <input type="text" name="experiences[${newIndex}][job_title]" placeholder="Job Title">
            <input type="date" name="experiences[${newIndex}][start_date]">
            <input type="date" name="experiences[${newIndex}][end_date]">
            <textarea name="experiences[${newIndex}][job_description]" placeholder="Job Description"></textarea>
        `;

                container.appendChild(newEntry);
            });

            // Education Dynamic Addition
            document.getElementById('add-education').addEventListener('click', function() {
                const container = document.getElementById('educations-container');
                const entries = container.getElementsByClassName('education-entry');
                const newIndex = entries.length;

                const newEntry = document.createElement('div');
                newEntry.className = 'education-entry';
                newEntry.innerHTML = `
            <input type="text" name="educations[${newIndex}][institution_name]" placeholder="Institution Name">
            <input type="text" name="educations[${newIndex}][degree]" placeholder="Degree">
            <input type="text" name="educations[${newIndex}][field_of_study]" placeholder="Field of Study">
            <input type="date" name="educations[${newIndex}][start_date]">
            <input type="date" name="educations[${newIndex}][end_date]">
        `;

                container.appendChild(newEntry);
            });
        });
    </script>
@endpush
