<?php
require_once 'include/config.php';

try {
    // First create a backup
    $backup_file = 'db/backups/marag_audit_full_backup_' . date('Y-m-d_H-i-s') . '.sql';
    $command = "mysqldump -u root marag_audit > " . $backup_file;
    exec($command);
    echo "Database backup created successfully at: " . $backup_file . "\n";

    // Connect to database
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Update accessibility audit summaries
    $updates = [
        // Municipal Hall
        [1, 1, 3, "The municipal hall building is a primary administrative building for a municipality; many people came to this building for some transactions. This is the only government building that almost got perfect to comply with the accessibility checklist. The only thing that this building didn't comply with is the elevator."],
        
        // DILG Building
        [1, 2, 3, "The DILG building is located beside the municipal hall building; this building got 25%, which means it meets two accessibility features—including corridor and parking. This government building is connected with the municipal hall; that's why the washroom and toilet are in the main building."],
        
        // Mayor's Office
        [1, 3, 3, "The mayor's office building is also located beside and connected building in the municipal hall. This government building got 37.5%, which means this building complies with three accessibility features, which are doors and entrances, hallways and corridors, and parking."],
        
        // Multi-purpose Hall Poblacion 1A
        [1, 8, 3, "The Barangay Hall of Poblacion 1A is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features—including doors and entrances, hallways and corridors, and washrooms and toilets."],
        
        // Municipal Tourism Office
        [1, 4, 3, "The Municipal Tourism Office is an office focused on promoting and developing tourism within the municipality. This government building got 12.5%, which means it satisfied only one accessibility feature, which is the hallways and corridors only. This is located beside the road; that's why this building doesn't have parking and accessible ramps."],
        
        // Barangay Hall Poblacion 1B
        [9, 9, 3, "The Barangay Hall of Poblacion 1B is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features—including hallways and corridors, accessible ramps, and parking."],
        
        // MDRRMO
        [5, 5, 3, "The Municipal Disaster Risk Reduction and Management Office is a local government unit office that is responsible for disaster preparedness, response, and recovery within its jurisdiction. This building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This building is a rental space since the old MDRRMO burned down."],
        
        // Barangay Hall Poblacion 2B
        [5, 10, 3, "The Barangay Hall of Poblacion 2B is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, which means it complies with only one accessibility feature which is the hallways and corridor. This barangay hall doesn't have any parking, accessible ramps, and especially elevator."],
        
        // Barangay Hall Caingin
        [11, 11, 3, "The Barangay Hall of Poblacion 2B is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features–including doors and entrances, hallways and corridors, and washroom and toilet. This barangay hall doesn't have any parking, accessible ramps, and especially elevator."],
        
        // Multi-purpose Hall Caingin
        [11, 12, 3, "The Multi-Purpose Hall of Poblacion 3 (Caingin) serves as a place for barangay meetings, assemblies, and the Sangguniang Kabataan Office. This government building got 37.5%, which means it satisfies three accessibility requirements—including doors and entrances, corridors and hallways, and parking."],
        
        // Municipal Circuit Trial Court
        [6, 6, 3, "The Municipal Circuit Trial Court is the first-level court of two or more municipalities; it is a local venue for individuals to seek legal redress and resolve disputes. This government building is located at Garita A and got 25%, which means two accessibility features were acquired—including doors and corridors, and hallways and corridor. This building was near the street road and doesn't have parking."],
        
        // Maragondon Police Station
        [6, 7, 3, "The Maragondon Police Station Building is an office that has the duty to fulfill a variety of community responsibilities, such as upholding the peace, handling emergencies, etc. This government building got a 37.5%, which means it complies with three accessibility requirements—including doors and entrances, hallways and corridors, and parking. This building doesn't have any accessible ramps since there's no stair or high level at the entrance."],
        
        // MES Building 1
        [6, 20, 3, "The Maragondon Elementary School—Building 1 is a two-storey building with one classroom per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as doors and entrances, corridors and hallways, and accessible ramps."],
        
        // MES Building 2
        [6, 21, 3, "The Maragondon Elementary School—Building 2 is a two-storey building with two classrooms per floor level used by grade 5 students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways."],
        
        // MES Building 3
        [6, 22, 3, "The Maragondon Elementary School—Building 3 is a two-storey building with two classrooms per floor level used by grade 6 students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps."],
        
        // MNHS Building 1
        [6, 23, 3, "The Maragondon High School—Building 1 is a four-storey building with two classrooms per floor level used by senior high school students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps."],
        
        // MNHS Building 2
        [6, 24, 3, "The Maragondon High School—Building 2 is a two-storey building with two classrooms per floor level used by grade 7 students. This school building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This building failed to provide enough space for corridors and doesn't have accessible ramps or even a comfort room in the building."],
        
        // CSIS Building 4
        [32, 32, 3, "The CavSci - DepEd Standard School Building 4 is a four-storey building with two classrooms per floor level. This school building got 50%, which means half of the accessibility requirements that were met—such as door and entrances, corridors and hallways, washroom and toilets, and accessible ramps."],
        
        // CSIS Building 5
        [32, 33, 3, "The CavSci – Maliksi Building 5 is a two-storey building with two classrooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that was met is the corridor and hallway."],
        
        // CSIS Building 6
        [32, 34, 3, "The CavSci – Modified School Building 6 is a two-storey building with two classrooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that was met is the corridor and hallway. This is the oldest building in Cavsci, and doesn't have accessible ramps and signages."],
        
        // CSIS Building 7
        [32, 35, 3, "The CavSci – DepEd Standard School Building 7 is a four-storey building with two classrooms per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps."],
        
        // CSIS Building 9
        [32, 36, 3, "The CavSci – Science Laboratory Building 9 is a four-storey building with two classrooms per floor level. This school building got 50%, which means half of the accessibility requirements that were met—such as door and entrances, corridors and hallways, washroom and toilets, and accessible ramps."],
        
        // CSIS Building 10
        [32, 37, 3, "The CavSci -- Beauty Care NC2 School Building 10 is a two-storey building with one classroom per floor level. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. It doesn't have accessible ramps, signages, and also washrooms and toilets."],
        
        // CSIS Building 14
        [32, 38, 3, "The CavSci – Science Laboratory Building 14 is a two-storey building with two Laboratory rooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that were met is the corridor and hallway only. This building does not have accessible ramps, signages, and washrooms and toilets."],
        
        // Multi-purpose Hall Bucal 1
        [14, 14, 3, "The Barangay Hall of Bucal 1 is a small administrative building that serves as the central location for barangay government functions. This government building got 50%, which means it complies with half of the accessibility features–including doors and entrances, hallways and corridors, accessible ramps and parking."],
        
        // Barangay Hall Bucal 2
        [15, 15, 3, "The Barangay Hall of Bucal 2 is a small administrative building that serves as the central location for barangay government functions. The barangay hall is located beside the road and Bucal 2 Elementary School. This government building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This barangay hall doesn't have any parking, accessible ramps, or even enough spaces for hallways and corridors."],
        
        // BNIS PagCor Building
        [15, 25, 3, "The BNIS – PagCor Building is a two-storey building with two classrooms per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps."],
        
        // BNIS SH Laboratory Building
        [15, 26, 3, "The BNIS – Senior High Laboratory Building is a four-storey building with two classrooms per floor level used by the senior high school students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps."],
        
        // BNIS ABM Building
        [15, 27, 3, "The BNIS – ABM Building is a two-storey building with two classrooms per floor level used by the Senior High School ABM Students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps."],
        
        // BNIS Sigla Building
        [15, 28, 3, "The BNIS – Sigla Building is a four-storey building with two classrooms per floor level used by the Junior High School Students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps."],
        
        // BNIS Stockroom Building
        [15, 29, 3, "The BNIS – Stockroom Building is a two-storey building with one classroom per floor level used as storage rooms. This school building got 25%, which means there are two accessibility requirements that were met—such as doors and entrances, and corridors and hallways."],
        
        // BNIS HUMSS Building
        [15, 30, 3, "The BNIS – HUMSS Building is a four-storey building with two classrooms per floor level used by Senior High School HUMSS Students. This school building got 37.5%, which means there are three accessibility requirements that were met—including door and entrances, corridors and hallways, and accessible ramps."],
        
        // BNIS Encantadia Building
        [15, 31, 3, "The BNIS – Encantadia Building is a two-storey building with two classrooms per floor level. This school building got 12.5%, indicating that there is only one accessibility requirement that was met. There are no accessible ramps, only corridors and hallways are complied."],
        
        // Barangay Hall Bucal 3A
        [16, 16, 3, "The Barangay Hall of Bucal 3A is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, indicating it complies with only one of the accessibility features, which is corridor and hallways. The barangay hall is located near the road. That's why it didn't meet the standard of having parking and accessible ramps."],
        
        // Barangay Hall Bucal 3B
        [17, 17, 3, "The Barangay Hall of Bucal 3B is a small administrative building that serves as the central location for barangay government functions. This government building got 25%, indicating it complies with two of the accessibility features, which are doors and entrances, and corridor and hallways. The barangay hall didn't meet the standard of having parking."],
        
        // Barangay Hall Bucal 4A
        [18, 18, 3, "The Barangay Hall of Bucal 4A is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, indicating it complies with only one of the accessibility features, which is corridor and hallways. The barangay hall is located beside the court in Bucal 4A, that's why it didn't meet the standard of having accessible ramps and parking."],
        
        // Multi-purpose Hall Bucal 4B
        [19, 19, 3, "The Barangay Hall of Bucal 4a is a small administrative building that serves as the central location for barangay government functions. This government building got 25%, indicating it complies with two of the accessibility features, which is doors and entrances, and corridor and hallways. The barangay hall is located near the street road. That's why it doesn't have parking and accessible ramps."],
        
        // CvSU Marag High School Building
        [39, 39, 3, "The CvSU Maragondon – High School is a two-storey building with four classrooms per floor level used by the Junior High School Students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. This school building doesn't have accessible ramps and designated parking spaces in the campus."],
        
        // CvSU Marag Elementary Building
        [39, 40, 3, "The CvSU Maragondon – Elementary School is a two-storey building with four classrooms per floor level used by the Elementary Students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. This school building doesn't have accessible ramps and designated parking spaces in the campus."]
    ];

    // Prepare the update statement
    $stmt = $pdo->prepare("
        UPDATE building_checklist_description 
        SET summary = :summary 
        WHERE barangay_id = :barangay_id 
        AND building_id = :building_id 
        AND audit_type_id = :audit_type_id
    ");

    // Execute updates
    foreach ($updates as $update) {
        $stmt->execute([
            'barangay_id' => $update[0],
            'building_id' => $update[1],
            'audit_type_id' => $update[2],
            'summary' => $update[3]
        ]);
    }

    echo "Successfully updated all accessibility audit summaries.\n";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?> 