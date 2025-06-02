<?php
//Me connecter à ma base de donner 
$databases = new PDO('mysql:host=127.0.0.1;dbname=cinema;', 'nathanaelle', 'latouche09');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barre de recherche</title>
    <link rel="stylesheet" href="style.css">
</head>
<header class="n">
    <div class="navtitle">
        <div class="title">
            <h1>Bienvenue à la base de gestionnaire de cinema</h1>
        </div>
    </div>
</header>

<body>
    <main>
        <section id="Rechercher_film_distributor">
            <h3> Chercher un film</h3>
            <form action="cinema.php" method="POST">
                <div>Nom du film</div>
                <input type="text" name="film" />
                <input type="submit" value="Chercher un film" />
            </form>
            <?php
            if (isset($_POST['film'])) {
                $film = htmlspecialchars($_POST['film']);
                $requete1 = "SELECT title, director FROM movie  WHERE title LIKE '" . $film . "%'";
                //Preparer notre requete
                $statement1 = $databases->prepare($requete1);
                //Executer la requete
                $statement1->execute();
                $filmname = $statement1->fetchAll();
                if (count($filmname) > 0) {
                    foreach ($filmname as $film) {
                        echo "" . $film['title'] . " le réalisateur du film est  " . htmlspecialchars($film['director']) . "<br>";
                    }
                }
            }
            ?>

            <form action="cinema.php" method="POST">
                <div>Genre</div>
                <select name="genre">
                    <option value="-">-</option>
                    <option value="Action">Action</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Animation">Animation</option>
                    <option value="Biography">Biography</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Crime">Crime</option>
                    <option value="Family">Family</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Horror">Horror</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Romance">Romance</option>
                    <option value="Sci-fi">Sci-Fi</option>
                    <option value="Thriller">Thriller</option>
                </select>
                <input id="cherchefilm" type="submit" name="cherchefilm" value="Chercher un film" />
            </form>
            <?php
            if (isset($_POST['genre'])) {
                $genre = $_POST['genre'];
                $requete2 = "SELECT movie.title, genre.name 
                        from movie INNER JOIN movie_genre ON movie.id = movie_genre.id_movie
                        INNER JOIN genre ON movie_genre.id_genre=genre.id WHERE genre.name LIKE '" . $genre . "%'";
                //Preparer notre requete
                $statement2 = $databases->prepare($requete2);
                //Executer la requete
                $statement2->execute();
                $filmsGenre = $statement2->fetchAll();
                foreach ($filmsGenre as $film) {
                    echo $film['title'] . "<br>";
                       //echo "<pre>";
                        //echo print_r($film);
                        //echo "<pre>";
                }
            }
            ?>
            <form action="cinema.php" method="POST">
                <div>Distributeur</div>
                <select name="distributor">
                    <option value="-">-</option>
                    <option value="DIA Productions GmbH & Co. KG">"DIA" Productions GmbH & Co.KG</option>
                    <option value="1492 Pictures">1492 Pictures</option>
                    <option value="1821 Pictures">1821 Pictures</option>
                    <option value="1984 Private Defense Contractors">1984 Private Defense Contractors</option>
                    <option value="2003 Productions">2003 Productions</option>
                    <option value="2929 Productions">2929 Productions</option>
                    <option value="3 Arts Entertainment">3 Arts Entertainment</option>
                    <option value="3 Miles Apart Productions Ltd.">3 Miles Apart Productions Ltd.</option>
                    <option value="4 Kids Entertainment">4 Kids Entertainment</option>
                    <option value="40 Acres & A Mule Filmworks">40 Acres & A Mule Filmworks</option>
                    <option value="42">42</option>
                    <option value="Aardman Animations">Aardman Animations</option>
                    <option value="Abandon Entertainment">Abandon Entertainment</option>
                    <option value="Abraham Productions">Abraham Productions</option>
                    <option value="Aggregate Films">Aggregate Films</option>
                    <option value="Alcor Films">Alcor Films</option>
                    <option value="Aldamisa Entertainment">Aldamisa Entertainment</option>
                    <option value="Alfama Films">Alfama Films</option>
                    <option value="All Girl Productions">All Girl Productions</option>
                    <option value="Alliance Atlantis Communications">Alliance Atlantis Communications</option>
                    <option value="Allied Stars Ltd.">Allied Stars Ltd.</option>
                    <option value="Allison Shearmur Productions">Allison Shearmur Productions</option>
                    <option value="Amblin Entertainment">Amblin Entertainment</option>
                </select>
                <input id="cherchefilm" type="submit" name="cherchefilm" value="Chercher un film" />
            </form>

            <?php
            if (isset($_POST['distributor'])) {
                $distributor = $_POST['distributor'];
                $requete3 = "SELECT title FROM distributor 
                INNER JOIN movie ON distributor.id = movie.id_distributor  
                WHERE distributor.name LIKE '" . $distributor . "%'";
                //Preparer notre requete
                $statement3 = $databases->prepare($requete3);
                //Executer la requete
                $statement3->execute();
                $filmsDistributor = $statement3->fetchAll(PDO::FETCH_ASSOC);
                foreach ($filmsDistributor as $film) {
                    echo $film['title'] . "<br>";
                }
            }
            ?>
        </section>
        <section id="Rechercher_utlisateur">
            <h3>Chercher un utilisateur</h3>
            <form action="cinema.php" method="POST">
                <div>Nom de l'utilisateur</div>
                <input type="text" name="name" />
                <input type="submit" value="Chercher l'utilisateur" />
            </form>
            <?php
            if (isset($_POST['name'])) {
                $name = htmlspecialchars($_POST['name']);
                 $requete4 = "SELECT * FROM user WHERE firstname LIKE '". $name ."%'";
                //Preparer notre requete
                $statement4 = $databases->prepare($requete4);
                //Executer la requete
                $statement4->execute();
                $utilisateurS = $statement4->fetchAll();
                foreach ($utilisateurS as $utilisateur) {
                    echo "" . $utilisateur['firstname'] . " " . $utilisateur['lastname'] . "<br>";
                }
            }
            ?>
        </section>
        <section id="cherchecompteclient">
            <form action="cinema.php" method="POST">
                <h3>Gestion abonnement d'un client</h3>
                <input type="text" placeholder="Rechercher un utilisateur" name="abonner" />
                <input type="submit" value="Rechercher un utilisateur" />
            </form>

            <?php
            // user memeshir subs
            if (isset($_POST['abonner'])) {
                $abonner = htmlspecialchars($_POST['abonner']);
                $requete5 = "SELECT * FROM user 
            LEFT JOIN membership ON user.id = membership.id_user 
            LEFT JOIN subscription ON  subscription.id = membership.id_subscription  
            WHERE firstname
            LIKE '" . $abonner . "%'"; //Pour avoir les abonnés et le non abonnés
                $statement5 = $databases->prepare($requete5);
                $statement5->execute();
                $data_user_membership = $statement5->fetchAll();
                if (count($data_user_membership) > 0) {
                    foreach ($data_user_membership as $user_membership) {
                        //echo "<pre>";
                        //echo print_r($user_membership);
                        //echo "<pre>";
                    }
                }
            ?>

                <table>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                <?php
                if (count($data_user_membership) > 0) {
                    foreach ($data_user_membership as $user_membership) {
                        echo "<pre>";
                       // echo print_r($user_membership);
                        echo "</pre>";
                        $abonné = false;
                        if ($user_membership["id_subscription"] !== null) { // la clé 11 represente si une personne est abonner ou pas
                            $abonné = true;
                            $status = $user_membership["name"]; //le type abonnement
                        } else {
                            $abonné = false;
                            $status = "non abonné";
                        }
                        
                        if ($abonné) {
                            $btns = "   <a href='gerer_abonnement.php?id_sub=$user_membership[11]&id_client=$user_membership[0]'>
                                            <button>modifier abonnement</button>
                                        </a>
                                        <a href='gerer_abonnement.php?id_sub=$user_membership[11]&id_client=$user_membership[0]&suppression'>
                                            <button>supprimer abonnement</button>
                                        </a>
                                        ";
                        } else {
                            $btns = "<a href='gerer_abonnement.php?id_client=$user_membership[0]'>
                                        <button>s'abonner</button>
                                    </a>";
                        }
                        echo "
                            <tr class='$status'> 
                                <td>$user_membership[2]</td>
                                <td>$user_membership[3]</td>
                                <td>$user_membership[1]</td>
                                <td>$status</td>
                                <td>
                                    $btns
                                </td>
                            </tr>
                            ";
                    }
                }
            }
                ?>
                </table>
                <br>
        </section>
        <section id="cherchecompteclient" id="historique">
            <form action="cinema.php" method="POST">
                <h3>Historique</h3>
                <input type="text" placeholder="nom de l'utilisateur" name="historique" />
                <input type="submit" value="Chercher l'historique" />
            </form>
            <br>
            <?php
            if (isset($_POST['historique'])) {
                $vue = htmlspecialchars($_POST['historique']);
                $requete6 = "SELECT user.firstname,user.lastname, movie.title, DATE_FORMAT(movie_schedule.date_begin,'%d/%m/%Y')
            FROM membership_log 
            INNER JOIN membership ON membership_log.id_membership=membership.id 
            INNER JOIN movie_schedule ON membership_log.id_session=movie_schedule.id 
            INNER JOIN movie ON movie.id = movie_schedule.id_movie
            INNER JOIN user ON membership.id_user=user.id
            WHERE firstname 
            LIKE '" . $vue . "%'";
                //Preparer notre requete
                $statement6 = $databases->prepare($requete6);
                //Executer la requete
                $statement6->execute();
                $toto = $statement6->fetchAll();
                foreach ($toto as $vue) {
                    // echo "<pre>";
                    // echo print_r($vue);
                    // echo "<pre>";
                }
            }
            ?>
            <table>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Film vue</th>
                <th>Date</th>
                <?php
                if (isset($_POST["historique"])) {
                    foreach ($toto as $vue) {
                        echo "
                    <tr> 
                        <td>$vue[0]</td>
                        <td>$vue[1]</td>
                        <td>$vue[2]</td>
                        <td>$vue[3]</td>
                    </tr>";
                    }
                }
                ?>
            </table>
        </section>
        <br>
        <section id="date_projection">
            <form action="cinema.php" method="POST">
                <div>Date de projection</div>
                <input type="date" name="horaire" />
                <input type="submit" value="Chercher la date de diffusion" />
            </form>
            <?php
            if (isset($_POST['horaire'])) {
                $date = htmlspecialchars($_POST['horaire']);
                $requete7 = "SELECT movie_schedule.date_begin,movie.title FROM movie_schedule 
                INNER JOIN movie ON movie_schedule.id_movie=movie.id 
                WHERE movie_schedule.date_begin LIKE '" . $date . "%' LIMIT 3";
                //Preparer notre requete
                $statement7 = $databases->prepare($requete7);
                //Executer la requete
                $statement7->execute();
                $dates = $statement7->fetchAll();
                foreach ($dates as $date) {
                    echo "" . $date['title'] . " la date de projection  " . htmlspecialchars($date['date_begin']) . "<br>";
                }
            }
            ?>
            </form>
        </section>


        <?php
$sql14 = "SELECT * FROM movie";
$statement14 = $databases->prepare($sql14);
//Executer la requete
$statement14->execute();
$data14 = $statement14->fetchAll();

            $sql15 = "SELECT * FROM room";
            $statement15 = $databases->prepare($sql15);
            //Executer la requete
            $statement15->execute();
            $data15 = $statement15->fetchAll();
            
        ?>
        <section id="programmer_séance">
            <h3>Ajouter une séance pour un film </h3>
            <form action="cinema.php" method="POST">
            <option value="">Sélectionnez un film</option> 
                <select name="ajout_seance_film">
                    <?php
                        foreach ($data14 as $film) {
                            $selected14 = 'selected';
                        echo "<option   value='$film[0]'>$film[2]</option>";
                        }
                    
                    ?>
                </select>
                <select name="ajout_seance_salle_numero" >
                <option value="">Sélectionnez une salle</option>
                    <?php
                        foreach ($data15 as $salle) {
                            $selected15 = 'selected';
                            echo "<option value='$salle[1]'>$salle[2]</option>";
                        }
                    ?>
                </select>
                <input type="datetime-local" name="ajout_seance_horaire">
                <input type="submit" value="Ajouter la séance">
            </form>
            <?php
                    if(isset($_POST['ajout_seance_salle_numero'])&&
                    isset($_POST['ajout_seance_film'])&&
                    isset($_POST['ajout_seance_horaire'])
                    ){
                    $ajout_seance_salle_numero = $_POST['ajout_seance_salle_numero']; 
                    $ajout_seance_film = $_POST['ajout_seance_film']; 
                    $ajout_seance_horaire = $_POST['ajout_seance_horaire'];
                    //echo "L'horaire choisi est : " . $ajout_seance_horaire." "."le filme que vous programmer = ".$ajout_seance_film." "."dans la salle ".$ajout_seance_salle_numero;              
                    $requete16 = "INSERT INTO `movie_schedule`(id_movie, id_room, date_begin) VALUES (?,?,?)";
                    $statement16 = $databases->prepare($requete16);
                    $result16 = $statement16->execute([$ajout_seance_film, $ajout_seance_salle_numero, $ajout_seance_horaire]);
                    // Vérifier si l'insertion a réussi
                    if ($result16) {
                        echo "La séance a été ajoutée avec succès.";
                    } else {
                        echo "Une erreur est survenue lors de l'insertion.";
                    }
               }
            ?>
        </section>
    </main>
</body>

</html>