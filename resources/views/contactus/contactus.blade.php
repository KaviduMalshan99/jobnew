<!-- Popup Box -->
<div id="popup-box" class="popup-box">
    <div class="popup-content">
        <span id="close-popup" class="close-btn">&times;</span>
        <h2 class="contactTopic">Contact Us</h2>
        @if ($contacts->isEmpty())
            <p>No contact information available.</p>
        @else
            @foreach ($contacts as $contact)
                <img src="{{ asset('storage/' . $contact->logo_img) }}" alt="Contact Us" class="popup-image">
                <p>Email: {{ $contact->email }}</p>
                <p>Phone: {{ $contact->phone }}</p>
                <p>Address: {{ $contact->address }}</p>
            @endforeach
        @endif
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
