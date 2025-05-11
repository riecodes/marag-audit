<?php
$building_id = $_GET['id'] ?? 0;
if (empty($building_id)) {
    header('Location: explore.php');
    exit;
}

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get building details
    $stmt = $pdo->prepare("SELECT * FROM buildings WHERE id = ?");
    $stmt->execute([$building_id]);
    $building = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$building) {
        header('Location: explore.php');
        exit;
    }

    // Get audit summaries
    $stmt = $pdo->prepare("SELECT * FROM audits WHERE building_id = ?");
    $stmt->execute([$building_id]);
    $audits = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get photos
    $stmt = $pdo->prepare("SELECT * FROM photos WHERE building_id = ?");
    $stmt->execute([$building_id]);
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get documents
    $stmt = $pdo->prepare("SELECT * FROM documents WHERE building_id = ?");
    $stmt->execute([$building_id]);
    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($building['name']); ?> - Maragondon Audit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-main mb-4">
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
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?section=explore">Explore</a></li>
                <li class="breadcrumb-item"><a
                        href="index.php?section=barangay&name=<?php echo urlencode($building['barangay']); ?>"><?php echo htmlspecialchars($building['barangay']); ?></a>
                </li>
                <li class="breadcrumb-item active"><?php echo htmlspecialchars($building['name']); ?></li>
            </ol>
        </nav>

        <h1 class="text-center mb-4"><?php echo htmlspecialchars($building['name']); ?></h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Building Description -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Description</h5>
                <p class="card-text">
                    <?php echo nl2br(htmlspecialchars($building['description'] ?? 'No description available.')); ?></p>
            </div>
        </div>

        <!-- Audit Summaries -->
        <div class="row mb-4">
            <?php foreach ($audits as $audit): ?>
                <div class="col-md-4">
                    <div class="card h-100 card-hover">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize"><?php echo str_replace('_', ' ', $audit['type']); ?></h5>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($audit['summary'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Photo Gallery -->
        <?php if (!empty($photos)): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Photo Gallery</h5>
                    <div class="photo-grid">
                        <?php foreach ($photos as $photo): ?>
                            <a href="uploads/<?php echo $building_id; ?>/<?php echo htmlspecialchars($photo['filename']); ?>"
                                data-fancybox="gallery" class="photo-item">
                                <img src="uploads/<?php echo $building_id; ?>/<?php echo htmlspecialchars($photo['filename']); ?>"
                                    alt="Building photo">
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Documents -->
        <?php if (!empty($documents)): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Documents</h5>
                    <div class="list-group">
                        <?php foreach ($documents as $document): ?>
                            <a href="uploads/<?php echo $building_id; ?>/<?php echo htmlspecialchars($document['filename']); ?>"
                                class="list-group-item list-group-item-action" target="_blank">
                                <i class="bi bi-file-pdf"></i> <?php echo htmlspecialchars($document['filename']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    </script>
</body>

</html>