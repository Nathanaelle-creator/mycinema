<?php
//Me connecter à ma base de donner 
$databases = new PDO('mysql:host=127.0.0.1;dbname=cinema;', 'nathanaelle', 'latouche09');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'abonner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="cherchecompteclient">
        <h3> Gestion des abonnements</h3>
        <br>
        <table>
            <tr>
                <th>N°</th>
                <th>Name</th>
                <th>Description</th>
                <th> Price </th>
                <th>Duration</th>
                <th>Reduction</th>
            </tr>
            <tr>
                <td>1</td>
                <td>VIP</td>
                <td>Le mois tout compris</td>
                <td>60</td>
                <td>30</td>
                <td>50</td>
            </tr>
            <tr>
                <td>2</td>
                <td>GOLD</td>
                <td>L'annee complete </td>
                <td>500</td>
                <td>365</td>
                <td>60</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Classic</td>
                <td>Abonnement mensuel classique</td>
                <td>40</td>
                <td>30</td>
                <td>10</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Pass Day</td>
                <td>Pass valable une journee </td>
                <td>15</td>
                <td>1</td>
                <td>10</td>
            </tr>
        </table>
        <br>
    </section>

    <section id="S'abonner">
        <h3>S'abonner</h3>
        <form action="gerer_abonnement.php?" method="POST">
            <select name="s_abonner">
                <option value="-">-</option>
                <option value="1">VIP</option>
                <option value="2">GOLD</option>
                <option value="3">Classic</option>
                <option value="4">Pass Day</option>
            </select>
            <input type="submit" value="s'abonner" class="bouton" name="boutonA">
        </form>
        <?php
        session_start();
        // Regarder si id_client est passé dans l'URL
        if (isset($_GET['id_client'])) {
            // Récupérer id_client depuis l'URL
            $id_user = htmlspecialchars($_GET['id_client']);
            // Stocker id_user dans la session pour une utilisation ultérieure
            $_SESSION['id_client'] = $id_user;
        }
        if (isset($_POST["boutonA"])) {
            $idsubscription = htmlspecialchars($_POST["s_abonner"]);
            $id_user = $_SESSION['id_client'];
            //Preparer notre requete
            $requete11 = "INSERT INTO `membership`(id_user,id_subscription) VALUES (?,?)";
            $statement11 = $databases->prepare($requete11);
            $result = $statement11->execute([$id_user, $idsubscription]);
            // Vérifier si l'insertion a réussi
            if ($result) {
                echo "L'abonnement a été ajouté avec succès.";
            } else {
                echo "Une erreur est survenue lors de l'insertion.";
            }
        }
        ?>
    </section>
    <section id="Modifier">
        <h3>Modifier l'abonnement</h3>
        <form action="gerer_abonnement.php?" method="POST">
            <select name="modifier_sub">
                <option value="-">-</option>
                <option value="1">VIP</option>
                <option value="2">GOLD</option>
                <option value="3">Classic</option>
                <option value="4">Pass Day</option>
            </select>
            <input type="submit" value="Modifier l'abonnement" class="bouton" name="bouton_modification">

        </form>
        <?php
        // Regarder si id_client est passé dans l'URL
        if (isset($_GET['id_client'])) {
            // Récupérer id_client depuis l'URL
            $id_user = htmlspecialchars($_GET['id_client']);
            // Stocker id_user dans la session pour une utilisation ultérieure
            $_SESSION['id_client'] = $id_user;
        }
        if (isset($_POST["bouton_modification"])) {
            $modifsub= htmlspecialchars($_POST["modifier_sub"]);
            $id_userM = $_SESSION['id_client'];
            //Preparer notre requete
            $requete12 = "UPDATE membership set id_subscription=$modifsub WHERE id_user=$id_userM";
            $statement12 = $databases->prepare($requete12);
            $Succesmodif = $statement12->execute();
            // Vérifier si l'insertion a réussi
            if ($Succesmodif) {
                echo "L'abonnement a été modifier avec succès.";
            } else {
                echo "Une erreur est survenue lors de l'insertion.";
            }
        }
        ?>
    </section>
    <section id="Supprimerr">
        <h3>Supprimer l'abonnement</h3>
        <form action="gerer_abonnement.php?" method="POST">
            <input type="submit" value="Supprimer l'abonnement" class="bouton" name="bouton_supprimer">

        </form>
        <?php
        // Regarder si id_client est passé dans l'URL
        if (isset($_GET['id_client'])) {
            // Récupérer id_client depuis l'URL
            $id_user = htmlspecialchars($_GET['id_client']);
            // Stocker id_user dans la session pour une utilisation ultérieure
            $_SESSION['id_client'] = $id_user;
        }
        if (isset($_POST["bouton_supprimer"])) {
        // $supprimersub= htmlspecialchars($_POST["supprimer_sub"]);
            $id_userM = $_SESSION['id_client'];

            $requete13 = "DELETE FROM membership WHERE id_user= $id_userM";
            $statement13 = $databases->prepare($requete13);
            $Successupp = $statement13->execute();
            // Vérifier si l'insertion a réussi
            if ($Successupp) {
                echo "L'abonnement a été supprimer avec succès.";
            } else {
                echo "Une erreur est survenue lors de l'insertion.";
            }
        }
        ?>
    </section>
    <?php
    ?>



</body>
</html>