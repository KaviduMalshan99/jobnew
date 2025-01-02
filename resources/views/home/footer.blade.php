<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>About Us</h3>
            <p>
                We are a leading job portal connecting talented individuals with top employers worldwide.
                Your career journey starts here.
            </p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="faq">FAQ</a></li>
                <li><a href="privacy">Privacy policy</a></li>
                <li><a href="terms">T & C</a></li>
                <li><a href="feedback">Feedback</a></li>
                <li><a href="aboutus">About Us</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email: support@jobportal.com</p>
            <p>Phone: +123 456 7890</p>
            <p>Address: 123 Job Street, Employment City</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Job Portal. All Rights Reserved.</p>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainCategoryLinks = document.querySelectorAll('.main-category');
        const subcategoriesSection = document.getElementById('subcategories-section');
        const subcategoriesList = document.getElementById('subcategories-list');
        const selectedCategoryName = document.getElementById('selected-category-name');

        mainCategoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const categoryId = this.getAttribute('data-category-id');
                const categoryName = this.textContent.trim().split('\n')[0];

                // Set the category name
                selectedCategoryName.textContent = categoryName;

                // Fetch subcategories via AJAX
                fetch(`/categories/${categoryId}/subcategories`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing subcategories
                        subcategoriesList.innerHTML = '';

                        if (data.subcategories.length > 0) {
                            data.subcategories.forEach((subcategory, index) => {
                                const subcategoryLink = document.createElement('a');
                                subcategoryLink.href = '#';
                                subcategoryLink.className = `subcategory-card block p-5
                                    bg-gray-100 text-gray-800
                                    rounded-xl
                                    transition-all duration-300
                                    hover:bg-blue-100 hover:text-blue-900
                                    hover:shadow-lg
                                    subcategory-enter`;
                                subcategoryLink.style.animationDelay =
                                    `${index * 100}ms`;
                                subcategoryLink.innerHTML = `
                                    <div class="text-center">
                                        <span class="font-bold block mb-2">${subcategory.name}</span>
                                        <span class="text-sm text-gray-600">
                                            ${subcategory.jobs_count ?? '0'} Jobs
                                        </span>
                                    </div>
                                `;
                                subcategoryLink.setAttribute('data-subcategory-id',
                                    subcategory.id);

                                subcategoriesList.appendChild(subcategoryLink);
                            });
                        } else {
                            const noSubcategoriesMsg = document.createElement('p');
                            noSubcategoriesMsg.textContent = 'No subcategories available.';
                            noSubcategoriesMsg.className =
                                'text-center text-blue-500 col-span-full py-10 text-xl';
                            subcategoriesList.appendChild(noSubcategoriesMsg);
                        }

                        // Show the subcategories section with animation
                        subcategoriesSection.classList.remove('hidden');
                        subcategoriesSection.classList.add('block');

                        // Smooth scroll to subcategories
                        subcategoriesSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching subcategories:', error);
                        const errorMsg = document.createElement('p');
                        errorMsg.textContent =
                            'Failed to load subcategories. Please try again.';
                        errorMsg.className =
                            'text-center text-red-500 col-span-full py-10 text-xl';
                        subcategoriesList.appendChild(errorMsg);
                        subcategoriesSection.classList.remove('hidden');
                        subcategoriesSection.classList.add('block');
                    });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryLinks = document.querySelectorAll('.category-link');
        const jobListingsContainer = document.getElementById(
        'job-listings'); // Ensure this ID exists in your HTML

        categoryLinks.forEach(link => {
            link.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-category-id');

                // Show loading message
                jobListingsContainer.innerHTML = '<p>Loading jobs...</p>';

                // Fetch jobs for the selected category
                fetch(`/jobs/category/${categoryId}`) // Correct fetch URL syntax
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(jobs => {
                        // Clear the loading message
                        jobListingsContainer.innerHTML = '';

                        if (jobs.length > 0) {
                            // Populate the job listings
                            jobs.forEach(job => {
                                const jobCard = `
                                <div class="job-card">
                                    <a href="/jobs/${job.id}" class="job-title font-bold text-lg text-blue-600 hover:underline">
                                        ${job.title}
                                    </a>
                                    <p class="text-gray-600">${job.employer.company_name}</p>
                                </div>
                            `;
                                jobListingsContainer.innerHTML += jobCard;
                            });
                        } else {
                            jobListingsContainer.innerHTML =
                                '<p>No jobs found for this category.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching jobs:', error);
                        jobListingsContainer.innerHTML =
                            '<p>Failed to load jobs. Please try again later.</p>';
                    });
            });
        });
    });
</script>
