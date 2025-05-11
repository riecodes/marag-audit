<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maragondon Building Audit</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --dark-gray: #3b3137;
            --beige: #e0d8c1;
            --dusty-rose: #7e5c65;
            --teal-blue: #488a90;
            --slate-blue: #2c4759;
        }
        body {
            background-color: var(--beige);
            color: var(--dark-gray);
        }
        .navbar {
            background-color: var(--slate-blue);
        }
        .btn-primary {
            background-color: var(--teal-blue);
            border-color: var(--teal-blue);
        }
        .btn-primary:hover {
            background-color: var(--dusty-rose);
            border-color: var(--dusty-rose);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Maragondon Audit</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="explore.php">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search buildings...">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold">Building Audit Portal</h1>
                <p class="lead">Comprehensive building audits for government facilities in Maragondon, Cavite.</p>
                <a href="explore.php" class="btn btn-primary btn-lg">Explore Buildings</a>
            </div>
            <div class="col-md-6">
                <img src="assets/images/maragondon.jpg" alt="Maragondon" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-4">About the Project</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <p class="lead text-center">
                        This portal provides access to comprehensive building audits of government facilities in Maragondon, Cavite.
                        Our assessments cover infrastructure, fire safety, and accessibility compliance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container text-center">
            <p>&copy; <?php echo date('Y'); ?> Maragondon Building Audit. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 