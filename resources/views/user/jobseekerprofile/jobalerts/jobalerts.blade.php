<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Alert Preferences</title>
    <link rel="stylesheet" href="jobalerts-styles.css">
    @vite(['resources/css/jobalerts.css'])
</head>

<body>
    @include('user.jobseekerprofile.mainview.profilelayout')
    <div class="jobalerts-container">
        <h2 class="jobalerts-title">
            Job Alert Preferences
            <span class="jobalerts-info-icon" title="Customize your job alert preferences"
                onclick="togglePopup()">❓</span>

            <div id="jobalerts-popup" class="jobalerts-popup">
                <div class="jobalerts-popup-content">
                    <h3>Job Ads</h3>
                    <p>
                        Job Ads will send you Job Alerts periodically based on your preferences. These job alerts will
                        contain all the recently updated jobs as per your customized requirements.
                    </p>
                    <p>
                        If you wish to receive job alerts for a certain job category-employer combination, please select
                        your preferred job category-employer combination and subscribe to it.
                    </p>
                    <button class="jobalerts-popup-close-btn" onclick="togglePopup()">Close</button>
                </div>
            </div>
        </h2>

        <div class="jobalerts-form-section">
            <label for="job-category" class="jobalerts-label">Job Categories</label>
            <select id="job-category" class="jobalerts-dropdown">
                <option value="Accounting/Auditing/Finance">Accounting/Auditing/Finance</option>
                <option value="IT">IT</option>
                <option value="Marketing">Marketing</option>
            </select>

            <label for="employer" class="jobalerts-label">Employers</label>
            <select id="employer" class="jobalerts-dropdown">
                <option value="Advania Sri Lanka">Advania Sri Lanka</option>
                <option value="Employer1">Employer 1</option>
                <option value="Employer2">Employer 2</option>
            </select>

            <button id="add-button" class="jobalerts-btn jobalerts-btn-add">ADD</button>
        </div>

        <div id="alert-list" class="jobalerts-alert-list-section">
            <p>Job categories and companies in my alert list</p>
            <ul id="alert-items" class="jobalerts-alert-items"></ul>
        </div>
        <div class="jobalerts-alert-list-section">

            <button class="jobalerts-btn jobalerts-btn-save">SAVE</button>
            <button class="jobalerts-btn jobalerts-btn-remove">REMOVE FROM JOB ALERT</button>
        </div>
        <div class="jobalerts-email-section">
            <p>If you want to change the email address to which the alerts are sent, please key in your new email
                address in the box below.</p>
            <label for="email" class="jobalerts-label">Job Alerts will be sent to</label>
            <input type="email" id="email" value="" class="jobalerts-email-input">
            <button class="jobalerts-btn jobalerts-btn-save">SAVE</button>
        </div>
    </div>

    <script>
        document.getElementById("add-button").addEventListener("click", function() {
            const category = document.getElementById("job-category").value;
            const employer = document.getElementById("employer").value;

            // Create a new list item
            const listItem = document.createElement("li");
            listItem.className = "jobalerts-alert-item";
            listItem.innerHTML = `
        <span>Category: ${category}</span>
        <span>Employer: ${employer}</span>
        <button class="jobalerts-btn-remove-item">Remove</button>
    `;

            // Add the item to the list
            document.getElementById("alert-items").appendChild(listItem);

            // Add event listener for the remove button
            listItem.querySelector(".jobalerts-btn-remove-item").addEventListener("click", function() {
                listItem.remove();
            });
        });
    </script>
    <script>
        function togglePopup() {
            const popup = document.getElementById("jobalerts-popup");
            if (popup.style.display === "flex") {
                popup.style.display = "none";
            } else {
                popup.style.display = "flex";
            }
        }
    </script>
</body>

</html>
