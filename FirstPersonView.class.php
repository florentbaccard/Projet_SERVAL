<?php
    // Définition de la classe FirstPersonView
    class FirstPersonView extends BaseClass {
        
        // Méthode pour afficher l'image appropriée en fonction de l'ID de la carte et du statut
        public function getView(BaseClass $perso) {
            // Récupération de l'ID de la carte et du statut du personnage
            $_mapId = $perso->getMapId();
            $_mapStatus = $perso->getMapStatus();

            // Requête SQL pour sélectionner le chemin de l'image en fonction de l'ID de la carte et du statut
            $sql = "SELECT path FROM images WHERE map_id = :mapId AND status_action=:status";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(':mapId', $_mapId, PDO::PARAM_INT);
            $query->bindParam(':status', $_mapStatus, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(); // Récupération du résultat de la requête

            return $result['path']; // Retourne le chemin de l'image
        }

        // Méthode pour renvoyer la direction appropriée de la boussole avec les classes CSS correspondantes
        public function getAnimCompass(BaseClass $perso) {
            // Switch sur l'angle actuel du personnage pour déterminer la direction de la boussole
            switch ($perso->_currentAngle) {
                case 0:
                    $perso->_currentCompass = 'east'; // Est
                    break;

                case 90:
                    $perso->_currentCompass = 'north'; // Nord
                    break;

                case 180:
                    $perso->_currentCompass = 'west'; // Ouest
                    break;

                case 270:
                    $perso->_currentCompass = 'south'; // Sud
                    break;

                default:
                    break;
            }
            return $perso->_currentCompass; // Retourne la direction de la boussole
        }
    }
?>

<!-- Firstpersonview.class.php -->