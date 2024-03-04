<?php
    // Définition de la classe FirstPersonText
    class FirstPersonText extends BaseClass {
        
        // Méthode pour afficher le bon texte en fonction de l'ID de la carte et du statut
        public function getText(BaseClass $perso) {
            // Récupération de l'ID de la carte et du statut du personnage
            $_mapId = $perso->getMapId();
            $_mapStatus = $perso->getMapStatus();
            
            // Requête SQL pour sélectionner le texte en fonction de l'ID de la carte et du statut
            $sql = "SELECT * FROM text WHERE map_id = :mapId AND status_action=:status";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(':mapId', $_mapId, PDO::PARAM_INT);
            $query->bindParam(':status', $_mapStatus, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(); // Récupération du résultat de la requête
            
            // Si un résultat est trouvé, le texte correspondant dans la base de données sera affiché
            if ($result) {
                $text = $result['text'];
            } else {
                // Sinon, ce texte s'affichera
                $text = "Voyons-voir par ici...";
            }

            return $text; // Retourne le texte
        }
    }
?>

<!-- Firstpersontext.class.php -->