<body>
    <div class="container">
        <h2 class="section-header">School Education</h2>
        <form action="" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="qualification">Qualification <span class="required"></span></label>
                    <select id="qualification" name="qualification" class="form-control">
                        <option value="">Select Education Level</option>
                        <!-- Add dynamic options -->
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="scheme">Scheme <span class="required"></span></label>
                    <select id="scheme" name="scheme" class="form-control">
                        <option value="">No Schemes</option>
                        <!-- Add dynamic options -->
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="results">Results <span class="required"></span></label>
                    <select id="results" name="results" class="form-control">
                        <option value="">No Subjects</option>
                        <!-- Add dynamic options -->
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="grade">Grade</label>
                    <select id="grade" name="grade" class="form-control">
                        <option value="">Grade</option>
                        <!-- Add dynamic options -->
                    </select>
                    <button type="button" class="btn btn-add-grade"><i class="icon-add"></i></button>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="achieved_on">Achieved On <span class="required"></span></label>
                    <input type="date" id="achieved_on" name="achieved_on" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="medium">Medium</label>
                    <select id="medium" name="medium" class="form-control">
                        <option value="">Select Medium</option>
                        <!-- Add dynamic options -->
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="school_institute">School/Institute <span class="required"></span></label>
                    <input type="text" id="school_institute" name="school_institute" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="country">Country <span class="required"></span></label>
                    <select id="country" name="country" class="form-control">
                        <option value="Sri Lanka">Sri Lanka</option>
                        <!-- Add more countries -->
                    </select>
                </div>
            </div>



            <button type="submit" class="btn btn-success">Save</button>
        </form>


    </div>

</body>

</html>
