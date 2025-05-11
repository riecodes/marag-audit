<?php

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get unique barangays
    $stmt = $pdo->query("SELECT DISTINCT barangay FROM buildings ORDER BY barangay");
    $barangays = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
} catch(PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Buildings - Maragondon Audit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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
        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
        }
        .barangay-card {
            transition: transform 0.2s;
        }
        .barangay-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
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
                        <a class="nav-link active" href="explore.php">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#contact">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search buildings...">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Explore Government Buildings</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($buildings as $building): ?>
            <div class="col">
                <div class="card h-100 card-hover">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($building['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($building['description'] ?? ''); ?></p>
                        <a href="index.php?section=building&id=<?php echo $building['id']; ?>" class="btn btn-main">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize map centered on Maragondon
        const map = L.map('map').setView([14.2733, 120.7377], 13);
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        // Add marker for Maragondon
        L.marker([14.2733, 120.7377])
            .addTo(map)
            .bindPopup('Maragondon, Cavite')
            .openPopup();
    </script>
</body>
</html> 