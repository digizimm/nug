<?php
/**
 * Routing
 */

$default = "landingpage.controller.php";
$notfound = "notfound.controller.php";

$mappings = [
    ["landing", $default],
    ["fuer-beduerftige", "landingpage_beduerftige.controller.php"],
    ["fuer-helfer", "landingpage_helfer.controller.php"],
    ["registrierung-helfer", "registrierung_helfer.controller.php"],
    ["registrierung-beduerftige", "registrierung_beduerftige.controller.php"],
    ["registrierung-abgeschlossen", "registrierung_done.controller.php"],
    ["anmelden", "anmelden.controller.php"]
];

$get = $_GET;

$controllerName = null;

if (!isset($_GET["v"])) {
    $controllerName = $default;
} else {
    $tempVal = htmlspecialchars($_GET["v"], ENT_QUOTES);

    $d = scandir("controller");

    for ($i=0; $i<count($mappings); $i++) {
        if ($mappings[$i][0] == $tempVal) {
            $controllerName = $mappings[$i][1];
        }
    }

    if ($controllerName == null) {
        $controllerName = $notfound;
    }
}

include("controller/" . $controllerName);