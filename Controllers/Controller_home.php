<?php

class Controller_home extends Controller{

  public function action_default(){//fonction appele par defaut
    header('location:?controller=home&action=changePage&page=1');//set les parametres dans l'URL
    //$this->action_changePage();//appel la fonction action_changePage
  }

  public function action_changePage(){
    $m = Model::getModel();//recupere le modele (la base de données)
    $tab = ['tab' => $m->getDataPage($_GET['page']),'nbdata' => $m->getNbData()];//utilise les fonctions sur modele et mets les données dans un tableau
    $this->render('home',$tab);//envoie du tableau avec les données dans la Vue
  }
  
  public function action_upload(){
    $maxsize = 2097152;
    
    if(!empty($_FILES['fichier']))//s'il y'a un fichier en parametre
    {
      $tmp_nom = $_FILES['fichier']['tmp_name'];
      $name = $_FILES['fichier']['name'];
      $tmp = explode(".", $name);
      $type = end($tmp);
      $extensionValide = array("png", "jpg", "jpeg", "gif", "jfif");//extensions autorisées

      if (in_array($type,$extensionValide)) {//Si l'extension est valide

        if(($_FILES['fichier']['size'] >= $maxsize) || ($_FILES["fichier"]["size"] == 0)) {// si la taille du fichier est superieur à 2MB
          echo('<script type="text/javascript">alert("Le fichier est trop gros (> 2MB)")</script>');
          echo("<script>window.location = 'index.php';</script>");
        }else{//Si la taille du fichier est correct
          $m = Model::getModel();//recupere le modele (la base de données) 
          $verifDB = $m->VerifInDB($name);//retourne si l'image est dans la DB ou non
          if ($verifDB==false) {//S'il n'est pas dans la DB
            if (move_uploaded_file($tmp_nom, 'Upload/'.$name)){//ajoute le fichier au dossier de stockage du serveur
               $info = ['name'=>(explode(".", $name))[0],'filename'=>$name,'type'=>$type,'size'=>intval($_FILES["fichier"]["size"])];
               $m->addNewFile($info);//ajoute le fichier à la BDD
               echo '<script type="text/javascript">alert("Le fichier a bien été upload")</script>';//met une pop up
               echo("<script>window.location = 'index.php';</script>");
             }else {//S'il n'as pa reussi à l'ajouter dans le dossier stockage du serveur
               echo '<script type="text/javascript">alert("Une erreur est survenue lors de l\'upload")</script>';//met une pop up
               echo("<script>window.location = 'index.php';</script>");
             }
          }
          if ($verifDB==true){//S'il est deja dans la DB
            echo '<script type="text/javascript">alert("Le document est deja present sur la plateforme")</script>';//met une pop up
            echo("<script>window.location = 'index.php';</script>");
          }

        }
      }else {//Si l'extension n'est pas valide
        echo '<script type="text/javascript">alert("Ce type de fichier n\'est pas accepté. Seulement les jpeg, jpg, png et gif sont autorisé")</script>';//met une pop up
        echo("<script>window.location = 'index.php';</script>");
      }
    }
  }

  public function action_lectureFolder(){
    $path= "docs";
    $this->explorerDir($path);//Appel la fonction
    echo '<script type="text/javascript">alert("Le dossier a bien été scanné")</script>';//met une pop up qui finalisé le scan
    echo("<script>window.location = 'index.php';</script>");
  }

  function explorerDir($path){
    $extensionValide = array("png", "jpg", "jpeg", "gif", "jfif");//extensions autorisées
    $folder = opendir($path);
    while($entree = readdir($folder))//Tant qu'on peut lire dans le dossier courant
    {		
      if($entree != "." && $entree != "..")//Si ce que la fonction readdir trouve n'est pas ".." et "."
      {
        
        if(is_dir($path."/".$entree))//Si c'est un dossier
        {
          $sav_path = $path;//Met le chemin courant dans une variable
          $path .= "/".$entree;//Met le chemin du dossier qu'il a trouvé dans une variable 		
          $this->explorerDir($path);//Fait un appel récursive (appel à lui meme) avec le nouveau chemin. (Explore le dossier trouvé)
          $path = $sav_path;//Met l'ancien chemin courant afin de continué à le parcourir
        }
        else
        {
          $path_source = $path."/".$entree;//	Variable contenant le chemin vers le fichier trouvé			
          
          $tmp = explode(".", $path_source);
      		$type = end($tmp);//recupere l'extension du fichier courant
          $size = filesize($path_source);//recupere la taille du fichier courant
				  if (in_array($type,$extensionValide)){//si c'est une image
					  $m = Model::getModel();//recupere le modele (la base de données) 
            $verifDB = $m->VerifInDB($entree);//retourne si l'image est dans la DB ou non
            if ($verifDB==false) {//S'il n'est pas dans la DB
              if (copy($path_source, "Upload/".$entree)) {//ajoute le fichier à dossier de stockage du serveur
                 $info = ['name'=>(explode(".", $entree))[0],'filename'=>$entree,'type'=>$type,'size'=>$size];
                 $m->addNewFile($info);//ajoute le fichier à la BDD
               }
            }
				  }
        }
      }
    }
    closedir($folder);
  }

  public function action_removefile(){
    $m = Model::getModel();//recupere le modele (la base de données)
    $filename = $m->getFile($_GET['id'])["filename"];
    if (unlink("Upload/".$filename)) {
      $m->removeFile($_GET['id']);
    }
    echo("<script>window.location = 'index.php';</script>");
  }

  public function action_deco(){
    session_start();
    $_SESSION['admin'] = false;
    echo("<script>window.location = 'index.php';</script>");

  }

}

?>