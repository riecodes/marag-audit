<?php
require_once '../include/init.php';

// First, run the backup script
echo "🔄 Creating database backup before proceeding...\n";
require_once __DIR__ . '/backup_db.php';

// Connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Prepare the update statement
$update_stmt = $conn->prepare("UPDATE building_audits SET audit_summary = ? WHERE building_id = ?");

// Array of accessibility summaries
$accessibility_summaries = [
    // POBLACION 1A
    1 => "The municipal hall building is a primary administrative building for a municipality; many people came to this building for some transactions. This is the only government building that almost got perfect to comply with the accessibility checklist. The only thing that this building didn't comply with is the elevator.",
    2 => "The DILG building is located beside the municipal hall building; this building got 25%, which means it meets two accessibility features—including corridor and parking. This government building is connected with the municipal hall; that's why the washroom and toilet are in the main building.",
    3 => "The mayor's office building is also located beside and connected building in the municipal hall. This government building got 37.5%, which means this building complies with three accessibility features, which are doors and entrances, hallways and corridors, and parking.",
    4 => "The Barangay Hall of Poblacion 1A is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features—including doors and entrances, hallways and corridors, and washrooms and toilets.",
    5 => "The Municipal Tourism Office is an office focused on promoting and developing tourism within the municipality. This government building got 12.5%, which means it satisfied only one accessibility feature, which is the hallways and corridors only. This is located beside the road; that's why this building doesn't have parking and accessible ramps.",
    // POBLACION 1B
    6 => "The Barangay Hall of Poblacion 1B is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features—including hallways and corridors, accessible ramps, and parking.",
    // POBLACION 2B
    7 => "The Municipal Disaster Risk Reduction and Management Office is a local government unit office that is responsible for disaster preparedness, response, and recovery within its jurisdiction. This building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This building is a rental space since the old MDRRMO burned down.",
    8 => "The Barangay Hall of Poblacion 2B is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, which means it complies with only one accessibility feature which is the hallways and corridor. This barangay hall doesn't have any parking, accessible ramps, and especially elevator.",
    // POBLACION 3 (CAINGIN)
    9 => "The Barangay Hall of Poblacion 2B is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features–including doors and entrances, hallways and corridors, and washroom and toilet. This barangay hall doesn't have any parking, accessible ramps, and especially elevator.",
    10 => "The Multi-Purpose Hall of Poblacion 3 (Caingin) serves as a place for barangay meetings, assemblies, and the Sangguniang Kabataan Office. This government building got 37.5%, which means it satisfies three accessibility requirements—including doors and entrances, corridors and hallways, and parking.",
    // GARITA A
    11 => "The Municipal Circuit Trial Court is the first-level court of two or more municipalities; it is a local venue for individuals to seek legal redress and resolve disputes. This government building is located at Garita A and got 25%, which means two accessibility features were acquired—including doors and corridors, and hallways and corridor. This building was near the street road and doesn't have parking.",
    12 => "The Maragondon Police Station Building is an office that has the duty to fulfill a variety of community responsibilities, such as upholding the peace, handling emergencies, etc. This government building got a 37.5%, which means it complies with three accessibility requirements—including doors and entrances, hallways and corridors, and parking. This building doesn't have any accessible ramps since there's no stair or high level at the entrance.",
    // MES Buildings
    13 => "The Maragondon Elementary School—Building 1 is a two-storey building with one classroom per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as doors and entrances, corridors and hallways, and accessible ramps.",
    14 => "The Maragondon Elementary School—Building 2 is a two-storey building with two classrooms per floor level used by grade 5 students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways.",
    15 => "The Maragondon Elementary School—Building 3 is a two-storey building with two classrooms per floor level used by grade 6 students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps.",
    // MNHS Buildings
    16 => "The Maragondon High School—Building 1 is a four-storey building with two classrooms per floor level used by senior high school students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps.",
    17 => "The Maragondon High School—Building 2 is a two-storey building with two classrooms per floor level used by grade 7 students. This school building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This building failed to provide enough space for corridors and doesn't have accessible ramps or even a comfort room in the building.",
    18 => "The Multipurpose Hall of Garita A serves as community hubs for various activities, including meetings, events, and social gatherings. This government building got 25%, which means it satisfies twoo accessibility features–including doors and entrances, and hallways and corridors. This building doesn't have a parking space.",
    // GARITA B
    19 => "The CavSci - DepEd Standard School Building 4 is a four-storey building with two classrooms per floor level. This school building got 50%, which means half of the accessibility requirements that were met—such as door and entrances, corridors and hallways, washroom and toilets, and accessible ramps.",
    20 => "The CavSci – Maliksi Building 5 is a two-storey building with two classrooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that was met is the corridor and hallway.",
    21 => "The CavSci – Modified School Building 6 is a two-storey building with two classrooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that was met is the corridor and hallway. This is the oldest building in Cavsci, and doesn't have accessible ramps and signages.",
    22 => "The CavSci – DepEd Standard School Building 7 is a four-storey building with two classrooms per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps.",
    23 => "The CavSci – Science Laboratory Building 9 is a four-storey building with two classrooms per floor level. This school building got 50%, which means half of the accessibility requirements that were met—such as door and entrances, corridors and hallways, washroom and toilets, and accessible ramps.",
    24 => "The CavSci -- Beauty Care NC2 School Building 10 is a two-storey building with one classroom per floor level. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. It doesn't have accessible ramps, signages, and also washrooms and toilets.",
    25 => "The CavSci – Science Laboratory Building 14 is a two-storey building with two Laboratory rooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that were met is the corridor and hallway only. This building does not have accessible ramps, signages, and washrooms and toilets.",
    // BUCAL 1
    26 => "The Barangay Hall of Bucal 1 is a small administrative building that serves as the central location for barangay government functions. This government building got 50%, which means it complies with half of the accessibility features–including doors and entrances, hallways and corridors, accessible ramps and parking.",
    // BUCAL 2
    27 => "The Barangay Hall of Bucal 2 is a small administrative building that serves as the central location for barangay government functions. The barangay hall is located beside the road and Bucal 2 Elementary School. This government building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This barangay hall doesn't have any parking, accessible ramps, or even enough spaces for hallways and corridors.",
    // BNIS Buildings
    28 => "The BNIS – PagCor Building is a two-storey building with two classrooms per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps.",
    29 => "The BNIS – Senior High Laboratory Building is a four-storey building with two classrooms per floor level used by the senior high school students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps.",
    30 => "The BNIS – ABM Building is a two-storey building with two classrooms per floor level used by the Senior High School ABM Students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps.",
    31 => "The BNIS – Sigla Building is a four-storey building with two classrooms per floor level used by the Junior High School Students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps.",
    32 => "The BNIS – Stockroom Building is a two-storey building with one classroom per floor level used as storage rooms. This school building got 25%, which means there are two accessibility requirements that were met—such as doors and entrances, and corridors and hallways.",
    33 => "The BNIS – HUMSS Building is a four-storey building with two classrooms per floor level used by Senior High School HUMSS Students. This school building got 37.5%, which means there are three accessibility requirements that were met—including door and entrances, corridors and hallways, and accessible ramps.",
    34 => "The BNIS – Encantadia Building is a two-storey building with two classrooms per floor level. This school building got 12.5%, indicating that there is only one accessibility requirement that was met. There are no accessible ramps, only corridors and hallways are complied.",
    // BUCAL 3A
    35 => "The Barangay Hall of Bucal 3A is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, indicating it complies with only one of the accessibility features, which is corridor and hallways. The barangay hall is located near the road. That's why it didn't meet the standard of having parking and accessible ramps.",
    // BUCAL 3B
    36 => "The Barangay Hall of Bucal 3B is a small administrative building that serves as the central location for barangay government functions. This government building got 25%, indicating it complies with two of the accessibility features, which are doors and entrances, and corridor and hallways. The barangay hall didn't meet the standard of having parking.",
    // BUCAL 4A
    37 => "The Barangay Hall of Bucal 4A is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, indicating it complies with only one of the accessibility features, which is corridor and hallways. The barangay hall is located beside the court in Bucal 4A, that's why it didn't meet the standard of having accessible ramps and parking.",
    // BUCAL 4B
    38 => "The Barangay Hall of Bucal 4a is a small administrative building that serves as the central location for barangay government functions. This government building got 25%, indicating it complies with two of the accessibility features, which is doors and entrances, and corridor and hallways. The barangay hall is located near the street road. That's why it doesn't have parking and accessible ramps.",
    // PINAGSANHAN B
    39 => "The CvSU Maragondon – High School is a two-storey building with four classrooms per floor level used by the Junior High School Students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. This school building doesn't have accessible ramps and designated parking spaces in the campus.",
    40 => "The CvSU Maragondon – Elementary School is a two-storey building with four classrooms per floor level used by the Elementary Students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. This school building doesn't have accessible ramps and designated parking spaces in the campus."
];

// Process each building
foreach ($accessibility_summaries as $building_id => $summary) {
    // Get the current summary to preserve infrastructure and fire safety sections
    $current_query = "SELECT audit_summary FROM building_audits WHERE building_id = ?";
    $stmt = $conn->prepare($current_query);
    $stmt->bind_param("i", $building_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    if ($row) {
        // Split the current summary into sections
        $sections = explode("\n\n", $row['audit_summary']);
        $infrastructure = $sections[0] ?? '';
        $fire_safety = $sections[1] ?? '';
        
        // Create new summary with updated accessibility section
        $new_summary = $infrastructure . "\n\n" . $fire_safety . "\n\nAccessibility\n" . $summary;
        
        // Update the database
        $update_stmt->bind_param("si", $new_summary, $building_id);
        
        if ($update_stmt->execute()) {
            echo "✅ Updated accessibility summary for Building ID: " . $building_id . "\n";
        } else {
            echo "❌ Error updating Building ID: " . $building_id . " - " . $update_stmt->error . "\n";
        }
    } else {
        echo "⚠️ Building ID not found: " . $building_id . "\n";
    }
}

$update_stmt->close();
$conn->close();

echo "\n🔄 Process completed!\n"; 