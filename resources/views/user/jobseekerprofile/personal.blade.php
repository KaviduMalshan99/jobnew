<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/home.css', 'resources/js/app.js','resources/css/footer.css', 'resources/css/personalprofile.css'])
</head>
<body>
    
<div class="personalcontainer">
    <h1>Personal Details</h1>
    <form action="" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <select name="title" id="title" required>
                <option value="">Select</option>
                <option value="Mr">Mr</option>
                <option value="Ms">Ms</option>
                <option value="Mrs">Mrs</option>
            </select>
        </div>
        <div>
            <label for="last_name">Last Name</label>
            <input class="personalprofile" type="text" name="last_name" id="last_name" required>
        </div>
        <div>
            <label for="other_names">Other Names</label>
            <input class="personalprofile" type="text" name="other_names" id="other_names" required>
        </div>
        <div>
            <label for="initials">Initials</label>
            <input class="personalprofile" type="text" name="initials" id="initials" required>
        </div>
        <div>
            <label for="date_of_birth">Date of Birth</label>
            <input class="personalprofile" type="date" name="date_of_birth" id="date_of_birth" required>
        </div>
        <div>
            <label for="nationality">Nationality</label>
            <input class="personalprofile" type="text" name="nationality" id="nationality" required>
        </div>
        <div>
            <label>Marital Status</label>
            <input class="personalprofile" type="radio" name="marital_status" value="Single" required> Single
            <input class="personalprofile" type="radio" name="marital_status" value="Married" required> Married
        </div>
        <div>
            <label>Gender</label>
            <input class="personalprofile" type="radio" name="gender" value="Male" required> Male
            <input class="personalprofile" type="radio" name="gender" value="Female" required> Female
        </div>
        <div>
            <label for="address">Address</label>
            <textarea name="address" id="address" required></textarea>
        </div>
        <div>
            <label for="nic_no">NIC No.</label>
            <input class="personalprofile" type="text" name="nic_no" id="nic_no" required>
        </div>
        <div>
            <label for="passport_no">Passport No.</label>
            <input class="personalprofile" type="text" name="passport_no" id="passport_no">
        </div>
        <div>
            <label for="country">Country</label>
            <input class="personalprofile" type="text" name="country" id="country" required>
        </div>
        <div>
            <label for="district_state">District/State</label>
            <input class="personalprofile" type="text" name="district_state" id="district_state" required>
        </div>
        <div>
            <label for="division_city">Division/City</label>
            <input class="personalprofile" type="text" name="division_city" id="division_city" required>
        </div>
        <div>
            <label for="telephone">Telephone</label>
            <input class="personalprofile" type="text" name="telephone" id="telephone" required>
        </div>
        <div>
            <label for="mobile">Mobile</label>
            <input class="personalprofile" type="text" name="mobile" id="mobile" required>
        </div>
       
        <button type="submit">Submit</button>
    </form>
</div>


</body>
</html>