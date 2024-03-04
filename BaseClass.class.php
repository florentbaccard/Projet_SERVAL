<?php

    class BaseClass {

        // Coordonnée X Sur La Map
        protected $_currentX;
        // Coordonnée Y Sur La Map
        protected $_currentY;
        // Angle De Vue
        protected $_currentAngle;
        // Orientation De La Boussole
        protected $_currentCompass;
        // Identifiant De La Position Sur La Map
        protected $_mapId;
        // Statut De La Map
        protected $_mapStatus;
        // Connexion A La Base De Donnée
        protected $dbh;

        // Constructeur Avec Les Valeurs De Départ De Marie Et Accès À La Base De Donnée
        public function __construct() {
            $this->dbh = new Database();
            $this->_currentX = 0;
            $this->_currentY = 1;
            $this->_currentAngle = 0;
            $this->_mapStatus = 0;
            $this->_currentCompass = '';
        }

        // MAJ De La Position X
        public function setCurrentX(int $_currentX) {
            $this->_currentX = $_currentX;
        }

        // Affichage De La Position X
        public function getCurrentX() {
            return $this->_currentX;
        }

        // MAJ De La Position Y
        public function setCurrentY(int $_currentY) {
            $this->_currentY = $_currentY;
        }

        // Affichage De La Position Y
        public function getCurrentY() {
            return $this->_currentY;
        }

        // MAJ De L'Angle De Vue
        public function setCurrentAngle(int $_currentAngle) {
            $this->_currentAngle = $_currentAngle;
            return $_currentAngle;
        }

        // Affichage De L'Angle De Vue
        public function getCurrentAngle() {
            return $this->_currentAngle;
        }

        // Vérification De Déplacement Vers Une Position
        private function _checkMove(int $newX, int $newY, int $_currentAngle) {
            $sql = "SELECT id FROM map WHERE coordx=:coordx AND coordy=:coordy AND direction=:direction";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(':coordx', $newX, PDO::PARAM_INT);
            $query->bindParam(':coordy', $newY, PDO::PARAM_INT);
            $query->bindParam(':direction', $_currentAngle, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetchAll();

            if (!empty($result)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        // Vérification De Déplacement Vers L'Avant
        public function checkForward() {
            $newX = $this->_currentX;
            $newY = $this->_currentY;
            switch ($this->_currentAngle) {
                case 0:
                    $newX++;
                    break;

                case 90:
                    $newY++;
                    break;

                case 180:
                    $newX--;
                    break;

                case 270:
                    $newY--;
                    break;

                default:
                    break;
            }
            return $this->_checkMove($newX, $newY, $this->_currentAngle);
        }

        // Vérification De Déplacement Vers L'Arrière
        public function checkBack() {
            $newX = $this->_currentX;
            $newY = $this->_currentY;
            switch ($this->_currentAngle) {
                case 0:
                    $newX--;
                    break;

                case 90:
                    $newY--;
                    break;

                case 180:
                    $newX++;
                    break;

                case 270:
                    $newY++;
                    break;

                default:
                    break;
            }

            return $this->_checkMove($newX, $newY, $this->_currentAngle);
        }

        // Vérification De Déplacement Vers La Droite
        public function checkRight() {
            $newX = $this->_currentX;
            $newY = $this->_currentY;
            switch ($this->_currentAngle) {
                case 0:
                    $newY--;
                    break;

                case 90:
                    $newX++;
                    break;

                case 180:
                    $newY++;
                    break;

                case 270:
                    $newX--;
                    break;

                default:
                    break;
            }

            return $this->_checkMove($newX, $newY, $this->_currentAngle);
        }

        // Vérification De Déplacement Vers La Gauche
        public function checkLeft() {
            $newX = $this->_currentX;
            $newY = $this->_currentY;
            switch ($this->_currentAngle) {
                case 0:
                    $newY++;
                    break;

                case 90:
                    $newX--;
                    break;

                case 180:
                    $newY--;
                    break;

                case 270:
                    $newX++;
                    break;

                default:
                    break;
            }
            return $this->_checkMove($newX, $newY, $this->_currentAngle);
        }

        // Éffectue Le Déplacement En Avant
        public function goForward() {
            switch ($this->_currentAngle) {
                case 0:
                    $this->_currentX++;
                    break;

                case 90:
                    $this->_currentY++;
                    break;

                case 180:
                    $this->_currentX--;
                    break;

                case 270:
                    $this->_currentY--;
                    break;

                default:
                    break;
            }
        }

        // Éffectue Le Déplacement En Arrière
        public function goBack() {
            switch ($this->_currentAngle) {
                case 0:
                    $this->_currentX--;
                    break;

                case 90:
                    $this->_currentY--;
                    break;

                case 180:
                    $this->_currentX++;
                    break;

                case 270:
                    $this->_currentY++;
                    break;

                default:
                    break;
            }
        }

        // Éffectue Le Déplacement À Droite
        public function goRight() {
            switch ($this->_currentAngle) {
                case 0:
                    $this->_currentY--;
                    break;

                case 90:
                    $this->_currentX++;
                    break;

                case 180:
                    $this->_currentY++;
                    break;

                case 270:
                    $this->_currentX--;
                    break;

                default:
                    break;
            }
        }

        // Éffectue Le Déplacement À Gauche
        public function goLeft() {
            switch ($this->_currentAngle) {
                case 0:
                    $this->_currentY++;
                    break;

                case 90:
                    $this->_currentX--;
                    break;

                case 180:
                    $this->_currentY--;
                    break;

                case 270:
                    $this->_currentX++;
                    break;

                default:
                    break;
            }
        }

        // Tourne Sur La Droite
        public function turnRight() {
            switch ($this->_currentAngle) {
                case 0:
                    $this->_currentAngle = 270;
                    break;

                case 90:
                    $this->_currentAngle = 0;
                    break;

                case 180:
                    $this->_currentAngle = 90;
                    break;

                case 270:
                    $this->_currentAngle = 180;
                    break;

                default:
                    break;
            }
        }

        // Tourne Sur La Gauche
        public function turnLeft() {
            switch ($this->_currentAngle) {
                case 0:
                    $this->_currentAngle = 90;
                    break;

                case 90:
                    $this->_currentAngle = 180;
                    break;

                case 180:
                    $this->_currentAngle = 270;
                    break;

                case 270:
                    $this->_currentAngle = 0;
                    break;

                default:
                    break;
            }
        }

        // Renvoie L'Id De Map Correspondant Aux Coordonnées X, Y Et Angle De Vue
        public function getMapId() {

            $_currentX = $this->_currentX;
            $_currentY = $this->_currentY;
            $_currentAngle = $this->_currentAngle;

            $sql = "SELECT id FROM map WHERE coordx=:coordx AND coordy=:coordy AND direction=:direction";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(':coordx', $_currentX, PDO::PARAM_INT);
            $query->bindParam(':coordy', $_currentY, PDO::PARAM_INT);
            $query->bindParam(':direction', $_currentAngle, PDO::PARAM_INT);

            $query->execute();
            $result = $query->fetch();

            $_mapId = $result['id'];

            return $this->_mapId = $_mapId;
        }

        // MAJ Le Statut De La Map
        public function setMapStatus(int $_mapStatus) {
            $this->_mapStatus = $_mapStatus;
            return $_mapStatus;
        }

        // Renvoie Le Statut De La Map
        public function getMapStatus() {
            $_mapId = $this->getMapId();

            // Renvoie Un Résultat Si Un Id De Map Est Le Même Que Le Map_id D'Une Action
            $sql = "SELECT * FROM action WHERE map_id = :mapId";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(':mapId', $_mapId, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch();

            // Si Un Résultat Est Trouvé
            if ($result) {
                // Le Statut De La Map Correspond Au Statut De L'Action (0 Si L'Action N'À Pas Encore Été Éffecuté, 1 Sinon)
                $_mapStatus = $result['status'];
            } else {
                // Si Aucun Résultat N'Est Trouvé, Le Statut De La Map Sera Égale à 0
                $_mapStatus = 0;
            }

            return $this->_mapStatus = $_mapStatus;
        }
    }
?>

<!-- Baseclass.class.php -->