<!-- Popup Box -->
<div id="popup-box" class="popup-box">
    <div class="popup-content">
        <span id="close-popup" class="close-btn">&times;</span>
        <h2 class= "contactTopic">Contact Us</h2>
        <!-- Add an image -->
        <img src="/images/jobss.png" alt="Contact Us" class="popup-image">
        <p>Email: contact@jobportal.com</p>
        <p>Phone: +123 235 7890</p>
        <p>Address: 123 Job Street, Employment City</p>
    </div>
</div>


<script>
    // Get elements
    const contactUsBtn = document.getElementById('contact-us-btn');
    const popupBox = document.getElementById('popup-box');
    const closePopup = document.getElementById('close-popup');

    // Show popup
    contactUsBtn.addEventListener('click', () => {
        popupBox.style.display = 'flex';
    });

    // Close popup
    closePopup.addEventListener('click', () => {
        popupBox.style.display = 'none';
    });

    // Close popup when clicking outside of the content
    popupBox.addEventListener('click', (e) => {
        if (e.target === popupBox) {
            popupBox.style.display = 'none';
        }
    });
</script>
