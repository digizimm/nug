<?php
/**
 * Routing
 */

$default = "home.controller.php";
$notfound = "notfound.controller.php";

$mappings = [
    ["home", $default],
    ["botengang-finden", "search.controller.php"],
    ["botengang", "job_details.controller.php"],
    ["ranglisten", "highscores.controller.php"],
    ["mein-profil", "profile.controller.php"],
    ["profil-bearbeiten", "edit_profile.controller.php"]
];

$get = $_GET;

$controllerName = null;

if (!isset($_GET["v"])) {
    $controllerName = $default;
} else {

    if (strpos($_GET["v"], "-")) {

        $spl = mb_split("-", $_GET["v"]);
        if ($spl[0] == "botengang" && count($spl) > 1) {
            $jobId = $spl[1];

            if ($jobId != "finden") {
                include("controller/job_details_full.controller.php");
                exit();
            }
        }
    }

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