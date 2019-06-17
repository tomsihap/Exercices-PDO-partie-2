<?php

/**
 * Recéption du formulaire, gestion de POST et de l'INSERT
 */
if (!empty($_POST)) {

    $bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8;port=3306', 'root', '');

    $request = 'INSERT INTO appointments(dateHour, idPatients)
                VALUES (:dateHour, :idPatients)';

    $response = $bdd->prepare($request);

    $response->execute([
        'dateHour'   => $_POST['date'] . ' ' . $_POST['hour'] . ':00',
        'idPatients' => $_POST['idPatients']
    ]);

    Header("Location: liste-rdv.php");
}

/**
 * Récupération de la liste des patients pour le select>option
 */

$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8;port=3306', 'root', '');
$request = 'SELECT id, firstname, lastname FROM patients';
$response = $bdd->query($request);

$patients = $response->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <a href="liste-rdv.php" class="btn btn-primary btn-sm mb-2">
                    < Retour</a>

                <form action="ajout-rdv.php" method="POST" class="form">
                    <div class="form-group">
                        <label for="">Date du rendez-vous</label>
                        <input name="date" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Heure du rendez-vous</label>
                        <input name="hour" type="time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Choisir un patient</label>
                        <select name="idPatients" id="" class="form-control">
                            <?php foreach ($patients as $p) : ?>
                                <option value="<?= $p['id'] ?>"><?= $p['lastname'] ?> <?= $p['firstname'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button class="btn btn-success float-right">Créer le RDV</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

    </html>
