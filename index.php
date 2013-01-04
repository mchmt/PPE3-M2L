<?php
	if (!isset($_GET["page"])) {
		$page = "presentation.php";
	}
	else {
		$page = $_GET["page"];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include 'include/head.inc.html'; ?>
		<title>Maison des Ligues de Lorraine</title>
	</head>
	<body>
		<div id="site">
			<div id="banniere"></div>
			<div class="contenu">
				<div class="menu">
					<h3>Maison des ligues de Lorraine</h3><br />
					Logo<br />
					<?php include 'include/menu.html'; ?>
				</div>
				<div class="section">
					<?php include $page; ?>
				</div>
				<div class="menu2">
					<?php include 'include/menu2.html'; ?>
				</div>
			</div>
		</div>
	</body>
</html>