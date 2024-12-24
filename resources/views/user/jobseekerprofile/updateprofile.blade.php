<div class="profile-header">
            <h1>Update Profile</h1>
        </div>
        <form action="/update-profile" method="POST">
            <div class="form-section">
                <label for="company-name">Name</label>
                <input type="text" id="company-name" name="company_name" value="Cleanline Linen Management (Pvt) Ltd">
            </div>

            <div class="form-section">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="employee@example.com">
            </div>

            <div class="form-section">
                <label for="contact">Phone Number</label>
                <input type="text" id="contact" name="contact" value="+94 76 123 4567">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3"></textarea>
            </div>

            <div class="form-section">
                <label for="business-info">Business Information</label>
                <div class="form-section">
                <label for="department">Department</label>
                <input type="text" id="department" name="department" value="">

                <label for="position">Position</label>
                <input type="text" id="position" name="position" value="">

                <label for="experience">Years of Experience</label>
                <input type="number" id="experience" name="experience" value="">

                <label for="specialization">Specialization</label>
                <input type="text" id="specialization" name="specialization" value="">

   

            <div class="form-buttons">
                <button type="button" class="cancel-btn" onclick="window.location.reload()">Cancel</button>
                <button type="submit" class="save-btn">Save Changes</button>
            </div>
        </form>