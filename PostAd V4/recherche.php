<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PostAd.com</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

<?php ?>
<div class="container">

    <header>
        <?php include("header.php"); ?>
    </header>


    <nav>
        <?php include("menu.php"); ?>
    </nav>

    <div id="affichage2">
        <form action="" type="get" id=rech>
            <input type="text" id="search" placeholder="Mots clés" name="recherche">
            <input type="submit" id="loupe" value="Rechercher . . .">
        </form>

        <div id="affpostit2">
            <table>
                <tr>
                    <?php 
                        // Connexion à la base de données
                        try
                        {
                            $cnx = new PDO('mysql:host=localhost;dbname=postit;charset=utf8', 'root', '');
                        }
                        catch(Exception $e)
                        {
                                die('Erreur : '.$e->getMessage());
                        }
                        if (isset($_GET['recherche'])) {
                        // Récupération des post par ordre du plus recent
                        $recher = "%".$_GET['recherche']."%";
                        $requete="SELECT id_Postit , titre_Postit FROM postit WHERE titre_postit LIKE '$recher' ORDER BY id_Postit DESC";
                        } else {
                            $requete="SELECT id_Postit , titre_Postit FROM postit ORDER BY id_Postit DESC";
                        }
                        $res = $cnx->query($requete);
                        
                        
                        // Affichage de chaque postit
                        while ($row = $res->fetch())
                        {
                            echo '<th><a class=lien href=recherche.php?param='.$row[0].'><strong>' . htmlspecialchars($row['titre_Postit']) . '</strong></a></th>';
                        }
                    ?>
                </tr>
            </table>
        </div>
    <?php 
        // Connexion à la base de données
        try
        {
            $cnx2 = new PDO('mysql:host=localhost;dbname=postit;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }

        //page
        if (isset($_GET['param'])){
        $requete2="SELECT titre_Postit,contenu_Postit from postit where id_Postit =".$_GET['param'].";";
        $res2=$cnx2->query($requete2);
        while ($row2 = $res2->fetch())
        {
            echo '<h1><center>'.$row2['titre_Postit'].'</center></h1><br>'.$row2['contenu_Postit'].'<br>';
        }}
    ?>
    </div>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</div>
</body>
</html>