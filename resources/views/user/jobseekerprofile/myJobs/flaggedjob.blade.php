<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlaggedJobs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/profileview.css', 'resources/css/home.css', 'resources/css/myapplication.css'])

    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            text-align: center;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        #message-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    @include('user.jobseekerprofile.mainview.profilelayout')
    <div class="jobcontainer">
        <div id="message-container"></div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="jobsection">
            <h2>Flagged Vacancies</h2>
            @if ($flaggedJobs->isEmpty())
                <p>You have not flagged any vacancies</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Vacancy</th>
                            <th>Company</th>
                            <th>Closing Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flaggedJobs as $job)
                            <tr>
                                <td>
                                    @if ($job->jobPosting)
                                        <form class="unflag-form" method="POST"
                                            action="{{ route('jobs.flag', $job->jobPosting->id) }}">
                                            @csrf
                                            <button type="submit" class="unflag-btn" title="Remove from flagged jobs">
                                                <i class="fas fa-flag"></i>
                                            </button>
                                        </form>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $job->jobPosting->title ?? 'N/A' }}</td>
                                <td>{{ $job->jobPosting->employer->company_name ?? 'N/A' }}</td>
                                <td>{{ $job->jobPosting->closing_date ?? 'N/A' }}</td>
                                <td>
                                    @if ($job->jobPosting)
                                        <a href="{{ route('job.details', $job->jobPosting->id) }}">View & Apply</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle unflag form submission
            $('.unflag-form').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let row = form.closest('tr');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'unflagged') {
                            // Show success message
                            showMessage(response.message, 'success');

                            // Animate and remove the row
                            row.fadeOut(300, function() {
                                $(this).remove();

                                // Check if table is empty
                                if ($('tbody tr').length === 0) {
                                    $('.jobsection').html(
                                        '<h2>Flagged Vacancies</h2><p>You have not flagged any vacancies</p>'
                                    );
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred. Please try again.';
                        try {
                            let response = JSON.parse(xhr.responseText);
                            if (response.message) {
                                errorMessage = response.message;
                            }
                        } catch (e) {}
                        showMessage(errorMessage, 'error');
                    }
                });
            });

            function showMessage(message, type) {
                const messageElement = $(`
                    <div class="alert alert-${type}">
                        ${message}
                    </div>
                `);

                $('#message-container').html(messageElement);

                setTimeout(function() {
                    messageElement.fadeOut(300, function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        });
    </script>
</body>

</html>
