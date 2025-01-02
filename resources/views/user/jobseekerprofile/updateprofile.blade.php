<div class="profile-header">
    <h1>Common Profile</h1>
</div>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-section">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" readonly>
    </div>

    <div class="form-section">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
    </div>

    <div class="form-section">
        <label for="contact">Phone Number</label>
        <input type="text" id="contact" name="contact" value="{{ auth()->user()->phone_number }}" readonly>
        <label for="address">Address</label>
        <textarea id="address" name="address" rows="3" readonly>{{ auth()->user()->address }}</textarea>
    </div>

    <div class="form-section">
        <label for="business-info">Business Information</label>
        <div class="form-section">
            <label for="department">Department</label>
            <input type="text" id="department" name="department" value="" readonly>

            <label for="position">Position</label>
            <input type="text" id="position" name="position" value="" readonly>

            <label for="experience">Years of Experience</label>
            <input type="number" id="experience" name="experience" value="" readonly>

            <label for="specialization">Specialization</label>
            <input type="text" id="specialization" name="specialization" value="" readonly>



            <div class="form-buttons">
                <button type="button" class="cancel-btn" onclick="window.location.reload()">Cancel</button>
                <button type="submit" class="save-btn">Save Changes</button>
            </div>
</form>
