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
                <li><a href="#">Home</a></li>
                <li><a href="faq">FAQ</a></li>
                <li><a href="privacy">Privacy policy</a></li>
                <li><a href="terms">T & C</a></li>
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