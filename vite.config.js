import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/home.css',
                'resources/css/header.css',
                'resources/css/bannerposting.css',
                'resources/css/education.css',
                'resources/css/employeeprofile.css',
                'resources/css/expirienceprofile.css',
                'resources/css/footer.css',
                'resources/css/jobalerts.css',
                'resources/css/myapplication.css',
                'resources/css/personalprofile.css',
                'resources/css/postjob.css',
                'resources/css/privacy.css',
                'resources/css/profileview.css',
                'resources/css/terms.css',
                'resources/css/topads.css',
                'resources/css/topemployees.css',
                'resources/css/reviews.css',
                'resources/css/feedback.css',
                'resources/css/aboutus.css',
                'resources/css/home.css',
                'public/assets/scss/app.scss'
            ],
            refresh: true,
        }),
    ],
});
