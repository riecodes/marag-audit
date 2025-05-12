<?php
require_once __DIR__ . '/../include/config.php';
$building_id = isset($_GET['building_id']) ? intval($_GET['building_id']) : 0;
$tabs = [
    'infrastructure' => 'Infrastructure Audit',
    'fire_safety' => 'Fire Safety Audit',
    'accessibility' => 'Accessibility Audit',
    'documentation' => 'Documentation',
];
$audit_types = [
    'infrastructure' => 1,
    'fire_safety' => 2,
    'accessibility' => 3,
];

// Initialize arrays with default values
$audit_pdfs = array_fill_keys(array_keys($audit_types), null);
$audit_summaries = array_fill_keys(array_keys($audit_types), null);
$doc_images = [];
$building = null;

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get building information
    $stmt = $pdo->prepare("SELECT * FROM buildings WHERE id = ?");
    $stmt->execute([$building_id]);
    $building = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch audit checklists (PDFs)
    foreach ($audit_types as $key => $type_id) {
        $stmt = $pdo->prepare("SELECT checklist_path FROM audit_checklists WHERE building_id = ? AND audit_type_id = ? LIMIT 1");
        $stmt->execute([$building_id, $type_id]);
        $pdf = $stmt->fetchColumn();
        if ($pdf) {
            $audit_pdfs[$key] = '../' . $pdf;
        }
        
        // Fetch summary for this audit type from building_checklist_description
        $summaryStmt = $pdo->prepare("
            SELECT summary FROM building_checklist_description 
            WHERE building_id = ? AND audit_type_id = ? 
            LIMIT 1
        ");
        $summaryStmt->execute([$building_id, $type_id]);
        $summary = $summaryStmt->fetchColumn();
        if ($summary) {
            $audit_summaries[$key] = $summary;
        }
    }

    // Fetch documentation images
    $doc_stmt = $pdo->prepare("SELECT file_path FROM building_media WHERE building_id = ? AND media_type = 'photo' AND category = 'documentation'");
    $doc_stmt->execute([$building_id]);
    $doc_images = $doc_stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
}

function safe($val) {
    return $val ? htmlspecialchars($val) : 'N/A';
}
?>
<section class="audit-section">
    <div class="audit-content">
        <h1 class="building-title"><?php echo safe($building['name'] ?? null); ?></h1>
        <div class="audit-tabs">
            <?php $i = 0; foreach ($tabs as $key => $label): ?>
                <button class="audit-tab<?php echo $i === 0 ? ' active' : ''; ?>" data-tab="<?php echo $key; ?>"><?php echo $label; ?></button>
            <?php $i++; endforeach; ?>
        </div>
        <div class="audit-panels">
            <div class="audit-panel" data-tab="infrastructure">
                <h2>Infrastructure Audit</h2>
                <div class="audit-summary">
                    <?php if (isset($audit_summaries['infrastructure']) && $audit_summaries['infrastructure']): ?>
                        <?php echo nl2br(htmlspecialchars($audit_summaries['infrastructure'])); ?>
                    <?php else: ?>
                        <p>No infrastructure audit summary available for this building.</p>
                    <?php endif; ?>
                </div>
                <?php if ($audit_pdfs['infrastructure']): ?>
                    <div class="audit-pdf"><embed src="<?php echo htmlspecialchars($audit_pdfs['infrastructure']); ?>" type="application/pdf" width="100%" height="800px" page="1"></div>
                <?php else: ?>
                    <div class="audit-pdf-missing">No infrastructure audit PDF available.</div>
                <?php endif; ?>
            </div>
            <div class="audit-panel" data-tab="fire_safety" style="display:none;">
                <h2>Fire Safety Audit</h2>
                <div class="audit-summary">
                    <?php if (isset($audit_summaries['fire_safety']) && $audit_summaries['fire_safety']): ?>
                        <?php echo nl2br(htmlspecialchars($audit_summaries['fire_safety'])); ?>
                    <?php else: ?>
                        <p>No fire safety audit summary available for this building.</p>
                    <?php endif; ?>
                </div>
                <?php if ($audit_pdfs['fire_safety']): ?>
                    <div class="audit-pdf"><embed src="<?php echo htmlspecialchars($audit_pdfs['fire_safety']); ?>" type="application/pdf" width="100%" height="800px" page="1"></div>
                <?php else: ?>
                    <div class="audit-pdf-missing">No fire safety audit PDF available.</div>
                <?php endif; ?>
            </div>
            <div class="audit-panel" data-tab="accessibility" style="display:none;">
                <h2>Accessibility Audit</h2>
                <div class="audit-summary">
                    <?php if (isset($audit_summaries['accessibility']) && $audit_summaries['accessibility']): ?>
                        <?php echo nl2br(htmlspecialchars($audit_summaries['accessibility'])); ?>
                    <?php else: ?>
                        <p>No accessibility audit summary available for this building.</p>
                    <?php endif; ?>
                </div>
                <?php if ($audit_pdfs['accessibility']): ?>
                    <div class="audit-pdf"><embed src="<?php echo htmlspecialchars($audit_pdfs['accessibility']); ?>" type="application/pdf" width="100%" height="800px" page="1"></div>
                <?php else: ?>
                    <div class="audit-pdf-missing">No accessibility audit PDF available.</div>
                <?php endif; ?>
            </div>
            <div class="audit-panel" data-tab="documentation" style="display:none;">
                <h2>Documentation</h2>
                <?php if ($doc_images && count($doc_images) > 0): ?>
                <div class="doc-gallery">
                    <?php foreach ($doc_images as $img): ?>
                        <div class="doc-img-wrap"><img src="<?php echo '../' . htmlspecialchars($img); ?>" alt="Documentation Image"></div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                    <div class="doc-gallery-empty">No documentation images available.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox for enlarged images -->
<div id="image-lightbox" class="lightbox">
    <div class="lightbox-content">
        <img id="lightbox-img" src="" alt="Enlarged Image">
    </div>
</div>

<link rel="stylesheet" href="../css/building_audit.css">
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.audit-tab');
    const panels = document.querySelectorAll('.audit-panel');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const tabKey = this.getAttribute('data-tab');
            panels.forEach(panel => {
                if (panel.getAttribute('data-tab') === tabKey) {
                    panel.style.display = '';
                } else {
                    panel.style.display = 'none';
                }
            });
        });
    });

    // Lightbox functionality for documentation images
    const lightbox = document.getElementById('image-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const docImages = document.querySelectorAll('.doc-img-wrap img');
    
    // Open lightbox when an image is clicked
    docImages.forEach(img => {
        img.addEventListener('click', function() {
            lightboxImg.src = this.src;
            lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling when lightbox is open
        });
    });
    
    // Close lightbox when clicking anywhere on the lightbox
    lightbox.addEventListener('click', function(e) {
        if (e.target !== lightboxImg) {
            lightbox.style.display = 'none';
            document.body.style.overflow = ''; // Restore scrolling
        }
    });
});
</script> 