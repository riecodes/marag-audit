# 🏢 Maragondon Building Audit System

A comprehensive web-based system for managing and auditing buildings in Maragondon. This system provides a user-friendly interface for viewing, managing, and auditing building information across different barangays.

## 📋 Table of Contents
- [Features](#-features)
- [Project Structure](#-project-structure)
- [Installation](#-installation)
- [Usage](#-usage)
- [Technologies Used](#-technologies-used)
- [Directory Structure](#-directory-structure)

## ✨ Features
- 🏘️ Barangay Management
- 🏢 Building Information System
- 🔍 Search Functionality
- 📊 Building Audit System
- 📱 Responsive Design
- 🔐 User Authentication
- 📄 Document Management

## 🗂️ Project Structure
The project follows a modular structure with clear separation of concerns:

- `index.php` - Main entry point
- `content/` - Contains all page content
- `include/` - Core functionality and utilities
- `css/` - Stylesheets
- `assets/` - Images and other static assets
- `db/` - Database related files
- `documents/` - Document storage
- `mockup/` - Design mockups

## 🚀 Installation

1. Clone the repository:
```bash
git clone https://github.com/riecodes/marag-audit.git
```

2. Set up your web server (XAMPP recommended)
3. Import the database schema from `db/` directory
4. Configure database connection in `include/init.php`
5. Access the application through your web browser

## 💻 Usage

The system provides several key functionalities:

- **Home** (`/index.php?section=home`) - Landing page
- **About** (`/index.php?section=about`) - About the system
- **Barangay** (`/index.php?section=barangay`) - Barangay management
- **Buildings** (`/index.php?section=buildings`) - Building listing
- **Building Info** (`/index.php?section=building_info`) - Detailed building information
- **Building Audit** (`/index.php?section=building_audit`) - Building audit system
- **Search** (`/index.php?section=search`) - Search functionality
- **Contact** (`/index.php?section=contact`) - Contact information

## 🛠️ Technologies Used

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Bootstrap 5.3.0
- XAMPP (Web Server)

## 📁 Directory Structure

```
maragondon-audit/
├── index.php              # Main entry point
├── content/              # Page content
│   ├── home.php
│   ├── about.php
│   ├── contact.php
│   ├── barangay.php
│   ├── building.php
│   ├── building_info.php
│   ├── building_audit.php
│   └── search.php
├── include/              # Core functionality
├── css/                  # Stylesheets
├── assets/              # Static assets
├── db/                  # Database files
├── documents/           # Document storage
└── mockup/              # Design mockups
```


## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👥 Authors

- rieCodes

## 📞 Support

For support, please contact [eirmonpaculan11@gmail.com] 