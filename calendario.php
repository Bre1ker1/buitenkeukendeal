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
    <title>Calendario - AETERNA ESPORTS</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/calendar.css">
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
            if($nav_av) {
                echo '<a href="perfil.php" style="margin-left: 2rem; display:inline-flex; align-items:center;"><img src="'.$nav_av.'" style="width:35px; height:35px; border-radius:50%; object-fit:cover; border:2px solid var(--accent); margin-right:8px;"> <span style="color:var(--accent);">'.$_SESSION['username'].'</span></a>';
            } else {
                echo '<a href="perfil.php" style="margin-left: 2rem; display:inline-flex; align-items:center; color:var(--accent);"><i class="fa-solid fa-user-astronaut" style="font-size:1.5rem; margin-right:8px;"></i> '.$_SESSION['username'].'</a>';
            }
            ?>
        </div>
        <a href="logout.php" style="color:var(--text-sub); font-weight:bold; font-family:var(--font-heading); text-transform:uppercase; text-decoration:none; margin-left: auto; margin-right: 20px;" class="desktop-only"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
        <div class="hamburger" id="hamburger"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <main class="container page-content">
        <div style="margin-bottom: 2rem;" class="reveal-on-scroll">
            <a href="index.php" style="color: var(--accent); text-decoration: none; font-weight: bold; font-family: var(--font-heading); font-size: 1.2rem; transition: margin-left 0.3s;" onmouseover="this.style.marginLeft='-5px'" onmouseout="this.style.marginLeft='0'">
                <i class="fa-solid fa-arrow-left"></i> Volver a la Página Principal
            </a>
        </div>
        <h2 class="section-title reveal-on-scroll">Calendario de Partidos</h2>
        <p style="color:var(--text-sub); margin-bottom: 2rem; padding-left:1rem;" class="reveal-on-scroll">Próximos
            encuentros y torneos de CS2. (Versión esquema sin fechas).</p>

        <div class="calendar-layout reveal-on-scroll" style="animation-delay: 0.2s;">
            <div class="calendar-days">
                <span>LUN</span>
                <span>MAR</span>
                <span>MIE</span>
                <span>JUE</span>
                <span>VIE</span>
                <span>SAB</span>
                <span>DOM</span>
            </div>

            <div class="calendar-grid">
                <!-- Generaré 35 cajas vacías simulando un mes en blanco -->
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>

                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>

                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>

                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>

                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
                <div class="cal-box"></div>
            </div>
        </div>
    </main>

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




