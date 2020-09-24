<?php
session_start();
require_once 'connexion.php';
if (isset($_SESSION['userName'])) {
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: login.php');
    }

    $sqlRequest = 'SELECT * FROM tp_user';

    if ($pdo != null) {
        $result = $pdo->query($sqlRequest);
        $userAyyay = [];
        $i = 0;

        while ($data = $result->fetch()) {
            $userAyyay[$i]['id'] = $data['id'];
            $userAyyay[$i]['firstName'] = $data['firstName'];
            $userAyyay[$i]['lastName'] = $data['lastName'];
            $userAyyay[$i]['email'] = $data['email'];
            $userAyyay[$i]['userName'] = $data['userName'];
            $userAyyay[$i]['creationDate'] = $data['creationDate'];
            $userAyyay[$i]['modificationDate'] = $data['modificationDate'];
            ++$i;
        }
    }

    require_once 'connexion.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once '../css/style_index.php'; ?>
    <script src="https://kit.fontawesome.com/d7e68b8b5b.js" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <a id="titre" class="navbar-brand" href="#">MySQL User Form</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="form.php?param=add">
                            Ajouter <span class="sr-only">(current) </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <table class="table table-bordered">

            <!-- <thead id="titre">
                <tr class="thead-dark">
                    <th colspan='6' scope="col">MySQL User Form</th>
                </tr>
            </thead> -->

            <thead>
                <tr>

                    <th scope="col">Prenom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Courriel</th>
                    <th scope="col">Date de creation</th>
                    <th scope="col">Date de modification</th>
                    <th scope="col"> </th>
                </tr>
            </thead>

            <tbody>


                <?php foreach ($userAyyay as $key => $value):?>

                <?php if ($_SESSION['userName'] == $value['userName']) {?>
                <tr style="background-color:#b8daff">

                    <td>
                        <i style="font-size:24px; color:green;" class="fa">&#xf0a4;</i> <?=  $value['firstName']; ?>
                    </td>
                    <td>
                        <?=  $value['lastName']; ?>
                    </td>
                    <td>
                        <?= $value['email']; ?>
                    </td>
                    <td>
                        <?= $value['creationDate']; ?>
                    </td>
                    <td>
                        <?= $value['modificationDate']; ?>
                    </td>

                    <td>
                        <a href="form.php?param=edit&id=<?= $value['id']; ?>" class="space"><i
                                class="fas fa-user-edit"></i></a>

                        <a href="form.php?param=remove&id=<?= $value['id']; ?>" class="space"><i
                                class="fas fa-user-times"></i></a>
                    </td>
                </tr>
                <?php
                } else {
                    ?>
                <tr>

                    <td>
                        <?=  $value['firstName']; ?>
                    </td>
                    <td>
                        <?=  $value['lastName']; ?>
                    </td>
                    <td>
                        <?= $value['email']; ?>
                    </td>
                    <td>
                        <?= $value['creationDate']; ?>
                    </td>
                    <td>
                        <?= $value['modificationDate']; ?>
                    </td>

                    <td>
                        <a href="form.php?param=edit&id=<?= $value['id']; ?>" class="space"><i
                                class="fas fa-user-edit"></i></a>

                        <a href="form.php?param=remove&id=<?= $value['id']; ?>" class="space"><i
                                class="fas fa-user-times"></i></a>
                    </td>
                </tr>
                <?php
                } ?>
                <?php endforeach; ?>
            </tbody>

        </table>

        <div>
            <a href="index.php?logout=1" class="btn btn-primary btn-lg"> Logout </a>
        </div>

    </div>

</body>

</html>
<?php
} else {
                    header('Location: login.php');
                }