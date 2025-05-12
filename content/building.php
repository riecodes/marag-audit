<?php
require_once __DIR__ . '/../include/config.php';

$barangay_id = isset($_GET['barangay_id']) ? intval($_GET['barangay_id']) : 0;
$barangay_name = '';
$buildings = [];

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get barangay name
    $stmt = $pdo->prepare("SELECT name FROM barangays WHERE id = ?");
    $stmt->execute([$barangay_id]);
    $barangay_name = $stmt->fetchColumn();

    // Get buildings for this barangay
    $stmt = $pdo->prepare("SELECT id, name FROM buildings WHERE barangay_id = ? ORDER BY name");
    $stmt->execute([$barangay_id]);
    $buildings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get main photo for each building
    foreach ($buildings as &$building) {
        $photoStmt = $pdo->prepare("
            SELECT file_path FROM building_media
            WHERE building_id = ? AND category = 'main_photo'
            LIMIT 1
        ");
        $photoStmt->execute([$building['id']]);
        $photo = $photoStmt->fetchColumn();
        $building['photo'] = $photo ? '../' . $photo : '../assets/photo-docs/!main-pictures-buildings/0-MAIN-PHOTO.jpg';
    }
    unset($building);
} catch (PDOException $e) {
    $buildings = [];
}
?>
<section class="barangay-section">
    <div class="barangay-content">
        <div class="barangay-carousel">
            <div class="carousel-slides">
                <?php foreach ($buildings as $index => $building): ?>
                <div class="carousel-slide <?php echo ($index === 0) ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                    <div class="slide-background" style="background-image: url('<?php echo htmlspecialchars($building['photo']); ?>')"></div>
                    <div class="slide-content">
                        <h2><?php echo htmlspecialchars($building['name']); ?></h2>
                        <p>Building in <?php echo htmlspecialchars($barangay_name); ?>.</p>
                        <button class="barangay-btn view-info-btn" data-index="<?php echo $index; ?>" onclick="window.location.href='index.php?section=building_info&building_id=<?php echo $building['id']; ?>'">
                            View Building Info
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="carousel-dots">
                <?php foreach ($buildings as $index => $building): ?>
                <div class="carousel-dot <?php echo ($index === 0) ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"></div>
                <?php endforeach; ?>
            </div>
            <div class="carousel-controls">
                <button class="carousel-btn prev">&#10094;</button>
                <button class="carousel-btn next">&#10095;</button>
            </div>
            <div class="barangay-list">
                <?php foreach ($buildings as $index => $building): ?>
                <button class="barangay-btn <?php echo ($index === 0) ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                    <?php echo htmlspecialchars($building['name']); ?>
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
    const viewInfoBtns = document.querySelectorAll('.view-info-btn');
    let currentIndex = 0;
    const buildingData = <?php echo json_encode($buildings); ?>;
    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        buttons.forEach(btn => btn.classList.remove('active'));
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        buttons[index].classList.add('active');
        currentIndex = index;
    }
    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const index = parseInt(this.dataset.index);
            showSlide(index);
        });
    });
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const index = parseInt(this.dataset.index);
            showSlide(index);
        });
    });
    prevBtn.addEventListener('click', function() {
        let index = currentIndex - 1;
        if (index < 0) index = slides.length - 1;
        showSlide(index);
    });
    nextBtn.addEventListener('click', function() {
        let index = currentIndex + 1;
        if (index >= slides.length) index = 0;
        showSlide(index);
    });
    let interval = setInterval(function() {
        let index = currentIndex + 1;
        if (index >= slides.length) index = 0;
        showSlide(index);
    }, 5000);
    document.querySelector('.barangay-carousel').addEventListener('mouseenter', function() {
        clearInterval(interval);
    });
    document.querySelector('.barangay-carousel').addEventListener('mouseleave', function() {
        interval = setInterval(function() {
            let index = currentIndex + 1;
            if (index >= slides.length) index = 0;
            showSlide(index);
        }, 5000);
    });
    // Modal logic
    viewInfoBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const idx = parseInt(this.dataset.index);
            // No need to update modal content as the button now redirects
        });
    });
});
</script>
