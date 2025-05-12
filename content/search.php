<?php
/**
 * Search functionality for barangays and buildings
 */

/**
 * Highlight search keywords in text
 */
function highlightKeywords($text, $keywords) {
    if (empty($keywords)) return htmlspecialchars($text);
    
    $text = htmlspecialchars($text);
    $keywords = is_array($keywords) ? $keywords : [$keywords];
    
    foreach ($keywords as $keyword) {
        if (strlen($keyword) < 3) continue; // Skip short keywords
        
        $pattern = '/(' . preg_quote($keyword, '/') . ')/i';
        $replacement = '<span class="highlight">$1</span>';
        $text = preg_replace($pattern, $replacement, $text);
    }
    
    return $text;
}

// Get search query
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$searchResults = [
    'barangays' => [],
    'buildings' => []
];

if (!empty($searchQuery)) {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Search for barangays that match the query
        $stmt = $pdo->prepare("
            SELECT id, name 
            FROM barangays 
            WHERE name LIKE :query 
            ORDER BY name
            LIMIT 20
        ");
        $stmt->execute(['query' => '%' . $searchQuery . '%']);
        $searchResults['barangays'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Search for buildings that match the query
        $stmt = $pdo->prepare("
            SELECT b.id, b.name, b.barangay_id, br.name as barangay_name
            FROM buildings b
            JOIN barangays br ON b.barangay_id = br.id
            WHERE b.name LIKE :query
            ORDER BY b.name
            LIMIT 50
        ");
        $stmt->execute(['query' => '%' . $searchQuery . '%']);
        $searchResults['buildings'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // If no direct match found, try keywords
        if (empty($searchResults['buildings']) && empty($searchResults['barangays'])) {
            // For buildings, split query into words and search for each
            $keywords = preg_split('/\s+/', $searchQuery);
            $conditions = [];
            $params = [];
            
            foreach ($keywords as $i => $keyword) {
                if (strlen($keyword) >= 3) { // Only search for keywords with 3+ chars
                    $param = ":keyword$i";
                    $conditions[] = "b.name LIKE $param";
                    $params[$param] = '%' . $keyword . '%';
                }
            }
            
            if (!empty($conditions)) {
                $sql = "
                    SELECT b.id, b.name, b.barangay_id, br.name as barangay_name
                    FROM buildings b
                    JOIN barangays br ON b.barangay_id = br.id
                    WHERE " . implode(' OR ', $conditions) . "
                    ORDER BY b.name
                    LIMIT 50
                ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                $searchResults['buildings'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    } catch (PDOException $e) {
        error_log("Search error: " . $e->getMessage());
    }
}

// Calculate total results
$totalResults = count($searchResults['barangays']) + count($searchResults['buildings']);

// Combine all results into one array for the table
$allResults = [];
foreach ($searchResults['barangays'] as $barangay) {
    $allResults[] = [
        'id' => $barangay['id'],
        'name' => $barangay['name'],
        'type' => 'Barangay',
        'barangay_name' => '',
        'icon' => 'location_on',
        'url' => 'index.php?section=buildings&barangay_id=' . $barangay['id']
    ];
}

foreach ($searchResults['buildings'] as $building) {
    $allResults[] = [
        'id' => $building['id'],
        'name' => $building['name'],
        'type' => 'Building',
        'barangay_name' => $building['barangay_name'],
        'icon' => 'business',
        'url' => 'index.php?section=building_audit&building_id=' . $building['id']
    ];
}
?>

<section class="search-results-section">
    <div class="search-container">
        <div class="search-header">
            <h1>Search Results</h1>
            <p class="search-query">"<?php echo htmlspecialchars($searchQuery); ?>"</p>
            <p class="results-count"><?php echo $totalResults; ?> results</p>
        </div>
        
        <?php if (empty($searchQuery)): ?>
            <div class="search-empty">
                <p>Enter a search term to find barangays or buildings</p>
            </div>
        <?php elseif ($totalResults === 0): ?>
            <div class="search-empty">
                <p>No results found for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
                <p>Try different keywords or check spelling</p>
            </div>
        <?php else: ?>
            <table class="search-results-table">
                <thead>
                    <tr>
                        <th class="icon-cell"></th>
                        <th>Name</th>
                        <th class="type-cell">Type</th>
                        <th class="barangay-cell">Barangay</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allResults as $result): ?>
                        <tr class="clickable-row" data-href="<?php echo $result['url']; ?>">
                            <td class="icon-cell">
                                <div class="result-icon" style="background-color: <?php echo $result['type'] === 'Barangay' ? 'var(--teal-blue)' : 'var(--dusty-rose)'; ?>">
                                    <span class="material-icons"><?php echo $result['icon']; ?></span>
                                </div>
                            </td>
                            <td class="name-cell"><?php echo highlightKeywords($result['name'], $searchQuery); ?></td>
                            <td class="type-cell"><?php echo $result['type']; ?></td>
                            <td class="barangay-cell"><?php echo $result['type'] === 'Building' ? htmlspecialchars($result['barangay_name']) : ''; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>

<!-- Add JavaScript to make rows clickable -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const clickableRows = document.querySelectorAll('.clickable-row');
    clickableRows.forEach(row => {
        row.addEventListener('click', function() {
            window.location.href = this.dataset.href;
        });
    });
});
</script>