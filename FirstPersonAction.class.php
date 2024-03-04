<?php
    // Définition de la classe FirstPersonAction
    class FirstPersonAction extends BaseClass {

        // Vérifie si une action peut être effectuée en fonction de la position de Marie sur la carte
        public function checkAction(BaseClass $perso) {
            $_mapId = $perso->getMapId();

            // Recherche dans la table Action l'ID de la carte
            $sql = "SELECT * FROM action WHERE map_id=:mapid";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(':mapid', $_mapId, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch();

            // Initialise $_SESSION['Item'] à zéro si elle n'existe pas encore
            if (!$_SESSION['item']) {
                $_SESSION['item'] = 0;
            }

            // Si un résultat est trouvé, il est comparé à la valeur de $_SESSION['Item'] pour vérifier si un objet est requis et si l'objet est dans l'inventaire
            if ($result) {
                if ($result['requis'] == $_SESSION['item']) {
                    return TRUE; // Retourne vrai si l'action peut être effectuée
                } else {
                    return FALSE; // Retourne faux si l'action ne peut pas être effectuée
                }
            } else {
                return FALSE; // Retourne faux si aucun résultat n'est trouvé
            }
        }

        // Effectue l'action et modifie la base de données en conséquence
        public function doAction(BaseClass $perso) {
            $_mapId = $perso->getMapId();
            $status = 1;

            // Le statut de l'action correspondante passe de 0 à 1 dans la base de données
            $sql = "UPDATE action SET status=:status WHERE map_id=:mapid";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(':status', $status, PDO::PARAM_INT);
            $query->bindParam(':mapid', $_mapId, PDO::PARAM_INT);
            $query->execute();

            // Si l'inventaire est vide, on récupère les informations de l'objet et on les stocke dans $_SESSION
            if (!isset($_SESSION['item']) || $_SESSION['item'] == 0) {
                $sql = "SELECT * FROM items";
                $query = $this->dbh->prepare($sql);
                $query->execute();
                $item = $query->fetch();

                $_SESSION['item'] = (int)$item['id'];
                $_SESSION['description'] = $item['description'];

            // Sinon, si l'objet est déjà dans l'inventaire, l'action utilise l'objet et l'inventaire devient vide
            } else {
                $_SESSION['item'] = 0;
                $_SESSION['description'] = 'Reset Game';
            }
        }

        // Réinitialise l'état du jeu
        public function reset($perso) {
            $statusReset = 0;

            // Réinitialisation du statut de l'action dans la base de données
            $reset = "UPDATE action SET status=:status";
            $query = $this->dbh->prepare($reset);
            $query->bindParam(':status', $statusReset, PDO::PARAM_INT);
            $query->execute();

            // Réinitialisation de l'inventaire et des informations du personnage dans la session
            $_SESSION['item'] = 0;
            $_SESSION['description'] = "vide";
            $perso->setCurrentX(0);
            $perso->setCurrentY(1);
            $perso->setCurrentAngle(0);
        }
    }
?>

<!-- Firstpersonaction.class.php -->