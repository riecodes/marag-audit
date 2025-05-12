<nav class="navbar-inner" style="display: flex; align-items: center; justify-content: space-between;">
    <div class="nav-back" style="flex: 0 0 auto;">
        <button onclick="window.history.back();" style="background: none; border: none; font-size: 1.8rem; cursor: pointer; color: #333; padding: 0 1rem;">
            &#8592; <!-- Unicode left arrow -->
        </button>
    </div>
    <div style="flex: 1 1 auto;">
        <div class="search-container">
            <span class="material-icons search-icon">search</span>
            <input class="search-input" type="search" name="q" placeholder=" ">
        </div>
        <div class="nav-links">
            <a class="nav-link<?php if ($section === 'home') echo ' active'; ?>" href="index.php?section=home">Home</a>
            <a class="nav-link<?php if ($section === 'about') echo ' active'; ?>" href="index.php?section=about">About</a>
            <a class="nav-link<?php if ($section === 'contact') echo ' active'; ?>" href="index.php?section=contact">Contact</a>
            <a class="nav-link<?php if ($section === 'explore') echo ' active'; ?>" href="index.php?section=explore">Explore</a>
            <a class="nav-link<?php if ($section === 'barangays')
                echo ' active'; ?>" href="index.php?section=barangay">Barangays</a>
        </div>
    </div>
</nav>
