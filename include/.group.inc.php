<?php
	// =====================
	// Création d'un groupe
	// =====================
	function toAddGroup () {
		$userid = $_SESSION["idUser"]; 
		$nomGroupe = $_POST["groupeName"];
		$descriptionGroupe = $_POST["groupeDescription"];
		
		$verifNomGroup = mysql_query("SELECT * FROM groupes WHERE nomGroupes = '".$nomGroupe."' ");
		$read2 = mysql_fetch_array($verifNomGroup);
		
		if ($read2["nomGroupes"] == $nomGroupe) {
			$error = "Ce groupe a déjà été crée par un autre utilisateur.";
		}
		else {
			$addGroupe = mysql_query("INSERT INTO groupes(nomGroupes, descriptionGroupes, idCreateurGroupes) VALUES('".$nomGroupe."', '".$descriptionGroupe."', '".$userid."') ");
			
			if ($addGroupe) {
				$addGroupeUsers = mysql_query("SELECT * FROM groupes WHERE nomGroupes = '".$nomGroupe."' ");
				$read = mysql_fetch_array($addGroupeUsers);
				$idGroupes = $read["idGroupes"];
				$result2 = mysql_query("INSERT INTO groupesUsers(idGroupes, idUsers) VALUES('".$idGroupes."', '".$userid."') ");
			}
			else {
				echo "Problème création groupe";
			}
		}
		
		if (isset($error)) {
			echo '<div class="error">';
			echo $error; 
			echo '</div>';
		}
	}

	// ======================
	// Affichage des groupes
	// ======================
	function toViewGroups () {
		$userid = $_SESSION["idUser"]; 
		
		$result = mysql_query("SELECT * FROM groupesUsers WHERE idUsers = '".$userid."' ");
		$nbGroupes = mysql_num_rows($result);
		
		if ($nbGroupes == 0) {
			echo "Vous n'avez créez ou n'appartenez à aucun groupes.";
		}
		else {
			while ($read = mysql_fetch_array($result)) {
				$result2 = mysql_query("SELECT * FROM groupes WHERE idGroupes = '".$read["idGroupes"]."' ");
				$showGroups = mysql_fetch_array($result2);
				
				echo "<div class='groupe'>";
					echo "<span class='imgGroupe'><img style='' width='72' height='72' src='img/iconGroup.jpg'></span>";
					echo $showGroups["nomGroupes"]."<br />";
					echo "<form method='POST' action=''>";
						echo "<input type='hidden' name='nomGroupes' value='".$showGroups["nomGroupes"]."'>";
						echo "<input type='hidden' name='idGroupe' value='".$read["idGroupes"]."'>";
						echo "<input class='buttonSubmit' type='submit' name='selectGroupe' value='Séléctionner'>";
					echo "</form><br />";
				echo "</div>";
			}
		}
	}
	
	function toAnswerNotif($idGroupe, $answer, $idInvit) {
		$userid = $_SESSION["idUser"]; 
		
		if ($answer == "oui") {
			$ajouterAuGroupe = mysql_query("INSERT INTO groupesUsers(idGroupes, idUsers) VALUES('".$idGroupe."', '".$userid."') ");
			$suprInvit = mysql_query("DELETE FROM invitation WHERE idInvitation = '".$idInvit."' ");
			header('Location: selectGroup.php');
			exit;
		}
	}
?>