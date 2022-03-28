<?php

class Model
{


    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;


    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;


    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {

        try {
            include 'Utils/credentials.php';
            $this->bd = new PDO($dsn, $login, $mdp);
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bd->query("SET nameS 'utf8'");
        } catch (PDOException $e) {
            die('Echec connexion, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }


    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {

        if (is_null(self::$instance)) {
            self::$instance = new Model();
        }
        return self::$instance;
    }

    public function getNbData()//recupere le nombre de données present sur la DB
    {

        try {
            $req = $this->bd->prepare('SELECT COUNT(*) FROM fichiers_upload');
            $req->execute();
            $tab = $req->fetch(PDO::FETCH_NUM);
            return $tab[0];
        } catch (PDOException $e) {
            die('Echec getNbData, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }

    public function getDataPage($numeropage)//recupere les données en fonction du numéro de page mis en parametre
    {
        $debut = ($numeropage-1)*4;
        try {
            $req = $this->bd->prepare('SELECT * FROM fichiers_upload ORDER BY id DESC LIMIT :debut,4');
            $req->bindValue(':debut', $debut, PDO::PARAM_INT);
            $req->execute();
            return $req->fetchall();
        } catch (PDOException $e) {
            die('Echec getDataPage, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }

    public function addNewFile($infos)//ajoute un fichier à la base de données
    {

        try {
            //Préparation de la requête
            $requete = $this->bd->prepare('INSERT INTO fichiers_upload (name, filename, type, size) VALUES (:name, :filename, :type, :size)');

            //Remplacement des marqueurs de place par les valeurs
            $marqueurs = ['name', 'filename', 'type', 'size'];
            foreach ($marqueurs as $value) {
                $requete->bindValue(':' . $value, $infos[$value]);
            }

            //Exécution de la requête
            return $requete->execute();
        } catch (PDOException $e) {
            die('Echec addNewFile, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
        
    }


    public function getFile($id)//recupere les données en fonction du numéro de page mis en parametre
    {
        try {
            $req = $this->bd->prepare('SELECT filename FROM fichiers_upload WHERE id = :id');
            $req->bindValue(':id', intval($id), PDO::PARAM_INT);
            $req->execute();
            return $req->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Echec getFile, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }

    public function removeFile($id)
    {
        $requete = $this->bd->prepare("DELETE FROM fichiers_upload WHERE id = :id");
        $requete->bindValue(':id', intval($id), PDO::PARAM_INT);
        return $requete->execute();
    }

    public function VerifInDB($filename){//verifie si l'image est deja présente sur la BDD
        $EstDansLaDB = false;
        try {
            $req = $this->bd->prepare('SELECT * FROM fichiers_upload WHERE filename = :filename');
            $req->bindValue(':filename', $filename);
            $req->execute();
            $resultat = $req->fetchall();

            if(!empty($resultat)){
                $EstDansLaDB = true;
            }
            return $EstDansLaDB;
        } catch (PDOException $e) {
            die('Echec VerifInDB, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }  
    }

    public static function addLogin($infos)
    {
        $m = Model::getModel();
        try { 
            //Préparation de la requête
            $requete = $m->bd->prepare('INSERT INTO user_list_HAMSEK (login, mdp) VALUES (:login, :mdp)');
            //Remplacement des marqueurs de place par les valeurs
            $marqueurs = ['login', 'mdp'];
            foreach ($marqueurs as $value) {
                $requete->bindValue(':' . $value, $infos[$value]);
            }
            //Exécution de la requête
            return $requete->execute();
        } catch (PDOException $e) {
            die('Echec addLogin, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }


    /**
     * Méthode permettant d'obtenir le nom des utilisateurs
     */
    public function getLogin()
    {

        try {
            $requete = $this->bd->prepare('SELECT login FROM user_list_HAMSEK');
            $requete->execute();
            $reponse = [];
            while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
                $reponse[] = $ligne['login'];
            }
            return $reponse;
        } catch (PDOException $e) {
            die('Echec getLogin, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }

    /**
     * Méthode permettant d'obtenir le nombre d'utilisateur
     */
    public function getNbLogin()
    {
        try {
            $requete = $this->bd->prepare('SELECT count(*) FROM user_list_HAMSEK');
            $requete->execute();
            return $requete->fetch(PDO::FETCH_NUM);
        } catch (PDOException $e) {
            die('Echec getNbLogin, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }


      /**
     * Méthode permettant d'obtenir le mot de passe de l'utilisateur hashé
     */
    public function getMDP($user)
    {
        try {
            $requete = $this->bd->prepare('SELECT mdp FROM user_list_HAMSEK WHERE login = :user');
            $requete->bindValue(':user', $user);
            $requete->execute();
            return $requete->fetch(PDO::FETCH_NUM);
        } catch (PDOException $e) {
            die('Echec getMDP, erreur n°' . $e->getCode() . ':' . $e->getMessage());
        }
    }
}
