<?php
session_start();
$_SESSION['admin'] = false;
class Controller_login extends Controller{

  public function action_default(){
    $this->render('login');
  }

  public function action_login(){
    $m = Model::getModel();
    $nbLogin = $m->getNbLogin();//get le nombre d'utilisateur
    $listLogin = $m->getLogin();//get le login de tout les utilisateurs

    for($i=0;$i<$nbLogin[0];$i++){
      if($_POST['login']===$listLogin[$i]){//verifie si le login est dans la BDD
        $mdp_hash = $m->getMdp($listLogin[$i]);
        if(password_verify($_POST['mdp'], $mdp_hash[0])){//verifie si le mot de passe est correct
          $_SESSION['admin'] = true;
          echo '<script type="text/javascript"> alert("Connecté en tant qu\'admin"); </script>';//message de confirmation de bonne connection
          echo("<script>window.location = 'index.php';</script>");
          //$this->render('login');
        }
      }
    }

    echo '<script type="text/javascript"> alert("Login ou mot de passe incorrect"); </script>';
    $this->render("login");
  }

}

?>
