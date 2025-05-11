
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
