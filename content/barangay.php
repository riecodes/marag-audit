<?php
// Minimal clean slate: fetch barangays and their main photos
require_once __DIR__ . '/../include/config.php';

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $barangays = $pdo->query("SELECT id, name FROM barangays ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($barangays as &$barangay) {
        $photoStmt = $pdo->prepare("
            SELECT bm.file_path
            FROM building_media bm
            JOIN buildings b ON bm.building_id = b.id
            WHERE b.barangay_id = ? AND bm.category = 'main_photo'
            LIMIT 1
        ");
        $photoStmt->execute([$barangay['id']]);
        $photo = $photoStmt->fetchColumn();
        $barangay['photo'] = $photo ? '../' . $photo : '../assets/photo-docs/!main-pictures-buildings/';
    }
    unset($barangay);
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
});
</script>
