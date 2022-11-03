<?php
/**
 * @var string $content
 */
?>
<html lang="en">
<head>
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="/" class="logo">
            Blog logo & link
        </a>
        <div class="title">Blog name</div>
    </header>
    <nav>
        <ul>
            <li><a href="#">Ubersicht</a></li>
            <li><a href="#">[Neuer Eintrag]</a></li>
            <li><a href="#">Impressum</a></li>
            <li class="right"><a href="#">Login</a></li>
        </ul>
    </nav>

    <main>
        <?=$content?>
    </main>

    <footer>

    </footer>
</body>
</html>
