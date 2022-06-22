<?php

define("usrename","PWeb");
define("dsn", "mysql:host=localhost;dbname=PWeb");
define("password","1Zhongguo");

try {
    $dbh = new PDO(dsn,usrename, password);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


    $reponse = $dbh->query('select * from PWeb.Users');
    while ($donnees = $reponse->fetch())
    {
        ?>
        <p>
            <strong>ID est</strong> : <?php echo $donnees['IDUtilisateur']; ?><br />
            nom du l'utilisateur est <?php echo $donnees['NomUtilisateur']; ?><br /><em>
            mot de passe est <?php echo $donnees['MotDePasse']; ?> <br /></em>
        </p>
        <?php

    }
    $reponse->closeCursor(); // Termine le traitement de la requête


