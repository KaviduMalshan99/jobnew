<div class="password-update-container" style="border: 2px solid #ccc; padding: 15px; margin-top: 20px; border-radius: 10px;">
    <h2>Update Password</h2>
    <form action="/update-password" method="POST">
        <div class="form-section">
            <label for="current-password">Current Password</label>
            <input type="password" id="current-password" name="current_password" placeholder="Enter your current password">
        </div>

        <div class="form-section">
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new_password" placeholder="Enter your new password">
        </div>

        <div class="form-section">
            <label for="confirm-password">Confirm New Password</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Re-enter your new password">
        </div>

        <div class="form-buttons">
            <button type="submit" class="save-btn">Save Password</button>
        </div>
    </form>
    </div>