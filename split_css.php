<?php
$css = file_get_contents('css/style.css');

$blocks = [
    'calendar' => '/\/\* --- Calendar Page ---\s*\*\/(.*?)(?=\/\* --- Store Page --- |\z)/s',
    'store' => '/\/\* --- Store Page ---\s*\*\/(.*?)(?=\/\* --- Contact & Tryouts Form --- |\z)/s',
    'forms' => '/\/\* --- Contact & Tryouts Form ---\s*\*\/(.*?)(?=\/\* --- Patrocinadores Page --- |\z)/s',
    'sponsors' => '/\/\* --- Patrocinadores Page ---\s*\*\/(.*?)\z/s',
    'roster' => '/\/\* Player Card Styles \(Glassmorphism \+ Neon\) \*\/(.*?)(?=\/\* Navbar \*\/)/s',
    'bottom' => '/\/\* Bottom Section \(Matches & Sponsors\) \*\/(.*?)(?=\/\* Advanced Footer \*\/)/s'
];

foreach ($blocks as $name => $regex) {
    if (preg_match($regex, $css, $matches)) {
        file_put_contents("css/{$name}.css", trim($matches[0]) . "\n");
        $css = str_replace($matches[0], '', $css);
    } else {
        echo "No se encontró el bloque para $name\n";
    }
}

// Save the remaining as global.css
file_put_contents('css/global.css', trim($css) . "\n");

echo "CSS dividido con éxito.";
?>

