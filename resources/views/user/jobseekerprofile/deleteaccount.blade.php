<div class="delete-account-container">
    <h2>Delete Account</h2>
    <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download 
       any data or information that you wish to retain.</p>
    <button type="button" class="delete-btn" onclick="confirmDelete()">Delete Account</button>
    </div>
    </div>
    <script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
            // Redirect to delete account endpoint or handle the deletion
            window.location.href = '/delete-account';
        }
    }
</script>