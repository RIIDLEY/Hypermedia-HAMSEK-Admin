<?php
require('view_begin.php');
?>

<h1>Connexion</h1>


<form action = "?controller=login&action=login" method="post">
    <p> <label> Identifiant: <input type="text" name="login"/> </label> </p>
    <p> <label> Mot de passe: <input type="password" name="mdp"/> </label></p>
    <input type="submit" value="Se connecter"/>
    <input type="reset" value="Reset"> 
</form>
<br>
<a href="?controller=register">New admin</a>

<?php
require('view_end.php');
?>
