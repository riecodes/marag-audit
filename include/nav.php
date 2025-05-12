<nav class="navbar">
    <div class="nav-back scale-in">
        <button onclick="window.history.back();" class="back-btn btn-press" aria-label="Back">
            <span class="material-icons">arrow_back</span>
        </button>
    </div>
    <div class="search-container fade-in-up">
        <form id="searchForm" action="index.php" method="get">
            <div class="search-input-wrapper hover-glow">
                <input type="hidden" name="section" value="search">
                <span class="material-icons search-icon">search</span>
                <input class="search-input" type="search" name="q" placeholder="Search barangays or buildings..." autocomplete="off">
            </div>
        </form>
    </div>
    <div class="nav-links stagger-children">
        <a class="nav-link<?php if ($section === 'home') echo ' active'; ?> hover-lift btn-press" href="index.php?section=home">Home</a>
        <a class="nav-link<?php if ($section === 'about') echo ' active'; ?> hover-lift btn-press" href="index.php?section=about">About</a>
        <a class="nav-link<?php if ($section === 'contact') echo ' active'; ?> hover-lift btn-press" href="index.php?section=contact">Contact</a>
        <a class="nav-link<?php if ($section === 'explore') echo ' active'; ?> hover-lift btn-press" href="index.php?section=explore">Explore</a>
        <a class="nav-link<?php if ($section === 'barangays') echo ' active'; ?> hover-lift btn-press" href="index.php?section=barangay">Barangays</a>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle search form submission
    const searchForm = document.getElementById('searchForm');
    const searchInput = searchForm.querySelector('input[name="q"]');
    
    // Submit form when Enter key is pressed in search input
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            if (searchInput.value.trim() !== '') {
                searchForm.submit();
            }
            e.preventDefault();
        }
    });
    
    // Add animation when search is focused
    searchInput.addEventListener('focus', function() {
        document.querySelector('.search-input-wrapper').classList.add('pulse');
    });
    
    searchInput.addEventListener('blur', function() {
        document.querySelector('.search-input-wrapper').classList.remove('pulse');
    });
    
    // Add ripple effect to navbar links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.add('ripple');
    });
});
</script>
