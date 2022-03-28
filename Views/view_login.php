<?php
require('view_begin.php');
?>
<center>
<h1>Connexion</h1>


<form action = "?controller=login&action=login" method="post">
    <p> <label> Identifiant: <input type="text" name="login"/> </label> </p>
    <p> <label> Mot de passe: <input type="password" name="mdp"/> </label></p>
    <input type="submit" value="Se connecter"/>
    <input type="reset" value="Reset"> 
</form>
<br>
<button onclick="location.href='?controller=register&action=home'" type="button">Page de création de compte</button>
<button onclick="location.href='?controller=home&action=home'" type="button">Page d'accueil</button>
</center>
<?php
require('view_end.php');
?>
