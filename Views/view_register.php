<?php
require('view_begin.php');
?>
		<main>
			<center>
			<h1>Nouvelle utilisateur</h1>

			<form action = "?controller=register&action=add" method="post">
				<p> <label> Identifiant: <input type="text" name="login"/> </label> </p>
				<p> <label> Mot de passe: <input type="password" name="mdp"/> </label></p>
				<p> <label> Confirmation mot de passe: <input type="password" name="mdpconf"/></label> </p>
				<p>  <input type="submit" value="Creation"/> </p>
			</form>
			<button onclick="location.href='?controller=login&action=home'" type="button">Page de connexion</button>
			<button onclick="location.href='?controller=home&action=home'" type="button">Page d'accueil</button>
			</center>
<?php
require('view_end.php');
?>
