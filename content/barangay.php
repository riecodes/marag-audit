<?php

// Function to fix file paths for browser display
function fixFilePath($path) {
    // If path already starts with a slash or http, return as is
    if (strpos($path, '/') === 0 || strpos($path, 'http') === 0) {
        return $path;
    }
    
    // If path starts with assets, add a slash before it
    if (strpos($path, 'assets/') === 0) {
        return '../' . $path; // Adding ../ since we're in the content directory
    }
    
    // For paths that might be stored differently
    if (strpos($path, '!main-pictures-buildings') !== false) {
        return '../assets/photo-docs/!main-pictures-buildings/' . basename($path);
    }
    
    return '../' . $path; // Default prepend parent directory
}

// Fetch barangays with main photos from the database
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all barangays
    $barangayStmt = $pdo->query("SELECT id, name FROM barangays ORDER BY name");
    $barangays = $barangayStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get one main photo for each barangay
    foreach ($barangays as &$barangay) {
        // Find one main photo for a building in this barangay
        $photoStmt = $pdo->prepare("
            SELECT bm.file_path 
            FROM building_media bm
            JOIN buildings b ON bm.building_id = b.id
            WHERE b.barangay_id = ? AND bm.category = 'main_photo'
            LIMIT 1
        ");
        $photoStmt->execute([$barangay['id']]);
        $photo = $photoStmt->fetchColumn();
        
        // If no specific barangay photo is found, use a generic placeholder
        $photo = $photo ? fixFilePath($photo) : '../assets/photo-docs/!main-pictures-buildings/';
        $barangay['photo'] = $photo;
    }
    
} catch (PDOException $e) {
    $barangays = [];
}


?>
<section class="barangay-section">
    <div class="barangay-content">
        <div class="barangay-carousel">
            <div class="carousel-slides">
                <?php foreach ($barangays as $index => $barangay): ?>
                <div class="carousel-slide <?php echo ($index === 0) ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                    <div class="slide-background" style="background-image: url('<?php echo htmlspecialchars($barangay['photo']); ?>')"></div>
                    <div class="slide-content">
                        <h2><?php echo htmlspecialchars($barangay['name']); ?></h2>
                        <p>Explore the buildings and infrastructure in <?php echo htmlspecialchars($barangay['name']); ?>.</p>
                        <a href="index.php?section=buildings&barangay_id=<?php echo $barangay['id']; ?>" class="barangay-btn">
                            View Buildings
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="carousel-dots">
                <?php foreach ($barangays as $index => $barangay): ?>
                <div class="carousel-dot <?php echo ($index === 0) ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"></div>
                <?php endforeach; ?>
            </div>
            
            <div class="carousel-controls">
                <button class="carousel-btn prev">&#10094;</button>
                <button class="carousel-btn next">&#10095;</button>
            </div>
            
            <div class="barangay-list">
                <?php foreach ($barangays as $index => $barangay): ?>
                <button class="barangay-btn <?php echo ($index === 0) ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                    <?php echo htmlspecialchars($barangay['name']); ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const buttons = document.querySelectorAll('.barangay-list .barangay-btn');
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    let currentIndex = 0;
    
    // Function to update the active slide
    function showSlide(index) {
        // Reset active class from all slides, dots and buttons
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        buttons.forEach(btn => btn.classList.remove('active'));
        
        // Set active class to current slide, dot and button
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        buttons[index].classList.add('active');
        
        // Update current index
        currentIndex = index;
    }
    
    // Click event for dots
    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const index = parseInt(this.dataset.index);
            showSlide(index);
        });
    });
    
    // Click event for buttons
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const index = parseInt(this.dataset.index);
            showSlide(index);
        });
    });
    
    // Previous button click
    prevBtn.addEventListener('click', function() {
        let index = currentIndex - 1;
        if (index < 0) index = slides.length - 1;
        showSlide(index);
    });
    
    // Next button click
    nextBtn.addEventListener('click', function() {
        let index = currentIndex + 1;
        if (index >= slides.length) index = 0;
        showSlide(index);
    });
    
    // Auto-play (optional - remove if not needed)
    let interval = setInterval(function() {
        let index = currentIndex + 1;
        if (index >= slides.length) index = 0;
        showSlide(index);
    }, 5000); // Change slide every 5 seconds
    
    // Pause autoplay on mouse enter
    document.querySelector('.barangay-carousel').addEventListener('mouseenter', function() {
        clearInterval(interval);
    });
    
    // Resume autoplay on mouse leave
    document.querySelector('.barangay-carousel').addEventListener('mouseleave', function() {
        interval = setInterval(function() {
            let index = currentIndex + 1;
            if (index >= slides.length) index = 0;
            showSlide(index);
        }, 5000);
    });
});
</script>
