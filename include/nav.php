<nav class="navbar">
    <div class="nav-back">
        <button onclick="window.history.back();" class="back-btn" aria-label="Back">
            <span class="material-icons">arrow_back</span>
        </button>
    </div>
    <div class="search-container">
        <span class="material-icons search-icon">search</span>
        <input class="search-input" type="search" name="q" placeholder=" ">
    </div>
    <div class="nav-links">
        <a class="nav-link<?php if ($section === 'home') echo ' active'; ?>" href="index.php?section=home">Home</a>
        <a class="nav-link<?php if ($section === 'about') echo ' active'; ?>" href="index.php?section=about">About</a>
        <a class="nav-link<?php if ($section === 'contact') echo ' active'; ?>" href="index.php?section=contact">Contact</a>
        <a class="nav-link<?php if ($section === 'explore') echo ' active'; ?>" href="index.php?section=explore">Explore</a>
        <a class="nav-link<?php if ($section === 'barangays') echo ' active'; ?>" href="index.php?section=barangay">Barangays</a>
    </div>
</nav>
