<?php

$bdd = new PDO('mysql:host=localhost;dbname=hospitale2n;charset=utf8;port=3306', 'root', '');

/**
 * Données Patient
 */
$request = 'SELECT * FROM patients WHERE id = ' . $_GET['id'];
$response = $bdd->query($request);

$patient = $response->fetch(PDO::FETCH_ASSOC);

/**
 * Liste de ses rendez-vous
 */
$request = 'SELECT * FROM appointments WHERE idPatients = ' . $_GET['id'];
$response = $bdd->query($request);

$appointments = $response->fetchAll(PDO::FETCH_ASSOC);

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

                <a href="liste-patients.php" class="btn btn-primary btn-sm mb-2">
                    < Retour</a> <div class="card">
                        <div class="card-header"><?= $patient['firstname'] ?> <?= $patient['lastname'] ?></div>

                        <div class="card-body">
                            <ul>
                                <li>Né le : <?= date('d/m/Y', strtotime($patient['birthdate'])) ?></li>
                                <li>Téléphone : <?= $patient['phone'] ?></li>
                                <li>E-mail : <?= $patient['mail'] ?></li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <form action="ajout-rdv.php" method="post" class="form">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input name="date" type="date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Heure</label>
                                    <input name="hour" type="time" class="form-control">
                                </div>

                                <input type="hidden" name="idPatients" value="<?= $patient['id'] ?>">

                                <button class="btn btn-primary float-right">Ajouter un rendez-vous</button>
                            </form>
                        </div>
            </div>

            <?php foreach ($appointments as $appointment) :
                ?>
                <div class="card">
                    <div class="body">
                        Rendez-vous le <?= date('d/m/Y', strtotime($appointment['dateHour'])) ?>
                        à <?= date('H:i', strtotime($appointment['dateHour'])) ?>
                    </div>
                </div>
            <?php endforeach; ?>

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
