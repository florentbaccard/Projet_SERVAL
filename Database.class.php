<?php
    // Définition de la classe DataBase
    class DataBase extends PDO {
        // Propriétés contenant les informations de connexion à la base de données
        private $_DB_HOST = 'localhost'; // Nom de l'hôte de la base de données
        private $_DB_USER = 'florent';    // Nom d'utilisateur de la base de données
        private $_DB_PASS = '123456789';  // Mot de passe de la base de données
        private $_DB_NAME = 'fpview';     // Nom de la base de données

        // Constructeur de la classe
        public function __construct() {
            try {
                // Appel du constructeur de la classe parente PDO pour établir la connexion à la base de données
                parent::__construct("mysql:host=" . $this->_DB_HOST . ";dbname=" . $this->_DB_NAME, $this->_DB_USER, $this->_DB_PASS);
                
                // Configuration des attributs de PDO pour afficher les erreurs sous forme d'exceptions
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En cas d'échec de la connexion, affichage du message d'erreur et arrêt de l'exécution du script
                exit("Error: " . $e->getMessage());
            }
        }
    }
?>

<!-- Database.class.php -->