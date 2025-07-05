<?php



spl_autoload_register(function ($class) {
    $prefix = 'src\\';
    $base_dir = __DIR__ . '/src/';

    // Vérifie que la classe utilise le namespace "src\"
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Ce n'est pas une classe sous src\, on ignore
        return;
    }

    // Retire "src\" du début du namespace pour construire le chemin relatif
    $relative_class = substr($class, $len);

    // Convertit les \ en / et construit le chemin complet
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "<p style='color:red;'>Classe non trouvée : $file</p>";
    }
});

require_once __DIR__ . '/config/database.php';

