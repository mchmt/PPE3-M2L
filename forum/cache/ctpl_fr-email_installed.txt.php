<?php if (!defined('IN_PHPBB')) exit; ?>Subject: phpBB a été installé

Félicitations,

Vous avez correctement installé phpBB sur votre serveur.

Ce courriel contient des informations importantes concernant votre installation et devrait être conservé précieusement. Votre mot de passe a été stocké en toute sécurité dans notre base de données et ne pourra pas être retrouvé. Dans le cas où vous l’oubliez, vous pourrez le réinitialiser en utilisant l’adresse de courrier électronique associée à votre compte.

----------------------------
Nom d’utilisateur : <?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?>


Lien du forum : <?php echo (isset($this->_rootref['U_BOARD'])) ? $this->_rootref['U_BOARD'] : ''; ?>

----------------------------

Des informations utiles concernant le logiciel phpBB peuvent être trouvées dans le dossier « docs » de votre installation, sur la page de support du site officiel (http://www.phpbb.com/support/) ou sur sa communauté francophone (http://www.phpbb.fr/).

Afin de garantir la sécurité de votre forum, nous vous recommandons fortement de toujours détenir la dernière version du logiciel. Pour votre confort, une liste de diffusion est disponible à la page référencée ci-dessus.

<?php echo (isset($this->_rootref['EMAIL_SIG'])) ? $this->_rootref['EMAIL_SIG'] : ''; ?>