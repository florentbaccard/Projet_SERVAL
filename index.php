<?php
    session_start(); // Démarre la session pour utiliser la variable $_SESSION
    
    // Fonction d'autoloading des classes
    function chargerClasses($class) {
        include $class . '.class.php'; // Inclut la classe spécifiée
    }
    spl_autoload_register('chargerClasses'); // Enregistre la fonction d'autoloading des classes

    // Initialisation des objets
    $Marie = new BaseClass(); // Crée une nouvelle instance de BaseClass
    $view = new FirstPersonView(); // Crée une nouvelle instance de FirstPersonView
    $text = new FirstPersonText(); // Crée une nouvelle instance de FirstPersonText
    $action = new FirstPersonAction(); // Crée une nouvelle instance de FirstPersonAction

    // Setters récupérant les positions/statut de $Marie à partir des données POST
    if (isset($_POST['currentAngle'])) {
        $Marie->setCurrentX($_POST['currentX']); // Définit la position X de $Marie
        $Marie->setCurrentY($_POST['currentY']); // Définit la position Y de $Marie
        $Marie->setCurrentAngle($_POST['currentAngle']); // Définit l'angle de vue de $Marie
        $Marie->setMapStatus($_POST['mapStatus']); // Définit le statut de la carte de $Marie
    }

    // Utilisation des données POST pour activer les mouvements/actions de $Marie
    if (isset($_POST['turnLeft'])) {
        $Marie->turnLeft(); // Tourne $Marie vers la gauche
    }

    if (isset($_POST['goForward'])) {
        $Marie->goForward(); // Fait avancer $Marie
    }

    if (isset($_POST['turnRight'])) {
        $Marie->turnRight(); // Tourne $Marie vers la droite
    }

    if (isset($_POST['goLeft'])) {
        $Marie->goLeft(); // Déplace $Marie vers la gauche
    }

    if (isset($_POST['goRight'])) {
        $Marie->goRight(); // Déplace $Marie vers la droite
    }

    if (isset($_POST['goBack'])) {
        $Marie->goBack(); // Fait reculer $Marie
    }

    if (isset($_POST['action'])) {
        $action->doAction($Marie); // Exécute une action spécifique avec $Marie
    }

    // var_dump($_POST); // Affiche les données POST pour le débogage

    // // Vérifie si le bouton de réinitialisation a été cliqué et réinitialise $Marie si nécessaire
    if (isset($_POST['reset']) && $_POST['reset'] === "Reset") {
        $action->reset($Marie); // Réinitialise $Marie
    }
?>

<!DOCTYPE html> <!-- Déclaration du type de document -->

<html lang="FR"> <!-- Balise d'ouverture de l'élément HTML avec la langue spécifiée -->
    <head>
        <meta charset="utf-8"> <!-- Définition de l'encodage des caractères -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> <!-- Configuration de la vue pour les appareils mobiles -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous"> <!-- Importation des icônes FontAwesome -->
        <link rel="stylesheet" href="style.css"> <!-- Importation de la feuille de style personnalisée -->
        <link rel="preload" as="image" href="assets/compassnb.png"> <!-- Préchargement d'une image -->
        <title>DooM Like</title> <!-- Titre de la page -->
        <link rel="icon" type="image/png" href="assets/favicon.png"> <!-- Définition de l'icône de favicon -->
    </head>

    <body>
        <div class="absolute"> <!-- Conteneur principal avec positionnement absolu -->
            <div class="abso2"> <!-- Div contenant des éléments de navigation -->
                <!-- Liste d'éléments pour afficher les touches de contrôle -->
                <p class="key">Touches</p>
                <ul class="keys">
                    <li class="li1"><input type="submit" class="icon fa" value="&#xf0e2;"></li>
                    <li class="li2">
                        <p>=</p>
                    </li>
                    <li class="li3"><img src="assets/a.png" alt=""></li>
                </ul>
                <ul class="keys">
                    <li class="li1"><input type="submit" class="icon fa" value="&#xf084;"></li>
                    <li class="li2">
                        <p>=</p>
                    </li>
                    <li class="li3"><img src="assets/f.png" alt=""></li>
                </ul>
                <ul class="keys">
                    <li class="li1"><input type="submit" class="icon fa" value="&#xf01e;"></li>
                    <li class="li2">
                        <p>=</p>
                    </li>
                    <li class="li3"><img src="assets/e.png" alt=""></li>
                </ul>
                <ul class="keys">
                    <li class="li1"><input type="submit" class="icon fa" value="&#xf062;"></li>
                    <li class="li2">
                        <p>=</p>
                    </li>
                    <li class="li3"><img src="assets/z.png" alt=""></li>
                </ul>
                <ul class="keys">
                    <li class="li1"><input type="submit" class="icon fa" value="&#xf060;"></li>
                    <li class="li2">
                        <p>=</p>
                    </li>
                    <li class="li3"><img src="assets/q.png" alt=""></li>
                </ul>
                <ul class="keys">
                    <li class="li1"><input type="submit" class="icon fa" value="&#xf061;"></li>
                    <li class="li2">
                        <p>=</p>
                    </li>
                    <li class="li3"><img src="assets/d.png" alt=""></li>
                </ul>
                <ul class="keys">
                    <li class="li1"><input type="submit" class="icon fa" value="&#xf063;"></li>
                    <li class="li2">
                        <p>=</p>
                    </li>
                    <li class="li3"><img src="assets/s.png" alt=""></li>
                </ul>
            </div>
            <img class="abso" src="assets/title.png" alt="">
            <div class="game">
                <div class="row1">
                    <!-- Affichage de l'image liée à la position/statut de Marie -->
                    <img class="view" src="images/<?php echo $view->getView($Marie) ?>" alt="view">
                </div>
                <div class="row2">
                    <div class="left">
                        <form class="directions" method="post" action="index.php"> <!-- Formulaire pour les mouvements de Marie -->
                            <!-- Champs cachés conservant le statut de Marie -->
                            <!-- Boutons pour les mouvements de Marie, activés/désactivés en fonction des possibilités -->
                            <!-- Affichage de la boussole avec orientation basée sur la vue de Marie -->
                            <input type="hidden" name="currentX" value="<?php echo $Marie->getCurrentX(); ?>">
                            <input type="hidden" name="currentY" value="<?php echo $Marie->getCurrentY(); ?>">
                            <input type="hidden" name="currentAngle" value="<?php echo $Marie->getCurrentAngle(); ?>">
                            <input type="hidden" name="mapStatus" value="<?php echo $Marie->getMapStatus(); ?>">
                            <table>
                                <!-- Les Submit permettent De Déplacer $Marie, Les Check Activent/Désactivent les Boutons Selon Qu'On Puisse Se Déplacer Ou Pas -->
                                <tr>
                                    <td><input type="submit" class="icon fa" value="&#xf0e2;" name="turnLeft"></td>
                                    <td><input type="submit" class="icon fa" value="&#xf062;" name="goForward" <?php echo $Marie->checkForward() == TRUE ? "enabled" : "disabled"; ?>></td>
                                    <td><input type="submit" class="icon fa" value="&#xf01e;" name="turnRight"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" class="icon fa" value="&#xf060;" name="goLeft" <?php echo $Marie->checkLeft() == TRUE ? "enabled" : "disabled"; ?>></td>
                                    <td><input type="submit" class="icon fa" value="&#xf084;" name="action" <?php echo $action->checkAction($Marie) == TRUE ? "enabled" : "disabled"; ?>></td>
                                    <td><input type="submit" class="icon fa" value="&#xf061;" name="goRight" <?php echo $Marie->checkRight() == TRUE ? "enabled" : "disabled"; ?>></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" class="icon fa" value="&#xf063;" name="goBack" <?php echo $Marie->checkBack() == TRUE ? "enabled" : "disabled"; ?>></td>
                                    <td></td>
                                </tr>
                            </table>
                        </form>
                        <!-- L'Orientation De La Boussole Change Selon Le Point De Vue De $Marie -->
                        <img class="compass <?php echo $view->getAnimCompass($Marie) ?>" src="assets/compassnb.png"
                            alt="compass">
                    </div>
                    <div class="right">
                        <!-- Changement Du Texte Selon La Position Et Les Actions De $Marie -->
                        <p class="text">
                            <?php echo $text->getText($Marie); ?>
                        </p>
                        <div class="inventory">
                            <!-- Affichage du texte selon la position/actions de Marie -->
                            <!-- Affichage de l'inventaire de Marie -->
                            <!-- Bouton de réinitialisation -->
                            <img id="bag" src="assets/bag.png" alt="Sac d'Inventaire">
                            <p class="text_inventaire"> :
                                <?php echo isset($_SESSION['description']) ? $_SESSION['description'] : "vide"; ?>
                            </p>
                            <!-- Bouton Reset -->
                            <form id="btn" method="post" action="index.php">
                                <button class="delete-button" role="button" name="reset" value="Reset">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image background -->
        <svg id="fireSVG">
            <defs>
                <filter id="fireColorFilter">
                    <feTurbulence type="fractalNoise" stitchTiles="stitch" baseFrequency="0.02" numOctaves="8" />
                    <feColorMatrix type="matrix" values="1  0  0  0  0
                                                                            1  0  0  0  0
                                                                            1  0  0  0  0
                                                                            0  0  0  0  1" />
                    <feComponentTransfer>
                        <feFuncR type="table" tableValues="1    1   1     1     1  "></feFuncR>
                        <feFuncG type="table" tableValues="0.05 0.1 0.133 0.166 0.2"></feFuncG>
                        <feFuncB type="table" tableValues="0    0   0     0     0  "></feFuncB>
                        <feFuncA type="table" tableValues="1    1   1     1     1  "></feFuncA>
                    </feComponentTransfer>
                </filter>
                <filter id="fireDetailFilter">
                    <feTurbulence type="fractalNoise" seed="2" stitchTiles="stitch" baseFrequency="0.01" numOctaves="6" />
                    <feColorMatrix type="matrix" values="1  0  0  0  0
                                                                            1  0  0  0  0
                                                                            1  0  0  0  0
                                                                            0  0  0  0  1" />
                </filter>
                <filter id="fireShapeFilter">
                    <feTurbulence type="fractalNoise" seed="3" baseFrequency="0.005" numOctaves="2" result="turbulence" />
                    <feColorMatrix type="matrix" values="1  0  0  0  0
                                                                            1  0  0  0  0
                                                                            1  0  0  0  0
                                                                            0  0  0  0  1" />
                </filter>
                <rect id="fireColor" x="8%" y="8%" width="84%" height="83.5%" filter="url(#fireColorFilter)" />
                <rect id="fireDetail" x="8%" y="8%" width="84%" height="83.5%" filter="url(#fireDetailFilter)" />
                <linearGradient id="fireGradient" x1="0%" x2="0%" y1="100%" y2="0%">
                    <stop offset="00%" stop-color="#fff" />
                    <stop offset="80%" stop-color="#000" />
                </linearGradient>
            </defs>
            <g class="slide">
                <use href="#fireColor" x="0%" y="0%" width="100%" height="100%" />
                <use href="#fireColor" x="0%" y="-100%" width="100%" height="100%" />
            </g>
            <g class="multiply">
                <rect x="0%" y="0%" width="100%" height="100%" fill="url(#fireGradient)" />
                <rect x="0%" y="0%" width="100%" height="100%" filter="url(#fireShapeFilter)" class="multiply" />
            </g>
            <g class="slide multiply">
                <use href="#fireDetail" x="0%" y="0%" width="100%" height="100%" />
                <use href="#fireDetail" x="0%" y="-100%" width="100%" height="100%" />
            </g>
        </svg>

        <script>
            // Script Contrôlant Les Mouvements De Marie Avec Le Clavier (touches A, Z, E, Q, S, D, F)
            turnLeft = document.querySelector("input[name='turnLeft']"); // Sélectionne le bouton de rotation à gauche
            goForward = document.querySelector("input[name='goForward']"); // Sélectionne le bouton d'avancer
            turnRight = document.querySelector("input[name='turnRight']"); // Sélectionne le bouton de rotation à droite
            goLeft = document.querySelector("input[name='goLeft']"); // Sélectionne le bouton de déplacement à gauche
            action = document.querySelector("input[name='action']"); // Sélectionne le bouton d'action
            goRight = document.querySelector("input[name='goRight']"); // Sélectionne le bouton de déplacement à droite
            goBack = document.querySelector("input[name='goBack']"); // Sélectionne le bouton de recul

            // Événement de déclenchement sur l'appui d'une touche
            document.addEventListener("keydown", (event) => {
                switch (event.code) {
                    case 'KeyQ': // Touche Q pour tourner à gauche
                        turnLeft.click();
                        break;

                    case 'KeyE': // Touche E pour tourner à droite
                        turnRight.click();
                        break;

                    case 'KeyW': // Touche W pour avancer
                        goForward.click();
                        break;

                    case 'KeyA': // Touche A pour aller à gauche
                        goLeft.click();
                        break;

                    case 'KeyD': // Touche D pour aller à droite
                        goRight.click();
                        break;

                    case 'KeyS': // Touche S pour reculer
                        goBack.click();
                        break;

                    case 'KeyF': // Touche F pour l'action
                        action.click();
                        break;

                    default:
                        break;
                }
            })
            // Fonction Préchargeant Les Images Afin d'Améliorer La Fluidité
            function preloadImage(image_url) {
                let img = new Image();
                img.src = "images/" + image_url + ".jpg"; // URL de l'image
            }
            // Préchargement des images pour améliorer la fluidité
            preloadImage("01-0");
            preloadImage("01-90");
            preloadImage("01-180");
            preloadImage("01-180-1");
            preloadImage("01-270");
            preloadImage("10-0");
            preloadImage("10-90");
            preloadImage("10-180");
            preloadImage("10-270");
            preloadImage("11-0");
            preloadImage("11-90");
            preloadImage("11-180");
            preloadImage("11-270");
            preloadImage("12-0");
            preloadImage("12-90");
            preloadImage("12-90-1");
            preloadImage("12-180");
            preloadImage("12-270");
        </script>
    </body>
</html>

<!-- Index.php -->