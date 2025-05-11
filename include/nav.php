<?php
// nav.php: Navigation bar include for user-side
if (!isset($section))
    $section = 'home';
?>
<nav class="navbar">
    <div class="search-container">
        <span class="material-icons search-icon">search</span>
        <input class="search-input" type="search" name="q" placeholder=" ">
    </div>
    <div class="nav-links">
        <a class="nav-link<?php if ($section === 'home')
            echo ' active'; ?>" href="index.php?section=home">Home</a>
        <a class="nav-link<?php if ($section === 'about')
            echo ' active'; ?>" href="index.php?section=about">About</a>
        <a class="nav-link<?php if ($section === 'contact')
            echo ' active'; ?>" href="index.php?section=contact">Contact</a>
    </div>
</nav>
<script>
    // Animated search bar
    const searchToggle = document.getElementById('searchToggle');
    const searchInput = document.getElementById('searchInput');
    if (searchToggle && searchInput) {
        searchToggle.addEventListener('click', function () {
            searchInput.classList.toggle('active');
            if (searchInput.classList.contains('active')) {
                searchInput.focus();
            } else {
                searchInput.value = '';
            }
        });
        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !searchToggle.contains(e.target)) {
                searchInput.classList.remove('active');
            }
        });
    }
</script>