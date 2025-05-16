-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 05:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marag_audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_checklists`
--

CREATE TABLE `audit_checklists` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `audit_type_id` int(11) NOT NULL,
  `checklist_path` varchar(255) NOT NULL,
  `status` enum('pending','completed','in_progress') DEFAULT 'pending',
  `audit_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_checklists`
--

INSERT INTO `audit_checklists` (`id`, `building_id`, `audit_type_id`, `checklist_path`, `status`, `audit_date`, `notes`, `created_at`) VALUES
(1, 31, 1, 'assets/checklist/Bucal 2/BNIS - Encantadia/Infra Audit/BNIS Encantadia Building - Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(2, 31, 3, 'assets/checklist/Bucal 2/BNIS - Encantadia/Accessibility/BNIS - Encantadia.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(3, 15, 1, 'assets/checklist/Bucal 2/Multi-purpose Hall/Infra Audit/Bucal 2 Multi-purpose Hall - Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(4, 15, 3, 'assets/checklist/Bucal 2/Multi-purpose Hall/Accessibility/BH BUCAL 2.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(5, 18, 1, 'assets/checklist/Bucal 4A/Barangay Hall/Infra Audit/Bucal 4A Barangay Hall - Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(6, 18, 3, 'assets/checklist/Bucal 4A/Barangay Hall/Accessibility/BH Bucal 4A.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(7, 20, 1, 'assets/checklist/Garita A/MES - Building 1/Infra Audit/MES Building 1 - Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(8, 20, 3, 'assets/checklist/Garita A/MES - Building 1/Accessibility/MES-BUILDING 1.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(9, 24, 1, 'assets/checklist/Garita A/MNHS - Building 2/Infra Audit/MNHS Building 2 - Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(10, 24, 3, 'assets/checklist/Garita A/MNHS - Building 2/Accessibility/MHS - Building 2.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(11, 6, 1, 'assets/checklist/Garita A/Trial Court/Infra Audit/Municipal Trial Court - Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(12, 6, 3, 'assets/checklist/Garita A/Trial Court/Accessibility/TRIAL COURT.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(13, 34, 1, 'assets/checklist/Garita B/CavSci - DepEd Modified School Building 6/Infra Audit/CavSci DepEd Modified School Building 6.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(14, 34, 3, 'assets/checklist/Garita B/CavSci - DepEd Modified School Building 6/Accessibility/CavSci- Building 6.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(15, 39, 1, 'assets/checklist/Pinagsanhan B/CvSU Marag - HS Building/Infra Audit/CvSU Maragondon High School Building - Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(16, 39, 3, 'assets/checklist/Pinagsanhan B/CvSU Marag - HS Building/Accessibility/CvSU Marag - HS Building.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(17, 1, 1, 'assets/checklist/Poblacion 1A/Municipal Hall/Infra Audit/Municipal Hall -Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(18, 1, 3, 'assets/checklist/Poblacion 1A/Municipal Hall/Accessibility/MUNICIPAL HALL.pdf.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(19, 5, 1, 'assets/checklist/Poblacion 2B/MDRRMO/Infra Audit/MDRRMO - Infrastructure Audit.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(20, 5, 3, 'assets/checklist/Poblacion 2B/MDRRMO/Accessibility/MDRRMO.pdf', 'completed', NULL, NULL, '2025-05-12 04:45:54'),
(26, 15, 2, 'assets/checklist/Bucal 2/Multi-purpose Hall/Fire Safety/(FIRE) BH Bucal 2.pdf', 'completed', NULL, NULL, '2025-05-12 13:14:12'),
(27, 20, 2, 'assets/checklist/Garita A/MES - Building 1/Fire Safety/(FIRE) MES Bldg 1.pdf', 'completed', NULL, NULL, '2025-05-12 13:14:12'),
(28, 34, 2, 'assets/checklist/Garita B/CavSci - DepEd Modified School Building 6/Fire Safety/(FIRE) CSIS Modified School Bldg 6.pdf', 'completed', NULL, NULL, '2025-05-12 13:14:12'),
(29, 5, 2, 'assets/checklist/Poblacion 2B/MDRRMO/Fire Safety/(FIRE) MDRRMO.pdf', 'completed', NULL, NULL, '2025-05-12 13:14:12'),
(30, 31, 2, 'assets/checklist/Bucal 2/BNIS - Encantadia/Fire Safety/(FIRE) BNIS Encantadia.pdf', 'completed', NULL, NULL, '2025-05-12 13:36:53'),
(31, 18, 2, 'assets/checklist/Bucal 4A/Barangay Hall/Fire Safety/(FIRE) BH Bucal 4A.pdf', 'completed', NULL, NULL, '2025-05-12 13:36:53'),
(32, 6, 2, 'assets/checklist/Garita A/Trial Court/Fire Safety/(FIRE) Municipal Circuit Trial Court.pdf', 'completed', NULL, NULL, '2025-05-12 13:36:53'),
(33, 39, 2, 'assets/checklist/Pinagsanhan B/CvSU Marag - HS Building/Fire Safety/(FIRE) CvSU Maragondon HS Bldg.pdf', 'completed', NULL, NULL, '2025-05-12 13:36:53'),
(34, 1, 2, 'assets/checklist/Poblacion 1A/Municipal Hall/Fire Safety/(FIRE) Municipal Hall of Maragondon.pdf', 'completed', NULL, NULL, '2025-05-12 13:36:53'),
(35, 24, 2, 'assets/checklist/Garita A/MNHS - Building 2/Fire Safety/(FIRE) MNHS Bldg 2.pdf', 'completed', NULL, NULL, '2025-05-12 14:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `audit_types`
--

CREATE TABLE `audit_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_types`
--

INSERT INTO `audit_types` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'infrastructure', 'Infrastructure Audit Checklist', '2025-05-12 04:31:57'),
(2, 'fire_safety', 'Fire Safety Audit Checklist', '2025-05-12 04:31:57'),
(3, 'accessibility', 'Accessibility Audit Checklist', '2025-05-12 04:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `name`, `created_at`) VALUES
(1, 'Poblacion 1A', '2025-05-12 04:06:56'),
(5, 'Poblacion 2B', '2025-05-12 04:06:56'),
(6, 'Garita A', '2025-05-12 04:06:56'),
(9, 'Poblacion 1B', '2025-05-12 04:06:56'),
(11, 'Caingin', '2025-05-12 04:06:56'),
(14, 'Bucal 1', '2025-05-12 04:06:56'),
(15, 'Bucal 2', '2025-05-12 04:06:56'),
(16, 'Bucal 3A', '2025-05-12 04:06:56'),
(17, 'Bucal 3B', '2025-05-12 04:06:56'),
(18, 'Bucal 4A', '2025-05-12 04:06:56'),
(19, 'Bucal 4B', '2025-05-12 04:06:56'),
(32, 'Garita B', '2025-05-12 04:06:56'),
(39, 'Pinagsanhan B', '2025-05-12 04:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `storey_count` int(11) NOT NULL,
  `construction_year` varchar(50) DEFAULT NULL,
  `building_type` varchar(100) NOT NULL,
  `structure_type` varchar(100) NOT NULL,
  `occupancy` varchar(100) NOT NULL,
  `design_occupancy` varchar(100) DEFAULT NULL,
  `occupant_count` varchar(100) DEFAULT NULL,
  `nscp_edition_year` varchar(50) DEFAULT NULL,
  `is_original` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `barangay_id`, `location`, `height`, `storey_count`, `construction_year`, `building_type`, `structure_type`, `occupancy`, `design_occupancy`, `occupant_count`, `nscp_edition_year`, `is_original`, `created_at`) VALUES
(1, 'Municipal hall of Maragondon - Main Building', 1, 'Poblacion 1A', 9.65, 2, 'Unable to retrieve', 'Timber Frame', 'Build-up Section', 'Offices', '', 'Pre-Code', 'YES', '', '2025-05-12 04:14:49'),
(2, 'Sangguniang Bayan - Second Building', 1, 'Poblacion 1A', 12.75, 3, 'Unable to retrieve', 'Concrete Frame', 'Build-up Section', 'Offices', '15', 'Unable to identify', 'YES', '', '2025-05-12 04:14:49'),
(3, 'Office of the Mayor - Third Building', 1, 'Poblacion 1A', 9.65, 2, 'Unable to retrieve', 'Timber Frame', 'Build-up Section', 'Offices', '18-20', 'Unable to identify', 'YES', '', '2025-05-12 04:14:49'),
(4, 'Municipal Environment and Natural Resources Office/Municipal Tourism Office', 1, 'Poblacion 1A', 10.65, 2, '2010-2013', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'Offices', '8', '2010', 'YES', '', '2025-05-12 04:14:49'),
(5, 'Municipal Disaster Risk Reduction Management Office', 5, 'Poblacion 2B', 8.35, 2, '2010-2011', 'Concrete Frame', 'Cast-in-Place', 'Offices', '12', '2010', 'YES', '', '2025-05-12 04:14:49'),
(6, 'Municipal Circuit Trial Court', 6, 'Garita A', 8.15, 2, '2011-2012', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '9-10', '2010', 'YES', '', '2025-05-12 04:14:49'),
(7, 'Maragondon Police Station', 6, 'Garita A', 13.80, 3, '2016', 'Concrete Frame', 'Cast-in-Place', 'Offices', '48-50', '2015', 'YES', '', '2025-05-12 04:14:49'),
(8, 'Multipurpose Hall Poblacion 1A', 1, 'Poblacion 1A', 8.55, 2, '2023', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '5', '2015', 'YES', '', '2025-05-12 04:14:49'),
(9, 'Multipurpose Hall Poblacion 1B', 9, 'Poblacion 1B', 8.33, 2, '2022', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '6', '2015', 'YES', '', '2025-05-12 04:14:49'),
(10, 'Barangay Hall Poblacion 2B', 5, 'Poblacion 2B', 8.29, 2, '2022-2023', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '6', '2015', 'YES', '', '2025-05-12 04:14:49'),
(11, 'Barangay Hall Caingin', 11, 'Caingin', 9.55, 2, '2024', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '8', '2015', 'YES', '', '2025-05-12 04:14:49'),
(12, 'Multipurpose Hall Caingin', 11, 'Caingin', 8.39, 2, '2024', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '30', '2015', 'YES', '', '2025-05-12 04:14:49'),
(13, 'Barangay Hall Garita A', 6, 'Garita A', 8.45, 2, '2019', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '15-20', '2015', 'YES', '', '2025-05-12 04:14:49'),
(14, 'Multipurpose Hall Bucal 1', 14, 'Bucal 1', 8.49, 2, '2023', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '10', '2015', 'YES', '', '2025-05-12 04:14:49'),
(15, 'Multipurpose Hall Bucal 2', 15, 'Bucal 2', 8.65, 2, '1989', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '8', '1987', 'NO', '', '2025-05-12 04:14:49'),
(16, 'Barangay Hall Bucal 3A', 16, 'Bucal 3A', 8.61, 2, '2019', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '5', '2015', 'YES', '', '2025-05-12 04:14:49'),
(17, 'Barangay Hall Bucal 3B', 17, 'Bucal 3B', 8.23, 2, '2022', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '6', '2015', 'YES', '', '2025-05-12 04:14:49'),
(18, 'Barangay Hall Bucal 4A', 18, 'Bucal 4A', 8.85, 2, '2017', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '10', '2015', 'NO', '', '2025-05-12 04:14:49'),
(19, 'Multipurpose Hall Bucal 4B', 19, 'Bucal 4B', 8.21, 2, '2019', 'Concrete Frame', 'Cast-in-Place', 'Public Assembly', '9', '2015', 'YES', '', '2025-05-12 04:14:49'),
(20, 'Maragondon Elementary School - Building 1', 6, 'Garita A', 6.87, 2, '2015', 'Concrete Frame', 'Cast-in-Place', 'School', '160', '2015', 'YES', '', '2025-05-12 04:14:49'),
(21, 'Maragondon Elementary School - Building 2', 6, 'Garita A', 9.17, 2, '2010', 'Concrete Frame', 'Cast-in-Place', 'School', '160-200', '2010', 'YES', '', '2025-05-12 04:14:49'),
(22, 'Maragondon Elementary School - Building 3', 6, 'Garita A', 9.19, 2, 'Unable to retrieve', 'Concrete Frame', 'Cast-in-Place', 'School', '120-150', 'Unable to identify', 'YES', '', '2025-05-12 04:14:49'),
(23, 'Maragondon National High School - Building 1', 6, 'Garita A', 15.77, 4, '2018', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '215', '2015', 'YES', '', '2025-05-12 04:14:49'),
(24, 'Maragondon National High School - Building 2', 6, 'Garita A', 9.17, 2, '2007', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '', '2001', 'YES', '', '2025-05-12 04:14:49'),
(25, 'Bucal National Integrated School - PAGCOR', 15, 'Bucal 2', 9.33, 2, '2014', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '', '2010', 'YES', '', '2025-05-12 04:14:49'),
(26, 'Bucal National Integrated School - SH Laboratory', 15, 'Bucal 2', 15.73, 4, '2019', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '300', '2015', 'YES', '', '2025-05-12 04:14:49'),
(27, 'Bucal National Integrated School - ABM Building', 15, 'Bucal 2', 9.27, 2, '2014', 'Concrete Frame', 'Cast-in-Place', 'School', '70', '2010', 'YES', '', '2025-05-12 04:14:49'),
(28, 'Bucal National Integrated School - SIGLA Building', 15, 'Bucal 2', 15.69, 4, '2018-2019', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '800', '2015', 'YES', '', '2025-05-12 04:14:49'),
(29, 'Bucal National Integrated School - Stockroom Building', 15, 'Bucal 2', 9.27, 2, '2014', 'Concrete Frame', 'Cast-in-Place', 'School', '3-6', '2010', 'YES', '', '2025-05-12 04:14:49'),
(30, 'Bucal National Integrated School - HUMMS Building', 15, 'Bucal 2', 12.48, 3, '2016', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '', '2015', 'YES', '', '2025-05-12 04:14:49'),
(31, 'Bucal National Integrated School - Encantadia Building', 15, 'Bucal 2', 8.99, 2, '2001', 'Concrete Frame', 'Cast-in-Place', 'School', '160-170', '2001', 'YES', '', '2025-05-12 04:14:49'),
(32, 'CSIS-RSHS - DepEd Standard School Building 4', 32, 'Garita B', 16.13, 4, '2016', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '320', '2015', 'YES', '', '2025-05-12 04:14:49'),
(33, 'CSIS-RSHS - Maliksi Building 5', 32, 'Garita B', 9.25, 2, '2010', 'Concrete Frame', 'Cast-in-Place', 'School', '160', '2010', 'YES', '', '2025-05-12 04:14:49'),
(34, 'CSIS-RSHS - Modified School Building 6', 32, 'Garita B', 9.43, 2, '2006', 'Concrete Frame', 'Cast-in-Place', 'School', '', '2001', 'YES', '', '2025-05-12 04:14:49'),
(35, 'CSIS-RSHS - DepEd Standard School Building 7', 32, 'Garita B', 12.34, 3, '2015', 'Concrete Frame', 'Cast-in-Place', 'School', '', '2015', 'YES', '', '2025-05-12 04:14:49'),
(36, 'CSIS-RSHS - Science Laboratory Building 9', 32, 'Garita B', 15.85, 4, '2018', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '170', '2015', 'YES', '', '2025-05-12 04:14:49'),
(37, 'CSIS-RSHS - Beautycare N.C 2 Building 10', 32, 'Garita B', 9.55, 2, '2013', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '', '2010', 'YES', '', '2025-05-12 04:14:49'),
(38, 'CSIS-RSHS - Science Laboratory Building 14', 32, 'Garita B', 9.43, 2, '2005', 'Concrete Frame', 'Cast-in-Place', 'School', '', '2001', 'YES', '', '2025-05-12 04:14:49'),
(39, 'CvSU - Maragondon Campus - High School Building', 39, 'Pinagsanhan B', 9.69, 2, '2015', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '170', '2015', 'YES', '', '2025-05-12 04:14:49'),
(40, 'CvSU - Maragondon Campus - Elementary Building', 39, 'Pinagsanhan B', 9.69, 2, '2015', 'Concrete Frame', 'Pre-cast and Cast-in-Place', 'School', '180-190', '2015', 'YES', '', '2025-05-12 04:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `building_checklist_description`
--

CREATE TABLE `building_checklist_description` (
  `id` int(11) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `audit_type_id` int(11) NOT NULL,
  `summary` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building_checklist_description`
--

INSERT INTO `building_checklist_description` (`id`, `barangay_id`, `building_id`, `audit_type_id`, `summary`, `created_at`) VALUES
(52, 1, 1, 1, 'The building exhibits structural vulnerabilities that may compromise its integrity during seismic events. Its timber frame and build-up section construction are not ideal for resisting lateral loads from earthquakes. Immediate structural assessment and reinforcement are recommended to enhance seismic performance. Minor non-structural and auxiliary defects should also be addressed to prevent additional risk during tremors. Strengthening the structure will significantly improve safety and prolong service life under seismic conditions.', '2025-05-12 15:11:17'),
(53, 1, 1, 2, 'There are two exits, one is out to the main door, the other is a spiral stair and accessible on the second floor of the building. Exit is free of obstructions to the path and the doors are opening properly in the direction of the egress. The building lacks signages like exit signs, “no smoking” signs and there is no evacuation plan posted. All hazardous items that may cause fire are properly stored, but the stairs are occupied and serve as a space for an office department. Fire extinguishers, fire alarms and sprinklers are present for the fire protection system of the building.', '2025-05-12 15:11:17'),
(54, 1, 1, 3, 'The municipal hall building is a primary administrative building for a municipality; many people came to this building for some transactions. This is the only government building that almost got perfect to comply with the accessibility checklist. The only thing that this building didn’t comply with is the elevator. Sangguniang Bayan/DILG Building (Second Building)', '2025-05-12 15:11:17'),
(55, 1, 2, 1, 'The structure has been assessed as vulnerable due to evident severe structural defects that increase its susceptibility to seismic loads. Its concrete frame requires urgent reinforcement to ensure adequate resistance against earthquake-induced forces. Localized non-structural and auxiliary defects may also amplify the building’s overall vulnerability. A comprehensive seismic retrofitting plan should be considered to protect occupants and maintain functionality. Regular seismic risk assessments must be incorporated into its maintenance strategy.', '2025-05-12 15:11:17'),
(56, 1, 2, 2, 'The building is considered as an extension of the main building of the municipal hall, so its secondary exit is also accessible on the second floor of the building. Exit is free of obstructions and the doors open properly and swing in the direction of the egress. Lack of signs like exit signs and no evacuation plan posted. All hazardous items that may cause fire are properly stored and main stairs are not occupied nor used for storage. Fire extinguishers and fire alarms are present for the fire protection system of the building.', '2025-05-12 15:11:17'),
(57, 1, 2, 3, 'The DILG building is located beside the municipal hall building; this building got 25%, which means it meets two accessibility features—including corridor and parking. This government building is connected with the municipal hall; that’s why the washroom and toilet are in the main building. Mayor’s Office (Third Building)', '2025-05-12 15:11:17'),
(58, 1, 3, 1, 'Although the building shows only minor structural issues, its timber frame construction raises concern regarding seismic resistance. Timber structures, while flexible, may lack sufficient strength under prolonged or high-magnitude earthquake loads. Non-structural and auxiliary components must be secured to minimize hazard during ground motion. Proactive strengthening of structural elements is advised to reduce seismic risk. Monitoring and preventive measures are essential to ensure resilience against future seismic events.', '2025-05-12 15:11:17'),
(59, 1, 3, 2, 'The mayor’s office is also connected as an extension of the main building of the municipal hall. The exits are accessible  through the main building and on the first floor. Lack of signs like exit signs, “no smoking” signs and no evacuation plan posted. All hazardous items that may cause fire are properly stored and main stairs are not occupied nor used for storage. Fire extinguishers and fire alarms are present for the fire protection system of the building.', '2025-05-12 15:11:17'),
(60, 1, 3, 3, 'The mayor’s office building is also located beside and connected building in the municipal hall. This government building got 37.5%, which means this building complies with three accessibility features, which are doors and entrances, hallways and corridors, and parking. Multi-purpose Hall Poblacion 1A', '2025-05-12 15:11:17'),
(61, 1, 8, 1, 'Though the structure shows only minor defects, its ability to endure seismic loads must be confirmed through detailed evaluation. The cast-in-place concrete frame offers good potential for reinforcement to meet seismic standards. Auxiliary and non-structural elements must be anchored properly to prevent detachment during earthquakes. Preventive maintenance and seismic upgrades are recommended to protect users. A preparedness plan should also be implemented for future events.', '2025-05-12 15:11:17'),
(62, 1, 8, 2, 'The only staircase of the barangay hall is located on the exterior of the building, which is the only access way to its second floor. The doors swing properly and swing in the direction of egress. No obstructions are in the direction of egress and all hazardous items that may cause fire are properly stored and the stair is not occupied nor used for storage.  Lack of signs like exit signs, “no smoking” signs and no evacuation plan posted. Fire extinguishers and fire alarms are present for the fire protection system of the building, although the extinguisher is not properly placed.', '2025-05-12 15:11:17'),
(63, 1, 8, 3, 'The Barangay Hall of Poblacion 1A is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features—including doors and entrances, hallways and corridors, and washrooms and toilets. Municipal Tourism Office', '2025-05-12 15:11:17'),
(64, 1, 4, 1, 'Severe structural defects in this concrete frame building significantly increase its risk during earthquakes. The mixed use of pre-cast and cast-in-place elements may create weak connections under lateral seismic loads. Strengthening these joints and reinforcing structural components is necessary to enhance earthquake resistance. Minor non-structural and auxiliary defects should also be corrected to avoid additional hazards. Seismic retrofitting is strongly recommended to improve the building’s integrity and safety.', '2025-05-12 15:11:17'),
(65, 1, 4, 2, 'The building is occupied by two municipal offices, the MTO is on the first floor while the MENRO is on the second floor. The doors have self-closing mechanisms and swing on the way of the egress. There are no obstructions on the pathway, all hazardous and combustible items are stored properly. Although the building lacks signages like exit signs, “no smoking” signs and there is no evacuation plan posted. The building only has a fire extinguisher for its fire protection system, but it fails in compliance as it is not in a proper location and its in a poor condition (expired, don’t have proper markings).', '2025-05-12 15:11:17'),
(66, 1, 4, 3, 'The Municipal Tourism Office is an office focused on promoting and developing tourism within the municipality. This government building got 12.5%, which means it satisfied only one accessibility feature, which is the hallways and corridors only. This is located beside the road; that’s why this building doesn’t have parking and accessible ramps. POBLACION 1B Barangay Hall Poblacion 1B', '2025-05-12 15:11:17'),
(67, 9, 9, 1, 'This building appears structurally sound but still requires measures to improve its earthquake resilience. Minor defects should not be ignored as they can worsen under repeated seismic activity. Anchoring and reinforcing weak sections will help prevent damage during tremors. Regular inspection focused on seismic performance is advisable. Incorporating earthquake-resistant details will enhance occupant safety.', '2025-05-12 15:11:17'),
(68, 9, 9, 2, 'The egress is properly maintained, as it is free from obstructions and the doors all open and closed properly and swings in the way of the egress. Although the space under the stairs is used for storage, there are no hazardous and combustible materials in sight. It lacks signs like exit signs, “no smoking” signs and no evacuation plan is posted within the building. The building has a fire hose stored, but it is not properly mounted on the wall and also not easily accessible, but the condition of the fire extinguisher is good and is in the right location.', '2025-05-12 15:11:17'),
(69, 9, 9, 3, 'The Barangay Hall of Poblacion 1B is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features—including hallways and corridors, accessible ramps, and parking. POBLACION 2B Municipal Disaster Risk Reduction and Management Office', '2025-05-12 15:11:17'),
(70, 5, 5, 1, 'While structural defects are minor, the building\'s integrity must be reinforced due to its critical function during disasters. Cast-in-place elements must be evaluated for their ability to withstand seismic forces. Non-structural and auxiliary components should be properly anchored to prevent collapse during earthquakes. Seismic strengthening should be prioritized to ensure operational continuity in emergencies. Regular drills and structural inspections are essential to maintain preparedness.', '2025-05-12 15:11:17'),
(71, 5, 5, 2, 'The building is only being used temporarily by the MDRRMO until they are provided with their own facilities.  It only has one main exit but it is well maintained, doors are opening and closing properly with its swing in the direction of the exit path. No hazardous and combustible materials are stored, the facility is avoiding it as the building is used to store items needed for emergencies. No signages and evacuation plan are posted. Fire extinguishers are properly maintained and stored as part of the facility’s duty, but the building lacks other type of fire protection system as it is only occupied temporarily.', '2025-05-12 15:11:17'),
(72, 5, 5, 3, 'The Municipal Disaster Risk Reduction and Management Office is a local government unit office that is responsible for disaster preparedness, response, and recovery within its jurisdiction. This building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This building is a rental space since the old MDRRMO burned down. Barangay Hall Poblacion 2B', '2025-05-12 15:11:17'),
(73, 5, 10, 1, 'The hall is in generally good condition, but its current form should still be evaluated for seismic safety. Even minor defects may contribute to larger failures during strong earthquakes. Strengthening structural joints and securing auxiliary components is essential for safety. Scheduled seismic inspections will help detect vulnerabilities early. Investing in preventive seismic upgrades ensures continued serviceability and occupant protection.', '2025-05-12 15:11:17'),
(74, 5, 10, 2, 'The doors are in good condition and swing in the way of the egress, but the building only has one exit path and sometimes it has obstructions. Although the building lacks signages like exit signs, “no smoking” and there is no evacuation plan in sight, various hazardous and combustible items are properly stored. There is a sprinkler system installed on the second floor, a fire alarm system and the condition of the fire extinguisher in the building is maintained well.', '2025-05-12 15:11:17'),
(75, 5, 10, 3, 'The Barangay Hall of Poblacion 2B is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, which means it complies with only one accessibility feature which is the hallways and corridor. This barangay hall doesn’t have any parking, accessible ramps, and especially elevator. POBLACION 3 (CAINGIN) Barangay Hall Caingin', '2025-05-12 15:11:17'),
(76, 11, 11, 1, 'The current condition of Barangay Hall Caingin is generally safe with minor non-structural defects, indicating adequate structural integrity. Maintenance practices appear consistent but could benefit from a more proactive schedule to address cosmetic and minor deterioration. Regular cleaning and minor repairs would enhance the building\'s longevity and serviceability. To improve maintenance efficiency, digital tracking of repair works and inspections is recommended. The data from this audit may be best presented through tabulated summaries and condition-rating visuals for easier analysis.', '2025-05-12 15:11:17'),
(77, 11, 11, 2, 'The building’s staircase is outside the building and is the only access to the second floor. The landing of the stairs and its distance to the entrances to the second floor is very narrow. Some hazardous items are not properly stored and maintained and it lacks exit signs, “no smoking” signs and no evacuation plan of the building is posted. The building does not have any fire protection systems like fire alarms and fire extinguishers', '2025-05-12 15:11:17'),
(78, 11, 11, 3, 'The Barangay Hall of Poblacion 2B is a small administrative building that serves as the central location for barangay government functions. This government building got 37.5%, which means it complies with three accessibility features–including doors and entrances, hallways and corridors, and washroom and toilet. This barangay hall doesn’t have any parking, accessible ramps, and especially elevator. Multi-Purpose Hall Caingin', '2025-05-12 15:11:17'),
(79, 11, 12, 1, 'Multipurpose Hall Caingin shows minor structural and non-structural defects, suggesting the infrastructure is still functional but requires attention. Existing maintenance appears reactive rather than preventive, which could lead to more costly repairs in the long run. Implementing scheduled maintenance routines and simple retrofitting measures will improve sustainability. A centralized maintenance log would help track recurring issues and optimize resource allocation. Using GIS mapping with condition markers can be an effective method to present the infrastructure data.', '2025-05-12 15:11:17'),
(80, 11, 12, 2, 'The building is newly built but its exit path is in compliance with the standard condition, where the doors are properly opening and closing, while the path itself is free from any obstructions. There are little items and furniture that can be found inside the building but the flammable materials are not maintained properly but its housekeeping equipment are. Fire protection systems are also not installed yet in the building.', '2025-05-12 15:11:17'),
(81, 11, 12, 3, 'The Multi-Purpose Hall of Poblacion 3 (Caingin) serves as a place for barangay meetings, assemblies, and the Sangguniang Kabataan Office. This government building got 37.5%, which means it satisfies three accessibility requirements—including doors and entrances, corridors and hallways, and parking. GARITA A Municipal Circuit Trial Court', '2025-05-12 15:11:17'),
(82, 6, 6, 1, 'The presence of severe structural defects poses a serious concern regarding the building\'s performance under seismic loads. The concrete frame must be reinforced to avoid catastrophic failure during earthquakes. Non-structural and auxiliary elements should be secured to prevent injury and disruption. A detailed structural audit focused on seismic resilience is essential. Implementing a seismic upgrade will ensure the safety of both occupants and judicial operations.', '2025-05-12 15:11:17'),
(83, 6, 6, 2, 'The building has a second floor but it is only unlocked and accessible on specific days. The mentioned second floor is only accessible through the staircase outside the building. The anteroom is very narrow due to it being used for storage of document files. It lacks signages like exit signs, “no smoking” signs and there is no evacuation plan posted. The building has a fire extinguisher and emergency light system as its fire protection system.', '2025-05-12 15:11:17'),
(84, 6, 6, 3, 'The Municipal Circuit Trial Court is the first-level court of two or more municipalities; it is a local venue for individuals to seek legal redress and resolve disputes. This government building is located at Garita A and got 25%, which means two accessibility features were acquired—including doors and corridors, and hallways and corridor. This building was near the street road and doesn’t have parking. Maragondon Police Station', '2025-05-12 15:11:17'),
(85, 6, 7, 1, 'The building’s minor structural and auxiliary defects must still be taken seriously due to its vital role in emergency response. Although the current condition is acceptable, reinforcing key structural elements is necessary to withstand seismic events. Securing non-structural components will also prevent hazards during ground motion. Periodic seismic evaluations should be part of the routine maintenance schedule. Investing in seismic resilience will enhance the station’s operational reliability.', '2025-05-12 15:11:17'),
(86, 6, 7, 2, 'The building has two exits, the secondary exit is located in the kitchen area. Both exits are in good condition where the doors are opening and closing properly, and no obstructions are in the path. Lacks signages, but all the hazardous and combustible materials are properly stored. The building has a fire alarm system and fire extinguishers in locations that are easily accessible.', '2025-05-12 15:11:17'),
(87, 6, 7, 3, 'The Maragondon Police Station Building is an office that has the duty to fulfill a variety of community responsibilities, such as upholding the peace, handling emergencies, etc. This government building got a 37.5%, which means it complies with three accessibility requirements—including doors and entrances, hallways and corridors, and parking. This building doesn’t have any accessible ramps since there’s no stair or high level at the entrance. Maragondon Elementary School MES - Building 1', '2025-05-12 15:11:17'),
(88, 6, 20, 1, 'Building 1 of Maragondon Elementary School shows some severe defects and minor non-structural issues, indicating a higher level of vulnerability. Current maintenance practices appear insufficient to address or prevent structural deterioration. Immediate structural rehabilitation and comprehensive inspection are strongly recommended. To improve infrastructure resilience, the school should adopt an integrated facility management system. A detailed report with before-and-after images and risk assessment charts will provide a comprehensive view of its condition.', '2025-05-12 15:11:17'),
(89, 6, 20, 3, 'The Maragondon Elementary School—Building 1 is a two-storey building with one classroom per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as doors and entrances, corridors and hallways, and accessible ramps. MES - Building 2', '2025-05-12 15:11:17'),
(90, 6, 21, 1, 'The building is generally in good condition, with only minor structural and non-structural defects present. Maintenance practices appear to be adequate but may benefit from more proactive scheduling. Despite being located in a typhoon- and earthquake-prone area, the structure follows a regular design, which supports seismic resistance. Loam soil provides fair foundation support, but periodic soil and structural checks are still recommended. To improve long-term performance, preventive maintenance and basic retrofitting for seismic resilience should be considered.', '2025-05-12 15:11:17'),
(91, 6, 21, 3, 'The Maragondon Elementary School—Building 2 is a two-storey building with two classrooms per floor level used by grade 5 students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. MES - Building 3', '2025-05-12 15:11:17'),
(92, 6, 22, 1, 'Though complete construction data is missing, the building exhibits only minor visible damage, suggesting it remains functional and structurally sound. Its regular form and safe location reduce seismic risk, but the absence of records weakens its long-term maintenance planning. Current upkeep seems effective but lacks documentation that could support better sustainability strategies. To improve, efforts should be made to collect missing information and implement a formal maintenance log. Regular inspections and basic structural assessments are encouraged to address any unseen vulnerabilities.', '2025-05-12 15:11:17'),
(93, 6, 22, 3, 'The Maragondon Elementary School—Building 3 is a two-storey building with two classrooms per floor level used by grade 6 students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps. Maragondon National High School MNHS - Building 1', '2025-05-12 15:11:17'),
(94, 6, 23, 1, 'This four-story structure is relatively new and shows minor defects only, indicating good initial construction quality. The regular configuration supports its performance under seismic loads, especially in a hazard-prone location like Maragondon. Maintenance appears sufficient so far, but long-term sustainability will depend on consistent monitoring. Due to its height and high occupancy, regular seismic vulnerability assessments are recommended. Implementing a preventive maintenance plan and emergency preparedness measures will enhance safety and efficiency.', '2025-05-12 15:11:17'),
(95, 6, 23, 3, 'The Maragondon High School—Building 1 is a four-storey building with two classrooms per floor level used by senior high school students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps. MNHS - Building 2', '2025-05-12 15:11:17'),
(96, 6, 24, 1, 'Some severe structural and localized non-structural defects were observed, suggesting that the building may need immediate attention. Though it maintains a regular shape and is built on stable soil, such damage could compromise its performance in a seismic event. Existing maintenance may be more reactive than preventive, allowing issues to progress. A detailed structural investigation is advised, followed by prioritized rehabilitation. Future management should shift toward scheduled, proactive maintenance and hazard-resilient retrofitting.', '2025-05-12 15:11:17'),
(97, 6, 24, 3, 'The Maragondon High School—Building 2 is a two-storey building with two classrooms per floor level used by grade 7 students. This school building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This building failed to provide enough space for corridors and doesn’t have accessible ramps or even a comfort room in the building. GARITA B Cavite Science Integrated School CSIS-RSHS - DepEd Standard School Building 4', '2025-05-12 15:11:17'),
(98, 32, 32, 1, 'This four-storey building is relatively new, with only minor defects observed, indicating that its condition remains good. The regular structural layout enhances its resilience against seismic activity, and the building is situated on stable loam soil. However, no rehabilitation or formal maintenance efforts have been reported, which may lead to gradual deterioration over time. The current passive maintenance approach could be improved by implementing periodic inspections and early repairs. Establishing a long-term maintenance strategy would ensure the building remains functional and structurally sound in the face of future hazards.', '2025-05-12 15:11:17'),
(99, 32, 32, 3, 'The CavSci - DepEd Standard School Building 4 is a four-storey building with two classrooms per floor level. This school building got 50%, which means half of the accessibility requirements that were met—such as door and entrances, corridors and hallways, washroom and toilets, and accessible ramps. CSIS-RSHS - Maliksi Building 5', '2025-05-12 15:11:17'),
(100, 32, 33, 1, 'This building exhibits minor structural and auxiliary defects, and its regular plan contributes positively to seismic resistance. It was constructed in 2010 and has not undergone any rehabilitation, suggesting a lack of proactive maintenance efforts. While still functional, its moderate vulnerability classification implies the need for improvements in structural capacity. The management of this infrastructure could benefit from scheduled assessments and minor retrofitting work. Enhancing maintenance routines will extend the building’s lifespan and reduce potential damage during seismic events.', '2025-05-12 15:11:17'),
(101, 32, 33, 3, 'The CavSci – Maliksi Building 5 is a two-storey building with two classrooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that was met is the corridor and hallway. CSIS-RSHS - Modified School Building 6', '2025-05-12 15:11:17'),
(102, 32, 34, 1, 'This building presents both vertical irregularity and severe structural defects, putting its current condition at risk and raising concerns about its seismic performance. Constructed in 2006 with no rehabilitation recorded, it shows signs of insufficient maintenance and oversight. Its classification as “safe” may not fully account for the building’s irregular form and aging materials. Maintenance strategies have been passive, and stronger infrastructure management policies are needed. Immediate structural assessment and targeted retrofitting should be prioritized to ensure safety and functionality.', '2025-05-12 15:11:17'),
(103, 32, 34, 3, 'The CavSci – Modified School Building 6 is a two-storey building with two classrooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that was met is the corridor and hallway. This is the oldest building in Cavsci, and doesn\'t have accessible ramps and signages. CSIS-RSHS - DepEd Standard School Building 7', '2025-05-12 15:11:17'),
(104, 32, 35, 1, 'This building built in 2015, shows some severe and localized defects, which is concerning for a relatively new structure. The presence of defects without any rehabilitation implies weaknesses in quality control or post-construction maintenance practices. With a regular configuration and stable soil, it has favorable seismic resistance characteristics. Nonetheless, its management needs to be more proactive, with regular monitoring and maintenance interventions. A structured maintenance plan and early repair of defects would preserve its long-term functionality and safety.', '2025-05-12 15:11:17'),
(105, 32, 35, 3, 'The CavSci – DepEd Standard School Building 7 is a four-storey building with two classrooms per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps. CSIS-RSHS - Science Laboratory Building 9', '2025-05-12 15:11:17'),
(106, 32, 36, 1, 'This building is in good condition with only minor structural and non-structural issues, and its regular form improves seismic performance. Constructed in 2018, its newer design and materials contribute to its resilience. However, no formal maintenance efforts have been noted, which may allow minor defects to develop over time. Its current management appears adequate but would benefit from institutionalized maintenance practices. Regular evaluations and minor interventions will help maintain its safety and performance during seismic events.', '2025-05-12 15:11:17'),
(107, 32, 36, 3, 'The CavSci – Science Laboratory Building 9 is a four-storey building with two classrooms per floor level. This school building got 50%, which means half of the accessibility requirements that were met—such as door and entrances, corridors and hallways, washroom and toilets, and accessible ramps. CSIS-RSHS - Beauty Care NC2 Building 10', '2025-05-12 15:11:17'),
(108, 32, 37, 1, 'This building suffers from vertical irregularity and several severe defects, making it vulnerable in the event of a strong earthquake. Built in 2013 with no rehabilitation work, it reflects inadequate maintenance and oversight. While still categorized as “safe,” the presence of these defects indicates structural concerns that need attention. Maintenance strategies must shift from reactive to preventive to improve the building’s condition and safety. Structural retrofitting and regular inspections should be part of its long-term management approach.', '2025-05-12 15:11:17'),
(109, 32, 37, 3, 'The CavSci -- Beauty Care NC2 School Building 10 is a two-storey building with one classroom per floor level. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. It doesn’t have accessible ramps, signages, and also washrooms and toilets. CSIS-RSHS - Science Laboratory Building 14', '2025-05-12 15:11:17'),
(110, 32, 38, 1, 'This two-storey structure, completed in 2005, has shown severe and localized defects despite having a regular layout that is typically advantageous during seismic events. The lack of rehabilitation and recorded maintenance efforts suggests the need for stronger management systems. Without intervention, these defects could compromise the structure\'s durability and earthquake resistance. Its current classification as “safe” may not reflect actual vulnerabilities due to age and wear. Immediate structural evaluation and maintenance implementation are recommended.', '2025-05-12 15:11:17'),
(111, 32, 38, 3, 'The CavSci – Science Laboratory Building 14 is a two-storey building with two Laboratory rooms per floor level. This school building got 12.5%, which means only one of the accessibility requirements that were met is the corridor and hallway only. This building does not have accessible ramps, signages, and washrooms and toilets. BUCAL 1 Multi-purpose Hall Bucal 1', '2025-05-12 15:11:17'),
(112, 14, 14, 1, 'The hall remains safe with minor structural issues, but signs of deterioration highlight the need for better maintenance practices. The current system seems to delay minor repairs, potentially leading to more significant damage over time. Adopting a condition-based maintenance system will support timely interventions. Training barangay personnel in basic inspection techniques can improve maintenance effectiveness. For data presentation, interactive dashboards can effectively summarize condition status and maintenance history.', '2025-05-12 15:11:17'),
(113, 14, 14, 3, 'The Barangay Hall of Bucal 1 is a small administrative building that serves as the central location for barangay government functions. This government building got 50%, which means it complies with half of the accessibility features–including doors and entrances, hallways and corridors, accessible ramps and parking. BUCAL 2 Barangay Hall Bucal 2', '2025-05-12 15:11:17'),
(114, 15, 15, 1, 'Although structurally sound, the hall displays minor wear that reflects a lack of systematic upkeep. Maintenance efforts are present but not optimized to prevent long-term degradation. Institutionalizing a maintenance management plan with performance indicators will enhance service delivery. Engaging local stakeholders through participatory planning can ensure accountability in infrastructure upkeep. Presenting this data using color-coded assessment grids can help prioritize interventions.', '2025-05-12 15:11:17'),
(115, 15, 15, 3, 'The Barangay Hall of Bucal 2 is a small administrative building that serves as the central location for barangay government functions. The barangay hall is located beside the road and Bucal 2 Elementary School.  This government building got 0%, which means this building failed to comply with the accessibility features set that was provided by the researchers. This barangay hall doesn’t have any parking, accessible ramps, or even enough spaces for hallways and corridors. Bucal National Integrated School BNIS - PagCor Building', '2025-05-12 15:11:17'),
(116, 15, 25, 1, 'Despite being relatively new, the building shows signs of severe and localized structural defects, hinting at possible construction or material quality issues. Its regular shape and location help reduce seismic vulnerability, but defects weaken its overall reliability. Maintenance practices should be improved to include early detection of issues. Immediate repair of identified damage is necessary to maintain safety and usability. Strengthening maintenance protocols and performing routine structural checks can extend the building’s service life.', '2025-05-12 15:11:17'),
(117, 15, 25, 3, 'The BNIS – PagCor Building is a two-storey building with two classrooms per floor level. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps. BNIS - SH Laboratory Building', '2025-05-12 15:11:17'),
(118, 15, 26, 1, 'The building, though recent and regularly shaped, has several severe and localized defects, which raise concerns for safety, especially during seismic events. Maintenance practices may not be sufficient given the condition despite the building’s age. Located on loam soil and away from major fault lines, the foundation is generally stable. Repairs to damaged areas should be prioritized, along with reinforcement of structural connections. A structured maintenance program and scheduled seismic assessments should be implemented moving forward.', '2025-05-12 15:11:17'),
(119, 15, 26, 3, 'The BNIS – Senior High Laboratory Building is a four-storey building with two classrooms per floor level used by the senior high school students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps. BNIS - ABM Building', '2025-05-12 15:11:17'),
(120, 15, 27, 1, 'Severe and localized structural issues are present, indicating potential weaknesses in construction or inadequate maintenance. While its regular configuration and location reduce some seismic risks, current damage levels suggest vulnerability during strong earthquakes. Maintenance appears insufficient and needs improvement. Structural rehabilitation and reinforcement of load-bearing components are recommended. Establishing routine inspections and improving facility management strategies will help preserve the building’s condition.', '2025-05-12 15:11:17'),
(121, 15, 27, 3, 'The BNIS – ABM Building is a two-storey building with two classrooms per floor level used by the Senior High School ABM Students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps. BNIS - SIGLA Building', '2025-05-12 15:11:17'),
(122, 15, 28, 1, 'Despite being one of the newest structures, the building has multiple severe defects, though most are minor in nature. Its regular layout and favorable location help mitigate seismic risks, but existing damage must be addressed. Maintenance effectiveness is questionable given the building\'s short lifespan. Targeted repairs and a review of construction quality should be conducted. Implementing a robust maintenance plan with scheduled evaluations will improve its resilience and functionality.', '2025-05-12 15:11:17'),
(123, 15, 28, 3, 'The BNIS – Sigla Building is a four-storey building with two classrooms per floor level used by the Junior High School Students. This school building got 37.5%, which means there are three accessibility requirements that were met—such as door and entrances, corridors and hallways, and accessible ramps. BNIS - Stockroom Building', '2025-05-12 15:11:17'),
(124, 15, 29, 1, 'This small-capacity building shows moderate vulnerability with severe and localized structural issues, suggesting neglect or poor initial construction. Its function as a stockroom still requires it to be safe, especially under seismic loads. Current maintenance efforts seem lacking and must be strengthened. Repairs should focus on structural stability and waterproofing to protect stored materials. Improved inspection routines and basic retrofitting will support safer and more sustainable use.', '2025-05-12 15:11:17'),
(125, 15, 29, 3, 'The BNIS – Stockroom Building is a two-storey building with one classroom per floor level used as storage rooms. This school building got 25%, which means there are two accessibility requirements that were met—such as doors and entrances, and corridors and hallways. BNIS - HUMSS Building', '2025-05-12 15:11:17'),
(126, 15, 30, 1, 'The building is mid-aged and has a regular structure, it shows signs of severe and localized structural deterioration. Given its academic use and three-story height, this poses a potential risk during seismic events. Maintenance strategies appear to fall short in addressing aging issues. Immediate structural reinforcement and inspection are necessary. Regular upkeep and long-term resilience planning will ensure continued safety and usability.', '2025-05-12 15:11:17'),
(127, 15, 30, 3, 'The BNIS – HUMSS Building is a four-storey building with two classrooms per floor level used by Senior High School HUMSS Students. This school building got 37.5%, which means there are three accessibility requirements that were met—including door and entrances, corridors and hallways, and accessible ramps. BNIS - Encantadia Building', '2025-05-12 15:11:17'),
(128, 15, 31, 1, 'This building shows signs of deterioration, including severe and localized structural defects, which compromises its current condition. Its vertical irregularity increases its susceptibility to seismic loads, especially since no rehabilitation has been performed since its construction in 2001. The absence of any major maintenance interventions indicates weak infrastructure management and reactive maintenance. Despite being categorized as “safe,” its structural irregularities and defects suggest that it may perform poorly during strong ground motion. Immediate assessment and retrofitting, along with a preventive maintenance plan, are necessary to improve its safety and sustainability.', '2025-05-12 15:11:17'),
(129, 15, 31, 3, 'The BNIS – Encantadia Building is a two-storey building with two classrooms per floor level. This school building got 12.5%, indicating that there is only one accessibility requirement that was met. There are no accessible ramps, only corridors and hallways are complied. BUCAL 3A Barangay Hall Bucal 3A', '2025-05-12 15:11:17'),
(130, 16, 16, 1, 'Barangay Hall Bucal 3A shows minimal structural and non-structural issues, confirming that the infrastructure is safe and serviceable. Despite the acceptable condition, maintenance efforts appear passive rather than proactive. It is suggested to establish a predictive maintenance strategy using periodic condition assessments. Digital tools like mobile-based inspection checklists can help improve reporting and management efficiency. A tabular format with photographic evidence would best illustrate findings for this building.', '2025-05-12 15:11:18'),
(131, 16, 16, 3, 'The Barangay Hall of Bucal 3A is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, indicating it complies with only one of the accessibility features, which is corridor and hallways. The barangay hall is located near the road. That\'s why it didn’t meet the standard of having parking and accessible ramps. BUCAL 3B Barangay Hall Bucal 3B', '2025-05-12 15:11:18'),
(132, 17, 17, 1, 'The building’s overall condition is acceptable, with minor defects pointing to age-related wear. Existing maintenance measures do not appear to sufficiently address early-stage issues. Strengthening infrastructure management through regular audits and scheduled upkeep is essential. Integrating local data into a central municipal system can enhance oversight and maintenance prioritization. Graph-based summaries and comparative scorecards will be ideal for reporting this hall’s condition.', '2025-05-12 15:11:18'),
(133, 17, 17, 3, 'The Barangay Hall of Bucal 3B is a small administrative building that serves as the central location for barangay government functions. This government building got 25%, indicating it complies with two of the accessibility features, which are doors and entrances, and corridor and hallways. The barangay hall didn’t meet the standard of having parking. BUCAL 4A Barangay Hall Bucal 4A', '2025-05-12 15:11:18'),
(134, 18, 18, 1, 'Barangay Hall Bucal 4A has a stable structure but shows early signs of minor deterioration. Current maintenance operations are limited in scope and frequency. Implementing structured maintenance protocols with defined inspection intervals would improve long-term performance. Allocating dedicated budget lines for regular maintenance will support infrastructure resilience. For clarity, audit results should be presented using condition-rating scales along with geolocation tagging.', '2025-05-12 15:11:18'),
(135, 18, 18, 3, 'The Barangay Hall of Bucal 4A is a small administrative building that serves as the central location for barangay government functions. This government building got 12.5%, indicating it complies with only one of the accessibility features, which is corridor and hallways. The barangay hall is located beside the court in Bucal 4A, that’s why it didn’t meet the standard of having accessible ramps and parking. BUCAL 4B Multi-purpose Hall Bucal 4B', '2025-05-12 15:11:18'),
(136, 19, 19, 1, 'This hall is in satisfactory condition, with minor defects suggesting the need for enhanced maintenance practices. While safe for use, the facility would benefit from more structured and continuous upkeep. Instituting a municipal maintenance management system could streamline operations and reduce long-term costs. Public infrastructure awareness campaigns may also help preserve the facility by encouraging responsible use. Heat maps displaying defect density can be effective for presenting this hall’s condition.', '2025-05-12 15:11:18'),
(137, 19, 19, 3, 'The Barangay Hall of Bucal 4a is a small administrative building that serves as the central location for barangay government functions. This government building got 25%, indicating it complies with two of the accessibility features, which is doors and entrances, and corridor and hallways. The barangay hall is located near the street road. That\'s why it doesn’t have parking and accessible ramps. PINAGSANHAN B Cavite State University - Maragondon Campus CvSU Marag - High School Building', '2025-05-12 15:11:18'),
(138, 39, 39, 1, 'The building is in good structural condition with only minor defects and a regular configuration that supports seismic load performance. Built in 2015, it stands on a combination of loam and clay soil and is located moderately close to coastal hazards. No rehabilitation or documented maintenance suggests a need for more formal infrastructure oversight. Its current functionality remains high, but long-term sustainability depends on proactive measures. A maintenance schedule and minor protective upgrades are advisable.', '2025-05-12 15:11:18'),
(139, 39, 39, 3, 'The CvSU Maragondon – High School is a two-storey building with four classrooms per floor level used by the Junior High School Students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. This school building doesn’t have accessible ramps and designated parking spaces in the campus. CvSU Marag - Elementary Building', '2025-05-12 15:11:18'),
(140, 39, 40, 1, 'This structure is generally in good condition with only minor defects, and its regular shape contributes positively to earthquake resistance. Located near a coastal area and constructed on loam and clay soil, it faces moderate environmental exposure. Though no major issues have been observed, the absence of any maintenance records could lead to long-term degradation. Infrastructure management should include regular inspections and minor repairs to maintain its structural health. Preventive strategies are necessary to uphold its safety and function over time.', '2025-05-12 15:11:18'),
(141, 39, 40, 3, 'The CvSU Maragondon – Elementary School is a two-storey building with four classrooms per floor level used by the Elementary Students. This school building got 25%, which means there are two accessibility requirements that were met—such as door and entrances, and corridors and hallways. This school building doesn’t have accessible ramps and designated parking spaces in the campus.', '2025-05-12 15:11:18'),
(142, 6, 20, 2, 'The building has an exit ladder on the second floor. The exit pathways are both free of obstructions and the doors swing in the way of egress but does not have a self-closing mechanism. All hazardous and flammable chemicals are stored properly, no storage area is under the staircase. There is no exit sign posted but a readable evacuation plan is posted. The building only has a fire alarm as its fire protection system.', '2025-05-15 03:20:07'),
(143, 6, 21, 2, 'The building has an exit ladder on the second floor. The exit pathways are both free of obstructions and the doors swing in the way of egress but does ot have a self-closing mechanism. All hazardous and flammable chemicals are stored properly, although there is a storage area under the staircase. Exit signs and an evacuation plan are posted properly but the size of the exit sign fails in compliance. The building only has a fire alarm as its fire protection system.', '2025-05-15 03:40:21'),
(144, 6, 22, 2, 'The building has an exit ladder on the second floor. The exit pathways are both free of obstructions and the doors swing in the way of egress but does ot have a self-closing mechanism. All hazardous and flammable chemicals are stored properly, although there is a storage area under the staircase. Exit signs and an evacuation plan are posted properly but the size of the exit sign fails in compliance. The building only has a fire alarm as its fire protection system.', '2025-05-15 03:40:21'),
(145, 6, 23, 2, 'The building has two staircases on each side of the structure. Under the stairs is occupied as storage of miscellaneous items. No exit signs and “no smoking” signs but evacuation plans are posted on each floor. Fire alarms and fire extinguishers are also stationed on each floor.', '2025-05-15 03:40:21'),
(146, 6, 24, 2, 'The building only has one staircase and is being occupied as an office. The pathway is too narrow. Lack of signs like exit signs and evacuation plans. Each floor has a fire alarm and fire extinguisher.', '2025-05-15 03:40:21'),
(147, 32, 32, 2, 'The building has two staircases on each side of the building with no items stored under it. Lacks of signs, but flammable items are properly stored. Each floor has fire alarms and fire extinguishers on each floor.', '2025-05-15 03:40:21'),
(148, 32, 33, 2, 'The building has two staircases inside of the building, but has items occupying under it. The hazardous items have proper storage. Exit signs and an evacuation plan are posted but no “no smoking” sign in sight. But the signs do not comply with the size standard of the text in the signs. There are fire extinguishers and fire alarms on each floor.', '2025-05-15 03:40:21'),
(149, 32, 34, 2, 'The building has two staircases inside of the building, but has items occupying under it. The hazardous items have proper storage. Exit signs and an evacuation plan are posted but no “no smoking” sign in sight. There are fire extinguishers and fire alarms on each floor.', '2025-05-15 03:40:21'),
(150, 32, 35, 2, 'The building has two staircases inside of the building, with no items occupying under it. The hazardous items have proper storage. Exit signs are posted, no evacuation plan nor “no smoking” sign in sight. There are fire extinguishers and fire alarms on each floor.', '2025-05-15 03:40:21'),
(151, 32, 36, 2, 'Building has two staircases, one is inside the building, one is outside and is accessible to all the floors. Although the staircase is used for storage for a few miscellaneous items, hazardous items are properly stored. There are exit signs posted but no evacuation plan or no smoking sign. The building has sprinklers, fire hose, fire alarm, and fire extinguisher.', '2025-05-15 03:40:21'),
(152, 32, 37, 2, 'Only has one staircase and under it is used for storage of miscellaneous items. Doors do not close properly but swing on the way of the egress. No signs are posted. There is a fire alarm system and a fire extinguisher on the first floor.', '2025-05-15 03:40:21'),
(153, 32, 38, 2, 'The building has two staircases on each side of the structure, but only one is being used as the other one has miscellaneous items like a stack of papers stored on the stairs. No exit sign is posted and the evacuation plan is not up to standard. The building has a fire alarm system and a fire extinguisher on each floor.', '2025-05-15 03:40:21');
INSERT INTO `building_checklist_description` (`id`, `barangay_id`, `building_id`, `audit_type_id`, `summary`, `created_at`) VALUES
(154, 14, 14, 2, 'The building has one exit pathway. It is free of obstruction, doors are opening and closing properly and swing on the way of the egress. Items that are classified as hazardous and flammable are not properly stored. The fire extinguisher is in good condition but is not in a proper location and the emergency lights failed in compliance.', '2025-05-15 03:40:21'),
(155, 15, 15, 2, 'The building has one narrow exit pathway, but it is kept clean and free from obstructions. Lacks signages. Flammable items like paint and gasoline are stored in a separate building. There is a fire extinguisher properly located in an area that is easily accessible but it is in need of being renewed.', '2025-05-15 03:40:21'),
(156, 15, 25, 2, 'The building only has one staircase as part of its exit pathway. The pathways are free from obstructions. Hazardous and flammable items are properly stored. The building lacks signages like exit signs and an evacuation plan. The building only has a fire extinguisher on each floor and a working fire alarm system.', '2025-05-15 03:40:21'),
(157, 15, 26, 2, 'The building has two staircases, one inside the building and an outside staircase as its secondary exit path. The exit stairs are accessible on all floors. All exit paths are free from obstructions  and the doors are in good condition. All combustible items are stored properly. The building has a working sprinkler, fire hose, fire detection and alarm system, emergency lights and a new fire extinguisher.', '2025-05-15 03:40:21'),
(158, 15, 27, 2, 'The building only has one exit as the stairs that can be seen on the exterior part of the building is the way to access the water tank of the building. It is free from obstructions and the doors are in good condition that swings in the way of the egress and has a self-closing mechanism. Lacks signages like exit signs, no smoking signs and an evacuation plan. The building has a working fire alarm and fire extinguishers in good condition on each floor.', '2025-05-15 03:40:21'),
(159, 15, 28, 2, 'The building has two staircases. It is free from obstructions and the doors are in good condition that swings in the way of the egress and has a self-closing mechanism. Lacks signages like exit signs, no smoking signs and an evacuation plan. The building has a working fire alarm and fire extinguishers in good condition on each floor.', '2025-05-15 03:40:21'),
(160, 15, 29, 2, 'The building has one exit staircase. Each floor only has one room, and the first floor is used for storage for miscellaneous items. The doors are in good condition and swing in the way of the egress. Lacks signages like exit signs, no smoking sign, and an evacuation plan. The building only has a fire extinguisher that is in good condition and is located properly.', '2025-05-15 03:40:21'),
(161, 15, 30, 2, 'The building only has one exit. It is free from obstructions and the doors are in good condition that swings in the way of the egress and has a self-closing mechanism. Lacks signages like exit signs, no smoking signs and an evacuation plan. The building has a working fire alarm and fire extinguishers in good condition on each floor.', '2025-05-15 03:40:21'),
(162, 15, 31, 2, 'The building only has one exit staircase. It is free from obstructions and the doors are in good condition with a self-closing mechanism. Hazardous and flammable materials are properly stored. The building lacks proper signages. It only has fire extinguishers on each floor as its fire protection system.', '2025-05-15 03:40:21'),
(163, 16, 16, 2, 'The building only has one exit. It is free from obstructions and the doors are in good condition with a self-closing mechanism. Hazardous and combustible items have proper designated storages. No exit signs nor evacuation plan is posted. The building has fire extinguishers but is not placed in a more accessible area, and a working emergency light.', '2025-05-15 03:40:21'),
(164, 17, 17, 2, 'The building only has one exit. It is free from obstructions and the doors are in good condition with a self-closing mechanism. Hazardous and combustible items have proper designated storages. No exit signs nor evacuation plan is posted. The building has fire extinguishers but is in need of being renewed.', '2025-05-15 03:40:21'),
(165, 18, 18, 2, 'The building only has one exit. It is free from obstructions and the doors are in good condition with a self-closing mechanism. Hazardous and combustible items have proper designated storages. No exit signs nor evacuation plan is posted. The building has fire extinguishers but is in need of being renewed, and a working emergency light.', '2025-05-15 03:40:21'),
(166, 19, 19, 2, 'The building only has one exit. It is free from obstructions and the doors are in good condition with a self-closing mechanism. Hazardous and combustible items have proper designated storages but the staircase is still used as storage for other items. No exit signs nor evacuation plan is posted. The building has fire extinguishers but is in need of being renewed.', '2025-05-15 03:40:21'),
(167, 39, 39, 2, 'The building has two staircases on each side of the building. The exit path is free from obstructions, doors are in good condition and swings in the way of egress. Items are stored under the staircases. Signages like exit signs and an evacuation plan are posted and readable. The building has a fire extinguisher that is easily accessible and a working emergency light.', '2025-05-15 03:40:21'),
(168, 39, 40, 2, 'The building has two staircases on each side of the building. The exit path is free from obstructions, doors are in good condition and swings in the way of egress. Items are stored under the staircases. Signages like exit signs and an evacuation plan are posted and readable. The building has a fire extinguisher that is easily accessible and a working emergency light.', '2025-05-15 03:40:21'),
(169, 6, 13, 1, 'The building\'s condition is stable with no structural concerns and only minor surface defects, reflecting effective baseline maintenance. However, current management practices lack preventive strategies that anticipate long-term wear. It is recommended to adopt a life-cycle approach to infrastructure maintenance to ensure continued functionality. Community-based monitoring can support early identification of defects and reduce response times. A combination of bar charts and condition maps can present the audit results clearly and accessibly.', '2025-05-15 03:41:08'),
(170, 6, 13, 2, 'The building only has doors and passageways on its exit access. It is kept in good condition, with the doors open and close properly and swings in the way of the egress. There is also no obstruction in the egress as all the items that can be classified as flammable, hazardous and miscellaneous are kept in the right storage space. It has a working fire alarm system and a fire extinguisher that is still in good condition, but it is kept in a place not in compliance to standard.', '2025-05-15 03:41:08'),
(171, 6, 13, 3, 'The Multipurpose Hall of Garita A serves as community hubs for various activities, including meetings, events, and social gatherings. This government building got 25%, which means it satisfies twoo accessibility features–including doors and entrances, and hallways and corridors. This building doesn’t have a parking space.', '2025-05-15 03:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `building_media`
--

CREATE TABLE `building_media` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `media_type` enum('photo','document') NOT NULL,
  `category` enum('main_photo','documentation','other') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building_media`
--

INSERT INTO `building_media` (`id`, `building_id`, `file_path`, `media_type`, `category`, `description`, `created_at`) VALUES
(12, 7, 'assets/photo-docs/Garita A/Maragondon Police Station/Copy of 07_07.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(13, 7, 'assets/photo-docs/Garita A/Maragondon Police Station/Untitled Project_25-05-10_18-25-46-057.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(21, 2, 'assets/photo-docs/Poblacion 1A/DILG Building/Copy of Copy of 02_03.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(22, 2, 'assets/photo-docs/Poblacion 1A/DILG Building/BBD5F16A-8A18-4395-BC6A-C245EC5D4EDC.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(23, 2, 'assets/photo-docs/Poblacion 1A/DILG Building/CA8F2B54-CC45-48B2-94DC-AB40FBB8DEC5.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(24, 1, 'assets/photo-docs/Poblacion 1A/Municipal Hall/Copy of 02_03.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(25, 1, 'assets/photo-docs/Poblacion 1A/Municipal Hall/3319645C-0DA2-480B-A697-96030949B89F.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(26, 1, 'assets/photo-docs/Poblacion 1A/Municipal Hall/3E83F81C-3AC3-4CAF-885A-940B931840F4.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(27, 1, 'assets/photo-docs/Poblacion 1A/Municipal Hall/7554E415-8723-483C-B480-374A52C64585.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(28, 1, 'assets/photo-docs/Poblacion 1A/Municipal Hall/93E75CE4-1B88-4B59-BAE6-44E024914AB2.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(29, 1, 'assets/photo-docs/Poblacion 1A/Municipal Hall/C47BD47F-4EC8-48E7-A4AF-C45059D8F8B9.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(36, 5, 'assets/photo-docs/Poblacion 2B/MDRRMO/1746895730307.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:39'),
(37, 5, 'assets/photo-docs/Poblacion 2B/MDRRMO/1746895730314.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:39'),
(38, 5, 'assets/photo-docs/Poblacion 2B/MDRRMO/1746895730321.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:39'),
(39, 5, 'assets/photo-docs/Poblacion 2B/MDRRMO/1746899629925.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:39'),
(40, 5, 'assets/photo-docs/Poblacion 2B/MDRRMO/1746899629929.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:39'),
(41, 5, 'assets/photo-docs/Poblacion 2B/MDRRMO/1746899629934.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:39'),
(48, 4, 'assets/photo-docs/Poblacion 1A/MTO/28_02.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:47:01'),
(49, 4, 'assets/photo-docs/Poblacion 1A/MTO/6616A5D9-AA5E-42B2-A6F8-06C1382757DD.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:47:01'),
(50, 4, 'assets/photo-docs/Poblacion 1A/MTO/90F2C4F9-7159-4E70-B654-63D5E5BDD465.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:47:01'),
(51, 4, 'assets/photo-docs/Poblacion 1A/MTO/B445A7AE-5C19-47CF-A28F-9B90D1F0D1D9.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:47:01'),
(52, 16, 'assets/photo-docs/Bucal 3A/Barangay Hall Bucal 3A/0660DD9C-A2C6-46C4-90AA-669F1A02E73B.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(53, 16, 'assets/photo-docs/Bucal 3A/Barangay Hall Bucal 3A/1743896953138.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(54, 16, 'assets/photo-docs/Bucal 3A/Barangay Hall Bucal 3A/1743896953165.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(55, 16, 'assets/photo-docs/Bucal 3A/Barangay Hall Bucal 3A/1743896953171.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(56, 16, 'assets/photo-docs/Bucal 3A/Barangay Hall Bucal 3A/6D51525E-D7CE-4402-A4BB-C620E4045AA0.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(57, 17, 'assets/photo-docs/Bucal 3B/Barangay hall Bucal 3B/Copy of 1746978779959.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(58, 17, 'assets/photo-docs/Bucal 3B/Barangay hall Bucal 3B/Copy of 1746978779965.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(59, 17, 'assets/photo-docs/Bucal 3B/Barangay hall Bucal 3B/1743896911922.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(60, 17, 'assets/photo-docs/Bucal 3B/Barangay hall Bucal 3B/1743896911946.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(61, 17, 'assets/photo-docs/Bucal 3B/Barangay hall Bucal 3B/4A7F8919-5490-4C50-A00C-931F95984BFB.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(62, 17, 'assets/photo-docs/Bucal 3B/Barangay hall Bucal 3B/A68A4D84-8264-459C-B2CE-BB0A6B88E307.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(63, 18, 'assets/photo-docs/Bucal 4A/Barangay Hall Bucal 4A/1743900684800.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(64, 18, 'assets/photo-docs/Bucal 4A/Barangay Hall Bucal 4A/1743900684813.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(65, 18, 'assets/photo-docs/Bucal 4A/Barangay Hall Bucal 4A/1743900684840.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(66, 18, 'assets/photo-docs/Bucal 4A/Barangay Hall Bucal 4A/919D5C04-BF31-4DB8-8276-6EE106D94B5C.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(67, 13, 'assets/photo-docs/Garita A/Barangay Hall Garita A/Untitled Project_25-05-10_18-26-42-488.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(68, 13, 'assets/photo-docs/Garita A/Barangay Hall Garita A/Untitled Project_25-05-10_18-26-38-636.png', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(69, 6, 'assets/photo-docs/Garita A/Municipal Curcuit Trial Court/Copy of 06_03.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(70, 6, 'assets/photo-docs/Garita A/Municipal Curcuit Trial Court/Copy of 06_08.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(71, 6, 'assets/photo-docs/Garita A/Municipal Curcuit Trial Court/Copy of 06_09.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(72, 6, 'assets/photo-docs/Garita A/Municipal Curcuit Trial Court/Untitled Project_25-05-10_18-26-01-114.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(73, 6, 'assets/photo-docs/Garita A/Municipal Curcuit Trial Court/Untitled Project_25-05-10_18-26-05-970.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(74, 6, 'assets/photo-docs/Garita A/Municipal Curcuit Trial Court/Untitled Project_25-05-10_18-26-12-882.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(75, 10, 'assets/photo-docs/Poblacion 2B/Barangay Hall Poblacion 2B/1746895766654.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(76, 10, 'assets/photo-docs/Poblacion 2B/Barangay Hall Poblacion 2B/1746895766666.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(77, 10, 'assets/photo-docs/Poblacion 2B/Barangay Hall Poblacion 2B/1746895766675.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(78, 10, 'assets/photo-docs/Poblacion 2B/Barangay Hall Poblacion 2B/Copy of 12_04.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(79, 10, 'assets/photo-docs/Poblacion 2B/Barangay Hall Poblacion 2B/Copy of 12_05.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(80, 10, 'assets/photo-docs/Poblacion 2B/Barangay Hall Poblacion 2B/Copy of 12_06.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:17:04'),
(81, 14, 'assets/photo-docs/Bucal 1/Barangay Hall Bucal 1/12DA9CCF-7661-4AAD-8CA0-E5E9774ADD93.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(82, 14, 'assets/photo-docs/Bucal 1/Barangay Hall Bucal 1/1743900769465.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(83, 14, 'assets/photo-docs/Bucal 1/Barangay Hall Bucal 1/70C8D5C7-2FC5-4177-B171-8903A0954DCF.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(84, 14, 'assets/photo-docs/Bucal 1/Barangay Hall Bucal 1/7E513E55-0D53-45B8-9EB8-FEA915E5425E.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(85, 15, 'assets/photo-docs/Bucal 2/Barangay Hall Bucal 2/05CD9819-FB76-4425-8857-46FD3FC79C9A.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(86, 15, 'assets/photo-docs/Bucal 2/Barangay Hall Bucal 2/1743896844510.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(87, 15, 'assets/photo-docs/Bucal 2/Barangay Hall Bucal 2/1DBFCFA6-3089-4771-AA7D-79F32C5FF46B.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(88, 15, 'assets/photo-docs/Bucal 2/Barangay Hall Bucal 2/421AC9CB-52B7-458E-B771-8620C207284B.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(89, 15, 'assets/photo-docs/Bucal 2/Barangay Hall Bucal 2/43D5D558-F84F-4BF7-84E7-BAE79AD88513.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(90, 19, 'assets/photo-docs/Bucal 4B/Barangay Hall Bucal 4B/1743900741953.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(91, 19, 'assets/photo-docs/Bucal 4B/Barangay Hall Bucal 4B/1743900741993.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(92, 19, 'assets/photo-docs/Bucal 4B/Barangay Hall Bucal 4B/45AA7481-7DC8-4F69-9FB7-F8485C0683B6.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(93, 19, 'assets/photo-docs/Bucal 4B/Barangay Hall Bucal 4B/781E209F-74B8-4C4B-BCA2-CBFDFF926F85.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(94, 19, 'assets/photo-docs/Bucal 4B/Barangay Hall Bucal 4B/DAC5390D-72DD-4DD4-95EE-B77E4F26A126.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(95, 8, 'assets/photo-docs/Poblacion 1A/Barangay Hall Poblacion 1A/Untitled Project_25-05-10_18-26-29-752.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(96, 8, 'assets/photo-docs/Poblacion 1A/Barangay Hall Poblacion 1A/Untitled Project_25-05-10_18-26-33-935.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(97, 8, 'assets/photo-docs/Poblacion 1A/Barangay Hall Poblacion 1A/Untitled Project_25-05-10_18-33-15-133.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(98, 9, 'assets/photo-docs/Poblacion 1B/Barangay Hall/1743903846174.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(99, 9, 'assets/photo-docs/Poblacion 1B/Barangay Hall/1743903846187.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(100, 9, 'assets/photo-docs/Poblacion 1B/Barangay Hall/3D94A3C8-94E2-4A65-8859-0875F37C8A28.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(101, 9, 'assets/photo-docs/Poblacion 1B/Barangay Hall/6295ECB3-DEE1-4C0A-8C57-0CD5A1EC8CA3.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(102, 9, 'assets/photo-docs/Poblacion 1B/Barangay Hall/B1C05861-40F1-46EE-86E4-83A9F1F9B184.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(103, 11, 'assets/photo-docs/Poblacion 3 (Caingin)/Barangay Hall Caingin/Copy of 1743903987981.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(104, 11, 'assets/photo-docs/Poblacion 3 (Caingin)/Barangay Hall Caingin/Copy of 1743903988025.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(105, 11, 'assets/photo-docs/Poblacion 3 (Caingin)/Barangay Hall Caingin/Copy of 1743903988034.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(106, 11, 'assets/photo-docs/Poblacion 3 (Caingin)/Barangay Hall Caingin/Copy of 1743903988049.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(107, 12, 'assets/photo-docs/Poblacion 3 (Caingin)/Multi-purpose Hall Caingin/Copy of 1743915455653.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(108, 12, 'assets/photo-docs/Poblacion 3 (Caingin)/Multi-purpose Hall Caingin/Copy of 1743915455664.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(109, 12, 'assets/photo-docs/Poblacion 3 (Caingin)/Multi-purpose Hall Caingin/Copy of 1743915455688.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(110, 12, 'assets/photo-docs/Poblacion 3 (Caingin)/Multi-purpose Hall Caingin/Copy of 1743915455703.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:18:58'),
(111, 14, 'assets/photo-docs/Bucal 1/Barangay Hall Bucal 1/IMG_0006.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(112, 14, 'assets/photo-docs/Bucal 1/Barangay Hall Bucal 1/IMG_0007.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(113, 15, 'assets/photo-docs/Bucal 2/Barangay Hall Bucal 2/IMG_0008.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(114, 17, 'assets/photo-docs/Bucal 3B/Barangay hall Bucal 3B/IMG_0020.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(115, 18, 'assets/photo-docs/Bucal 4A/Barangay Hall Bucal 4A/IMG_0021.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(116, 18, 'assets/photo-docs/Bucal 4A/Barangay Hall Bucal 4A/IMG_0022.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(117, 18, 'assets/photo-docs/Bucal 4A/Barangay Hall Bucal 4A/IMG_0023.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(118, 19, 'assets/photo-docs/Bucal 4B/Barangay Hall Bucal 4B/IMG_0024.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(119, 7, 'assets/photo-docs/Garita A/Maragondon Police Station/IMG_0032.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(120, 7, 'assets/photo-docs/Garita A/Maragondon Police Station/IMG_0033.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(121, 6, 'assets/photo-docs/Garita A/Municipal Curcuit Trial Court/IMG_0034.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(122, 8, 'assets/photo-docs/Poblacion 1A/Barangay Hall Poblacion 1A/IMG_0041.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(123, 2, 'assets/photo-docs/Poblacion 1A/DILG Building/IMG_0043.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(124, 3, 'assets/photo-docs/Poblacion 1A/Mayor\'s Office/14CB4FC9-34C2-48D9-A1A5-F652F0D53CF3.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(125, 3, 'assets/photo-docs/Poblacion 1A/Mayor\'s Office/24CA40A7-1FAF-48A0-B840-95F1AEFF4F40.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(126, 3, 'assets/photo-docs/Poblacion 1A/Mayor\'s Office/4B7274DC-7BF8-455C-ADDF-5CF65FFB4D5C.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(127, 3, 'assets/photo-docs/Poblacion 1A/Mayor\'s Office/6F7F43D5-22A8-4941-A6C4-6191188D874C.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(128, 1, 'assets/photo-docs/Poblacion 1A/Municipal Hall/IMG_0044.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(129, 11, 'assets/photo-docs/Poblacion 3 (Caingin)/Barangay Hall Caingin/IMG_0046.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 06:28:24'),
(130, 14, 'assets/photo-docs/!main-pictures-buildings/BUCAL 1/Multi-purpose Hall Bucal 1.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(131, 15, 'assets/photo-docs/!main-pictures-buildings/BUCAL 2/BH BUCAL 2.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(132, 27, 'assets/photo-docs/!main-pictures-buildings/BUCAL 2/BNIS - ABM Bldg.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(133, 30, 'assets/photo-docs/!main-pictures-buildings/BUCAL 2/BNIS - HUMSS Bldg.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(134, 26, 'assets/photo-docs/!main-pictures-buildings/BUCAL 2/BNIS - SH Lab.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(135, 28, 'assets/photo-docs/!main-pictures-buildings/BUCAL 2/BNIS - Sigla Bldg.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(136, 31, 'assets/photo-docs/!main-pictures-buildings/BUCAL 2/BNIS-Encantadia.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(137, 16, 'assets/photo-docs/!main-pictures-buildings/BUCAL 3A/Brgy Hall Bucal 3A.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(138, 18, 'assets/photo-docs/!main-pictures-buildings/BUCAL 4A/BH Bucal 4A.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(139, 19, 'assets/photo-docs/!main-pictures-buildings/BUCAL 4B/BH Bucal 4B.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(140, 21, 'assets/photo-docs/!main-pictures-buildings/GARITA A/MES Bldg 2.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(141, 6, 'assets/photo-docs/!main-pictures-buildings/GARITA A/Municipal Trial Court.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(142, 20, 'assets/photo-docs/!main-pictures-buildings/GARITA A/MES - Bldg 1.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(143, 22, 'assets/photo-docs/!main-pictures-buildings/GARITA A/MES - Bldg 3.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(144, 23, 'assets/photo-docs/!main-pictures-buildings/GARITA A/MHS - Bldg 1.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(145, 24, 'assets/photo-docs/!main-pictures-buildings/GARITA A/MHS - Bldg 2.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(146, 7, 'assets/photo-docs/!main-pictures-buildings/GARITA A/Police Station.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(147, 37, 'assets/photo-docs/!main-pictures-buildings/GARITA B/CSIS-RSHS Beautycare NC2 Bldg 10.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(148, 33, 'assets/photo-docs/!main-pictures-buildings/GARITA B/CSIS-RSHS Maliksi Bldg 5.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(149, 34, 'assets/photo-docs/!main-pictures-buildings/GARITA B/CSIS-RSHS Modifired School Bldg 6.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(150, 36, 'assets/photo-docs/!main-pictures-buildings/GARITA B/CSIS-RSHS Science Laboratory Bldg 9.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(151, 35, 'assets/photo-docs/!main-pictures-buildings/GARITA B/CSIS-RSHS Standard School Bldg 7.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(152, 38, 'assets/photo-docs/!main-pictures-buildings/GARITA B/CSIS - Bldg 14.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(153, 32, 'assets/photo-docs/!main-pictures-buildings/GARITA B/CSIS - Standard School Building - Bldg 4.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(154, 40, 'assets/photo-docs/!main-pictures-buildings/PINAGSANHAN B/CvSU Marag - ES Bldg.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(155, 39, 'assets/photo-docs/!main-pictures-buildings/PINAGSANHAN B/CvSU Marag - HS Bldg.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(156, 2, 'assets/photo-docs/!main-pictures-buildings/POBLACION 1A/DILG Bldg.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(157, 4, 'assets/photo-docs/!main-pictures-buildings/POBLACION 1A/MTO & MENRO.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(158, 8, 'assets/photo-docs/!main-pictures-buildings/POBLACION 1A/Multi-Purpose Hall Poblacion 1A.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(159, 1, 'assets/photo-docs/!main-pictures-buildings/POBLACION 1A/Municipa Hall.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(160, 9, 'assets/photo-docs/!main-pictures-buildings/POBLACION 1B/BH Poblacion 1B.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(161, 10, 'assets/photo-docs/!main-pictures-buildings/POBLACION 2B/BH Poblacion 2B.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:45:54'),
(162, 3, 'assets/photo-docs/!main-pictures-buildings/POBLACION 1A/Mayors Office.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 06:50:39'),
(163, 1, 'assets/photo-docs/!main-pictures-buildings/0-MAIN-PHOTO.jpg', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 07:02:06'),
(203, 25, 'assets/photo-docs/!main-pictures-buildings/BUCAL 2/BNIS - PagCor.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 07:02:06'),
(204, 29, 'assets/photo-docs/!main-pictures-buildings/BUCAL 2/BNIS - Stockroom.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 07:02:06'),
(205, 17, 'assets/photo-docs/!main-pictures-buildings/BUCAL 3B/BH Bucal 3.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 07:02:06'),
(206, 5, 'assets/photo-docs/!main-pictures-buildings/POBLACION 2B/MDRRMO.PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 07:02:06'),
(207, 11, 'assets/photo-docs/!main-pictures-buildings/POBLACION 3 (CAINGIN)/BH Poblacion 3 (Caingin).PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 07:02:06'),
(208, 12, 'assets/photo-docs/!main-pictures-buildings/POBLACION 3 (CAINGIN)/Multi-Purpose Hall Poblacion 3 (Caingin).PNG', 'photo', 'main_photo', 'Main photo of the building', '2025-05-12 07:02:06'),
(209, 27, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/ABM Building/1746893263244.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(210, 27, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/ABM Building/1746893263254.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(211, 27, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/ABM Building/Copy of 1743896607425.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(212, 27, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/ABM Building/Copy of 1743896607431.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(213, 27, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/ABM Building/IMG_0009.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(214, 27, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/ABM Building/IMG_0010.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(215, 31, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Encantadia Building/1746893297018.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(216, 31, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Encantadia Building/1746893297025.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(217, 31, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Encantadia Building/1746893297030.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(218, 31, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Encantadia Building/1746893297035.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(219, 31, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Encantadia Building/Copy of 1743896786402.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(220, 31, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Encantadia Building/Copy of 1743896786408.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(221, 31, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Encantadia Building/IMG_0011.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(222, 28, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SIGLA Building/1746895645152.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(223, 28, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SIGLA Building/1746895645158.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(224, 28, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SIGLA Building/1746895645164.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(225, 28, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SIGLA Building/Copy of 1743896659602.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(226, 28, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SIGLA Building/Copy of 1743896659638.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(227, 28, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SIGLA Building/Copy of 1743896659645.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(228, 28, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SIGLA Building/IMG_0017.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(229, 20, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 1/Copy of 08_01.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(230, 20, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 1/Copy of 08_03.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(231, 20, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 1/IMG_0025.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(232, 20, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 1/IMG_0026.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(233, 20, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 1/Untitled Project_25-05-10_18-25-22-721.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(234, 20, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 1/Untitled Project_25-05-10_18-25-40-812.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(235, 21, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 2/1746895801050.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(236, 21, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 2/1746895801063.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(237, 21, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 2/1746895801071.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(238, 21, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 2/Copy of 09_01.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(239, 21, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 2/Copy of 09_05.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(240, 21, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 2/Copy of 09_06.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(241, 21, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 2/IMG_0027.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(242, 22, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 3/1746895834765.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(243, 22, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 3/1746895834776.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(244, 22, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 3/1746895834785.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(245, 22, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 3/Copy of 10_03.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(246, 22, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 3/Copy of 10_07.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:55:59'),
(247, 22, 'assets/photo-docs/Garita A/Maragondon Elementary School/Building 3/IMG_0028.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(248, 23, 'assets/photo-docs/Garita A/Maragondon High School/Building 1/13_06.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(249, 23, 'assets/photo-docs/Garita A/Maragondon High School/Building 1/13_09.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(250, 23, 'assets/photo-docs/Garita A/Maragondon High School/Building 1/15A07520-D7F7-4EE1-AD41-4A2F8B650DF1.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(251, 23, 'assets/photo-docs/Garita A/Maragondon High School/Building 1/4AB21102-F2DC-427E-8944-611EE4D70092.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(252, 23, 'assets/photo-docs/Garita A/Maragondon High School/Building 1/IMG_0029.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(253, 23, 'assets/photo-docs/Garita A/Maragondon High School/Building 1/IMG_0030.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(254, 24, 'assets/photo-docs/Garita A/Maragondon High School/Building 2/14_06.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(255, 24, 'assets/photo-docs/Garita A/Maragondon High School/Building 2/14_07.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(256, 24, 'assets/photo-docs/Garita A/Maragondon High School/Building 2/9206E829-B013-4BF1-9310-F023A59FDE74.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(257, 24, 'assets/photo-docs/Garita A/Maragondon High School/Building 2/CBEE7252-38EE-4E68-8ABA-81CAF6BDDE9F.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(258, 24, 'assets/photo-docs/Garita A/Maragondon High School/Building 2/Copy of Copy of 14_05.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(259, 24, 'assets/photo-docs/Garita A/Maragondon High School/Building 2/D44D958C-A6B1-48CB-96F4-1E15C8836DAE.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(260, 24, 'assets/photo-docs/Garita A/Maragondon High School/Building 2/ED663DC7-1B5B-46BE-BD0A-8054DE02ECFA.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(261, 24, 'assets/photo-docs/Garita A/Maragondon High School/Building 2/IMG_0031.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 11:56:00'),
(262, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/1746894163070.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(263, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/1746894163076.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(264, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/1746894163082.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(265, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/1746894163088.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(266, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/1746894163093.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(267, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/Copy of 1743855866581.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(268, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/Copy of 1743855866634.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(269, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/Copy of 1746978779935.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(270, 26, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/SH Laboratory Building/IMG_0016.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(271, 37, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 10 - Beauty Care NC2/1743920043071.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(272, 37, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 10 - Beauty Care NC2/44892A73-9B3A-46B1-B3E4-678FC97CAFE7.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(273, 37, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 10 - Beauty Care NC2/5EBF2099-EF95-410C-9687-06147ED4AE2C.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(274, 37, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 10 - Beauty Care NC2/8CA1158D-5BD5-452A-B7A5-EAF6E1D2F909.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(275, 37, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 10 - Beauty Care NC2/BE7A1542-3C66-4ED9-9B4C-F7CD5BC6E937.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(276, 37, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 10 - Beauty Care NC2/Copy of 1746978779906.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(277, 37, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 10 - Beauty Care NC2/Copy of Copy of 1743920043079.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(278, 37, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 10 - Beauty Care NC2/IMG_0073.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(279, 38, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 14 - Science Laboratory/19B8F03D-7871-453D-8FC6-8153DE52443B.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(280, 38, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 14 - Science Laboratory/5BC1F5F9-C08C-47F8-93AE-EEB4AB386C08.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(281, 38, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 14 - Science Laboratory/82A62AE8-6010-4769-90F0-38060B4845F0.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(282, 38, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 14 - Science Laboratory/Copy of 1746978779901.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(283, 38, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 14 - Science Laboratory/Copy of Copy of 1743920186849.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(284, 38, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 14 - Science Laboratory/Copy of Copy of 1743920186870.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(285, 38, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 14 - Science Laboratory/Copy of items that are occupying majority of the space on the staircase.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(286, 38, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 14 - Science Laboratory/IMG_0052.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(287, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/0227F533-5FC8-44B9-BFC3-B9D00A8B9714.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(288, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/379F8A12-20EE-445F-BAB4-9EBA94822F89.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(289, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/83C7C5B2-03DD-43C4-A8F8-E6AB76D25791.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(290, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/B18BA85F-D07F-4831-8F08-161977D49482.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(291, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/Copy of Copy of 1743918938379.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(292, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/Copy of Copy of 1743918938426.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(293, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/Copy of Copy of 1743918938435.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(294, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/IMG_0065.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(295, 32, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 4 - DepEd Standard Building/IMG_0066.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(296, 33, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 5 - MALIKSI BLDG/1743919425668.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(297, 33, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 5 - MALIKSI BLDG/2BDDB44A-3338-4950-A33F-CC9C3CECAC5D.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(299, 33, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 5 - MALIKSI BLDG/68100E97-FD12-4F35-8D69-4E120F2FF780.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(300, 33, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 5 - MALIKSI BLDG/723ECF99-3D5E-4EF6-8F04-E92A1328C2CF.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(301, 33, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 5 - MALIKSI BLDG/Copy of 1746978779923.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(302, 33, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 5 - MALIKSI BLDG/Copy of Copy of 1743919425602.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(303, 33, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 5 - MALIKSI BLDG/Copy of Copy of 1743919425644.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(304, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/1743919012680.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(305, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/1E59AC37-67E9-47AC-92F1-F985309AFB1E.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(306, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/5642CF70-8DDC-4F76-A042-1E5629ADEB1B.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(307, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/5E3B7A1C-35B3-4785-8F3C-400EE8AE0EAF.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(308, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/7D906230-2802-4233-AD0E-C7E2FC78E761.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(309, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/B6812798-C548-4D07-8B93-2D228975B470.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(310, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/CFE7307C-6474-44F8-BF03-663443227A8D.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(311, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/Copy of Copy of 1743919012623.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(312, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/Copy of Copy of 1743919012632.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(313, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/Copy of Copy of 1743919012663.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(314, 34, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 6 - DepEd Modified Scool/IMG_0069.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(315, 35, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 7 - DepEd Standard School/13A80C76-1BAB-4C65-9498-00EDD73953BC.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(316, 35, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 7 - DepEd Standard School/Copy of 1746978779918.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(317, 35, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 7 - DepEd Standard School/Copy of Copy of 1743919220858.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(318, 35, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 7 - DepEd Standard School/Copy of Copy of 1743919220870.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(319, 35, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 7 - DepEd Standard School/Copy of Copy of 1743919220886.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(320, 35, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 7 - DepEd Standard School/F073D745-C184-4F7D-8D8E-A3191C3B032B.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(321, 35, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 7 - DepEd Standard School/F097C310-4F7E-4FC1-8090-E4D3F1DAF745.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(322, 35, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 7 - DepEd Standard School/IMG_0071.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(323, 36, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 9 - Science Laboratory/1743919962507.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(324, 36, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 9 - Science Laboratory/4CF22904-4FD2-427C-9C95-EDE1E15992E8.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(325, 36, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 9 - Science Laboratory/9D262CE3-FBD6-4A7B-B708-B550D0438336.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(326, 36, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 9 - Science Laboratory/Copy of 1746978779912.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(327, 36, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 9 - Science Laboratory/Copy of Copy of 1743919962552.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(328, 36, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 9 - Science Laboratory/Copy of Copy of 1743919962559.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(329, 36, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 9 - Science Laboratory/Copy of sprinklers inside the rooms.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(330, 36, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 9 - Science Laboratory/DA603660-CFBA-4EB6-A491-B4D075C8FF44.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(331, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/425CC360-D0F0-433F-8D4C-03A933934E5F.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(332, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/7BA1C837-0636-41D8-9FF3-F451F51DBD99.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(333, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/80132EE4-D4F4-451B-B38D-B2BA8626F089.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(334, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/Copy of 1746978779889.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(335, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/Copy of 1746978779895.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(336, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/Copy of Copy of 1743920553356.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(337, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/Copy of Copy of 1743920553363.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(338, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/D211B271-441F-4528-AA2B-DAE8E81644D8.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(339, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/DE625AB6-EDEF-45B2-BEE1-454EF4AC38C7.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(340, 40, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU Elementary Building/IMG_0054.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(341, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/4A1E642D-D519-4028-8EA1-4C21584F2251.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(342, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/8408C727-C9FB-4E58-A885-AF33B30E7F10.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(343, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/C4E8797B-BA6F-4042-BF81-125CF4FACAB1.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(344, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/Copy of 1746978779878.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(345, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/Copy of 1746978779884.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(346, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/Copy of Copy of 1743920514716.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(347, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/Copy of Copy of 1743920514764.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(348, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/IMG_0055.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(349, 39, 'assets/photo-docs/Pinagsanhan B/CvSU - Maragondon/CvSU High School Building/IMG_0074.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51'),
(350, 30, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/HUMSS Building/1746893329776.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22');
INSERT INTO `building_media` (`id`, `building_id`, `file_path`, `media_type`, `category`, `description`, `created_at`) VALUES
(351, 30, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/HUMSS Building/1746893329788.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(352, 30, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/HUMSS Building/1746893329796.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(353, 30, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/HUMSS Building/Copy of 1743896737189.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(354, 30, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/HUMSS Building/Copy of 1743896737195.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(355, 30, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/HUMSS Building/Copy of 1743896737202.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(356, 30, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/HUMSS Building/IMG_0013.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(357, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/1746893355978.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(358, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/1746893355987.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(359, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/1746893355993.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(360, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/1746893355999.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(361, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/Copy of 1743855779149.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(362, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/Copy of 1743855779168.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(363, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/Copy of 1743855779196.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(364, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/IMG_0014.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(365, 25, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/PagCor Building/IMG_0015.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(366, 29, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Stockroom/1746895678523.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(367, 29, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Stockroom/1746895678532.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(368, 29, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Stockroom/Copy of 1746978779929.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(369, 29, 'assets/photo-docs/Bucal 2/Bucal National Integrated School/Stockroom/IMG_0019.PNG', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:20:22'),
(390, 13, 'assets/photo-docs/!main-pictures-buildings/GARITA A/BH GARITA A.jpg', 'photo', 'main_photo', '', '2025-05-12 05:39:38'),
(391, 7, 'assets/photo-docs/Garita A/Maragondon Police Station/Untitled Project_25-05-10_18-25-56-279.jpg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 05:39:38'),
(392, 33, 'assets/photo-docs/Garita B/Cavite Science Integrated School/Building 5 - MALIKSI BLDG/3F7B0585-6CE4-4CA5-9188-745810756112.jpeg', 'photo', 'documentation', 'Documentation photo', '2025-05-12 12:06:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_checklists`
--
ALTER TABLE `audit_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `audit_type_id` (`audit_type_id`);

--
-- Indexes for table `audit_types`
--
ALTER TABLE `audit_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangay_id` (`barangay_id`);

--
-- Indexes for table `building_checklist_description`
--
ALTER TABLE `building_checklist_description`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangay_id` (`barangay_id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `audit_type_id` (`audit_type_id`);

--
-- Indexes for table `building_media`
--
ALTER TABLE `building_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `building_id` (`building_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_checklists`
--
ALTER TABLE `audit_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `audit_types`
--
ALTER TABLE `audit_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10469;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `building_checklist_description`
--
ALTER TABLE `building_checklist_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `building_media`
--
ALTER TABLE `building_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_checklists`
--
ALTER TABLE `audit_checklists`
  ADD CONSTRAINT `audit_checklists_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audit_checklists_ibfk_2` FOREIGN KEY (`audit_type_id`) REFERENCES `audit_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `building_checklist_description`
--
ALTER TABLE `building_checklist_description`
  ADD CONSTRAINT `building_checklist_description_ibfk_1` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `building_checklist_description_ibfk_2` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `building_checklist_description_ibfk_3` FOREIGN KEY (`audit_type_id`) REFERENCES `audit_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `building_media`
--
ALTER TABLE `building_media`
  ADD CONSTRAINT `building_media_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
