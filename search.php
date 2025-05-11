<?php
require_once 'config.php';

$query = $_GET['q'] ?? '';
$results = [];

if (!empty($query)) {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Search in buildings table
        $stmt = $pdo->prepare("
            SELECT * FROM buildings 
            WHERE name LIKE ? OR barangay LIKE ?
            ORDER BY barangay, name
        ");
        $search_term = "%{$query}%";
        $stmt->execute([$search_term, $search_term]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Maragondon Audit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .building-card {
            transition: transform 0.2s;
        }
        .building-card:hover {
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
                    <input class="form-control me-2" type="search" name="q" placeholder="Search buildings..." value="<?php echo htmlspecialchars($query); ?>">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Search Results</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (empty($query)): ?>
            <div class="alert alert-info">Please enter a search term.</div>
        <?php elseif (empty($results)): ?>
            <div class="alert alert-info">No buildings found matching your search.</div>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($results as $building): ?>
                <div class="col">
                    <div class="card h-100 building-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($building['name']); ?></h5>
                            <p class="card-text text-muted"><?php echo htmlspecialchars($building['barangay']); ?></p>
                            <p class="card-text"><?php echo htmlspecialchars($building['description'] ?? ''); ?></p>
                            <a href="building.php?id=<?php echo $building['id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 