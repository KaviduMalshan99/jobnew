<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/home.css', 'resources/js/app.js','resources/css/footer.css', 'resources/css/expirienceprofile.css'])
   
</head>
<body>
<div class="container">
    <h2 class="section-header">Professional Experience</h2>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="industry">Industry <span class="required">*</span></label>
            <select id="industry" name="industry" class="form-control">
                <option value="">Select Industry</option>
                <!-- Add options dynamically if required -->
            </select>
        </div>

        <div class="form-group">
            <label for="organisation">Organisation <span class="required"></span></label>
            <input type="text" id="organisation" name="organisation" class="form-control" placeholder="Enter Organisation">
        </div>

        <div class="form-group">
            <label for="job_category">Job Category <span class="required"></span></label>
            <select id="job_category" name="job_category" class="form-control">
                <option value="">Select Job Category</option>
                <!-- Add options dynamically -->
            </select>
          
        </div>

        <div class="form-group">
            <label for="designation">Designation <span class="required"></span></label>
            <input type="text" id="designation" name="designation" class="form-control" placeholder="Enter Designation">
        </div>

        <div class="form-group">
            <label for="commenced_date">Commenced Date <span class="required"></span></label>
            <input type="date" id="commenced_date" name="commenced_date" class="form-control">
        </div>

        <div class="form-group">
            <label for="completion_date">Completion Date <span class="required"></span></label>
            <input type="date" id="completion_date" name="completion_date" class="form-control">
            <small class="info">(If you are still working, fill in the current date)</small>
        </div>

      

        <button type="submit" class="btn btn-success">Save</button>
    </form>

 
   

</body>
</html>