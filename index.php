<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AETERNA - CS2 Roster</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/roster.css">
    <link rel="stylesheet" href="css/bottom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Rajdhani:wght@500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Menú de Navegación Premium -->
    <nav class="navbar">
        <a href="index.php" class="nav-logo" style="text-decoration:none;">AETERNA</a>
        <div class="nav-links" id="nav-links">
            <a href="index.php">Roster</a>
            <a href="calendario.php">Partidos</a>
            <a href="tienda.php">Tienda</a>
            <a href="contacto.php">Contacto</a>
            <?php
            $nav_av = isset($_SESSION['avatar_path']) && !empty($_SESSION['avatar_path']) ? $_SESSION['avatar_path'] : '';
            if ($nav_av) {
                echo '<a href="perfil.php" style="margin-left: 2rem; display:inline-flex; align-items:center;"><img src="' . $nav_av . '" style="width:35px; height:35px; border-radius:50%; object-fit:cover; border:2px solid var(--accent); margin-right:8px;"> <span style="color:var(--accent);">' . $_SESSION['username'] . '</span></a>';
            } else {
                echo '<a href="perfil.php" style="margin-left: 2rem; display:inline-flex; align-items:center; color:var(--accent);"><i class="fa-solid fa-user-astronaut" style="font-size:1.5rem; margin-right:8px;"></i> ' . $_SESSION['username'] . '</a>';
            }
            ?>
        </div>
        <a href="logout.php" style="color:var(--text-sub); font-weight:bold; font-family:var(--font-heading); text-transform:uppercase; text-decoration:none; margin-left: auto; margin-right: 20px;" class="desktop-only"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
        <div class="hamburger" id="hamburger"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <header class="header">
        <h1 class="logo glow">AETERNA <span> ESPORTS</span></h1>
        <p class="subtitle">Official CS2 Roster</p>
    </header>

    <div class="team-logo-container">
        <img class="team-logo-img" src="images/aeterna-logo.jpg" alt="Aeterna Esports Logo">
    </div>

    <main class="container roster-grid">

        <!-- Player 1 -->
        <article class="player-card" data-tilt style="animation-delay: 0.1s;">
            <figure class="card-image-wrapper">
                <img src="images/laucha.png" alt="Zero" class="player-img">
                <span class="role-badge awper">AWPer</span>
                <ul class="player-stats">
                    <li class="stat">
                        <span class="stat-value">1.25</span>
                        <span class="stat-label">HLTV</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">45%</span>
                        <span class="stat-label">HS%</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">0.81</span>
                        <span class="stat-label">KPR</span>
                    </li>
                </ul>
            </figure>
            <section class="card-content">
                <h2 class="player-name">Zero</h2>
                <h3 class="player-realname">Alex Mercer</h3>
                <p class="player-desc">El francotirador estrella del equipo. Su precisión y reflejos aseguran el control
                    del mapa en los momentos más tensos.</p>
                <div class="social-links">
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitch"><i class="fa-brands fa-twitch"></i></a>
                </div>
            </section>
        </article>

        <!-- Player 2 -->
        <article class="player-card" data-tilt style="animation-delay: 0.2s;">
            <figure class="card-image-wrapper">
                <img src="images/nico.png" alt="Neo" class="player-img">
                <span class="role-badge igl">IGL</span>
                <ul class="player-stats">
                    <li class="stat">
                        <span class="stat-value">1.05</span>
                        <span class="stat-label">HLTV</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">52%</span>
                        <span class="stat-label">HS%</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">0.65</span>
                        <span class="stat-label">KPR</span>
                    </li>
                </ul>
            </figure>
            <section class="card-content">
                <h2 class="player-name">Neo</h2>
                <h3 class="player-realname">Liam Carter</h3>
                <p class="player-desc">La mente maestra. Como In-Game Leader, dirige las tácticas operativas y lee los
                    movimientos del enemigo a la perfección.</p>
                <div class="social-links">
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitch"><i class="fa-brands fa-twitch"></i></a>
                </div>
            </section>
        </article>

        <!-- Player 3 -->
        <article class="player-card" data-tilt style="animation-delay: 0.3s;">
            <figure class="card-image-wrapper">
                <img src="images/juan.png" alt="Juan" class="player-img">
                <span class="role-badge entry">Entry Fragger</span>
                <ul class="player-stats">
                    <li class="stat">
                        <span class="stat-value">1.18</span>
                        <span class="stat-label">HLTV</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">61%</span>
                        <span class="stat-label">HS%</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">0.76</span>
                        <span class="stat-label">KPR</span>
                    </li>
                </ul>
            </figure>
            <section class="card-content">
                <h2 class="player-name">Juan</h2>
                <h3 class="player-realname">Juan</h3>
                <p class="player-desc">Agresividad pura. Es el primero en entrar al sitio, abriendo el espacio necesario
                    para que el equipo tome el control.</p>
                <div class="social-links">
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.instagram.com/juancruz.marzola/" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitch"><i class="fa-brands fa-twitch"></i></a>
                </div>
            </section>
        </article>

        <!-- Player 4 -->
        <article class="player-card" data-tilt style="animation-delay: 0.4s;">
            <figure class="card-image-wrapper">
                <img src="images/brian.jpg" alt="Brian" class="player-img">
                <span class="role-badge lurker">Lurker</span>
                <ul class="player-stats">
                    <li class="stat">
                        <span class="stat-value">1.12</span>
                        <span class="stat-label">HLTV</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">48%</span>
                        <span class="stat-label">HS%</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">0.72</span>
                        <span class="stat-label">KPR</span>
                    </li>
                </ul>
            </figure>
            <section class="card-content">
                <h2 class="player-name">Vryker</h2>
                <h3 class="player-realname">Brian</h3>
                <p class="player-desc">El fantasma del mapa. Juega en las sombras cortando las rotaciones enemigas y
                    asegurando rondas desde la retaguardia.</p>
                <div class="social-links">
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.instagram.com/vryker_1/" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitch"><i class="fa-brands fa-twitch"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </section>
        </article>

        <!-- Player 5 -->
        <article class="player-card" data-tilt style="animation-delay: 0.5s;">
            <figure class="card-image-wrapper">
                <img src="images/player5.png" alt="Apex" class="player-img">
                <span class="role-badge support">Support</span>
                <ul class="player-stats">
                    <li class="stat">
                        <span class="stat-value">1.02</span>
                        <span class="stat-label">HLTV</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">42%</span>
                        <span class="stat-label">HS%</span>
                    </li>
                    <li class="stat">
                        <span class="stat-value">0.60</span>
                        <span class="stat-label">KPR</span>
                    </li>
                </ul>
            </figure>
            <section class="card-content">
                <h2 class="player-name">Apex</h2>
                <h3 class="player-realname">Noah Chen</h3>
                <p class="player-desc">El pilar del equipo. Sus utilidades son perfectas; siempre tiene la flashbang o
                    el humo indicado para asegurar el éxito.</p>
                <div class="social-links">
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Twitch"><i class="fa-brands fa-twitch"></i></a>
                </div>
            </section>
        </article>

    </main>

    <!-- Sección de Esports: Últimos Resultados y Sponsors -->
    <section class="bottom-section container reveal-on-scroll">
        <div class="matches">
            <h3 class="section-title">Últimos Resultados</h3>
            <ul class="match-list">
                <li><span class="win">VICTORIA</span> AETERNA <strong>2 - 0</strong> Natus Vincere</li>
                <li><span class="win">VICTORIA</span> AETERNA <strong>16 - 14</strong> FaZe Clan</li>
            </ul>
        </div>
        <div class="sponsors">
            <h3 class="section-title">Patrocinadores Oficiales</h3>
            <div class="sponsor-logos">
                <i class="fa-brands fa-discord"></i>
                <i class="fa-brands fa-steam"></i>
                <i class="fa-brands fa-twitch"></i>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-layout container">
            <div class="footer-col">
                <h4 class="logo glow" style="font-size: 1.5rem;">AETERNA<span>ESPORTS</span></h4>
                <p>Nuestra meta es dominar la escena Tier 1 de Counter-Strike 2. Pasión, disciplina y headshots.</p>
            </div>
            <div class="footer-col">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="tienda.php">Tienda Oficial</a></li>
                    <li><a href="calendario.php">Calendario de Partidos</a></li>
                    <li><a href="patrocinadores.php">Nuestros Patrocinadores</a></li>
                    <li><a href="contacto.php">Contacto / Tryouts</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Únete a las filas</h4>
                <p>Suscríbete para recibir noticias, sorteos de skins y los últimos resultados.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Tu Email..." aria-label="Email">
                    <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 AETERNA Esports. Dominando los servidores de Counter-Strike 2.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>