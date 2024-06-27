<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>footer</title>
    <style>
        /* Custom styles for footer */
        footer {
            background-color: #343a40; /* Dark background color */
            color: #fff; /* Light text color */
            padding: 20px 0; /* Padding for content */
            animation: slideInUp 0.5s ease; /* Animation for sliding up */
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100px); /* Start position for animation */
                opacity: 0; /* Start opacity */
            }
            to {
                transform: translateY(0); /* End position for animation */
                opacity: 1; /* End opacity */
            }
        }
    </style>
</head>
<body>
    <footer class="py-4 bg-dark text-light text-center mt-5">
        <div class="container">
            <p>&copy; 2024 SET-NU. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>