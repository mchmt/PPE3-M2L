<?php 
	// Varriable de connexion
	$bddHost = "localhost";
	$bddUser = "michael7_admin";
	$bddPassword = "2gg9578";
	$table ="michael7_gstProjet";

	// ================ 
	// Connexion BDD
	// ================
	function toConnectDb ($host, $login, $password) {
		$db = mysql_connect($host, $login, $password);
		
		if ($db == '') {
			echo "<div class='error'>Erreur de connexion à la base de donnée</div>";
		}
		else {
			return $db;
		}
	}
	
	// ================ 
	// Selection Table
	// ================
	function toSelectTable ($nomTable) {
		$result = mysql_select_db($nomTable);
		
		if ($result) {
			echo "";
		}
		else {
			echo '<div class="error">Problème de séléction de la table</div>';
		}
	}
	
	// ==========================
	// Verifcation login/password
	// ==========================
	function toVerifConnect () {
		$user = htmlspecialchars($_POST["login"]);
		$password = htmlspecialchars($_POST["password"]);	
		
		$result = mysql_query("SELECT * FROM user where login = '".$user."' ");
	
		if ($result) {
			$read = mysql_fetch_array($result);
			if ($read["login"] == $user AND $read["password"] == $password) {
				$_SESSION["connected"] = 1;
				$_SESSION["idUser"] = $read["id"] ;
				$_SESSION["nom"] = $read["nom"] ;
				$_SESSION["prenom"] = $read["prenom"] ;
				$_SESSION["login"] = $read["login"];
				$_SESSION["email"] = $read["email"];
				header('Location: selectGroup.php');
				exit;
			}
			else {
				$error = "Login ou Mot de passe incorect";
			}
		} 
		else {
			$error = "Erreur SQL";
		}
		
		if (isset($error)) {
			echo '<div class="error">';
			echo $error; 
			echo '</div>';
		}
	}
	// ==========================
	// Inscription
	// ==========================
	function toConfirmRegistration () {
		$code = "345612";
		$inscriptionNom = $_POST["inscriptionNom"];
		$inscriptionPrenom = $_POST["inscriptionPrenom"];
		$inscriptionLogin = $_POST["inscriptionLogin"];
		$inscriptionEmail = $_POST["inscriptionEmail"];
		$inscriptionPassword = $_POST["inscriptionPassword"];
		$inscriptionConfirm = $_POST["inscriptionConfirm"];
		$inscriptionCode = $_POST["inscriptionCode"];

		if ($inscriptionCode == $code) {
			if ($inscriptionPassword == $inscriptionConfirm) {
				$result = mysql_query("SELECT * FROM user WHERE login = '".$inscriptionLogin."' ");
				$read = mysql_fetch_array($result);
				if ($inscriptionLogin == $read["login"]) {
					$error = "Le login est déjà utilisé";
				}
				else {
					$result = mysql_query("INSERT INTO user(login, password, email, nom, prenom) VALUES('".$inscriptionLogin."', '".$inscriptionPassword."', '".$inscriptionEmail."', '".$inscriptionNom."', '".$inscriptionPrenom."') ");
					$success =  "Inscription reussi, vous pouvez à présent vous connecter";
				}
			}
			else {
				$error = "Les mots de passes de corespondent pas.";
			}
		}
		else {
			$error = "Le code est incorrect";
		}
		
		if (isset($error)) {
			echo '<div class="error">';
			echo $error; 
			echo '</div>';
		}
		if (isset($success)) {
			echo '<div class="success">';
			echo $success; 
			echo '</div>';
		}
		
	} 
	// ==========================
	// Invitation
	// ==========================
	function toInvit($email) {
		$verifEmail = mysql_query("SELECT * FROM user WHERE email = '".$email."' ");
		if ($verifEmail) {
			$readVerifEmail = mysql_fetch_array($verifEmail);
			$idMembre = $readVerifEmail[id];
			
			if ($readVerifEmail[email] == $email) {
				$verfiSiMembreGroupe = mysql_query("SELECT * FROM groupesUsers WHERE idGroupes = '".$_SESSION["idGroupe"]."' ");
				$readVerfiSiMembreGroupe = mysql_fetch_array($verfiSiMembreGroupe);

				if ($readVerfiSiMembreGroupe["idUsers"] == $idMembre) {
					echo "<div class='messageInfoInvitNon'>";
					echo "Ce membre fais déjà partie de ce groupe";
					echo "</div>";
					
				}
				else {
					$invitGroupe = mysql_query("INSERT INTO invitation(idUser, idGroupes) VALUES('".$idMembre."', '".$_SESSION["idGroupe"]."')");
					
					echo "<div class='messageInfoInvitOui'>";
					echo "Envoyé";
					echo "</div>";	
				}
				
			}
			else {
				echo "<div class='messageInfoInvitNon'>";
					echo "Email incorect";
				echo "</div>";
				
			}
			
		}
		else {
			echo "marche pas";
		}
	}
	// ==========================
	// Vérification notification
	// ==========================
	function toVerfiNotif() {
		$verifInvit = mysql_query("SELECT * FROM invitation WHERE idUser = '".$_SESSION["idUser"]."' ");
		while ($ReadVerifInvit = mysql_fetch_array($verifInvit)) {
			$afficheGroupe = mysql_query("SELECT * FROM groupes WHERE idGroupes = '".$ReadVerifInvit["idGroupes"]."' ");
			$readAfficheGroupe = mysql_fetch_array($afficheGroupe);
			
			echo "<label>".$readAfficheGroupe["nomGroupes"]."</label>";
			echo "<a href='selectGroup.php?idInvit=".$ReadVerifInvit["idInvitation"]."&answer=oui&idGroupe=".$ReadVerifInvit["idGroupes"]."'>Accepter</a>"; 
			echo " ";
			echo "<a href=''>Refuser</a><br />";
		}
	}
?>