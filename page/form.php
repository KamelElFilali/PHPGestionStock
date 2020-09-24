<?php
session_start();
require_once 'connexion.php';
if (isset($_SESSION['userName'])) {
    $userAyyay = [];

    if (isset($_GET['param'])) {
        $param = trim(htmlspecialchars($_GET['param']));
        if ($param === 'edit') {
            if (isset($_GET['id'])) {
                $userId = trim(htmlspecialchars($_GET['id']));

                if (isset($_POST['firstName']) and isset($_POST['lastName']) and isset($_POST['email']) and isset($_POST['userName']) and isset($_POST['userPassword'])) {
                    $firstName = trim(htmlspecialchars($_POST['firstName']));
                    $lastName = trim(htmlspecialchars($_POST['lastName']));
                    $email = trim(htmlspecialchars($_POST['email']));
                    $userName = trim(htmlspecialchars($_POST['userName']));
                    $userPassword = trim(htmlspecialchars($_POST['userPassword']));
                    $sqlRequest = "UPDATE tp_user SET firstName = '$firstName', lastName = '$lastName', email = '$email', userName = '$userName', userPassword ='$userPassword', modificationDate = NOW() where id = $userId";
                    if ($pdo != null) {
                        $result = $pdo->query($sqlRequest);
                        if ($result) {
                            header('Location: index.php');
                        }
                    }
                }

                $sqlRequest = 'SELECT * FROM tp_user where id ='.$userId;

                if ($pdo != null) {
                    $result = $pdo->query($sqlRequest);

                    if ($data = $result->fetch()) {
                        $userAyyay[0]['id'] = $data['id'];
                        $userAyyay[0]['firstName'] = $data['firstName'];
                        $userAyyay[0]['lastName'] = $data['lastName'];
                        $userAyyay[0]['email'] = $data['email'];
                        $userAyyay[0]['userName'] = $data['userName'];
                        $userAyyay[0]['userPassword'] = $data['userPassword'];
                        $userAyyay[0]['creationDate'] = $data['creationDate'];
                        $userAyyay[0]['modificationDate'] = $data['modificationDate'];
                    }
                }
            }
        } elseif ($param === 'add') {
            if (isset($_POST['firstName']) and isset($_POST['lastName']) and isset($_POST['email']) and isset($_POST['userName']) and isset($_POST['userPassword'])) {
                if (trim($_POST['firstName']) != '' and trim($_POST['lastName']) != '' and trim($_POST['email']) != '' and trim($_POST['userName']) != '' and trim($_POST['userPassword']) != '') {
                    $firstName = trim(htmlspecialchars($_POST['firstName']));

                    $lastName = trim(htmlspecialchars($_POST['lastName']));
                    $email = trim(htmlspecialchars($_POST['email']));
                    $userName = trim(htmlspecialchars($_POST['userName']));
                    $userPassword = trim(htmlspecialchars($_POST['userPassword']));
                    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
                    $sqlRequest = "INSERT INTO tp_user(firstName, lastName, email, userName, userPassword, creationDate, modificationDate) values('$firstName', '$lastName', '$email', '$userName', '$hashedPassword', NOW(), NOW())";
                    if ($pdo != null) {
                        $result = $pdo->query($sqlRequest);
                        if ($result) {
                            header('Location: index.php');
                        }
                    }
                }
            }
        } elseif ($param === 'remove') {
            if (isset($_GET['id'])) {
                $userId = trim(htmlspecialchars($_GET['id']));

                $sqlRequest = 'DELETE FROM tp_user where id = '.$userId;
                if ($pdo != null) {
                    $result = $pdo->query($sqlRequest);
                    if ($result) {
                        header('Location: index.php');
                    }
                }
            }
        }

        require_once 'connexion.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once '../css/style_formulaire.php'; ?>
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
                        <a class="nav-link" href="form.php">
                            Ajouter <span class="sr-only">(current) </span>
                        </a>
                    </li>

                    <li id="logout" class="nav-item right-login">
                        <a class="nav-link " href="index.php?logout=1"> Logout </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="jumbotron">
            <div class="login">
                <form method="post">

                    <div class="form-group row">
                        <label for="inputPrenom" class="col-sm-2 col-form-label">Prenom</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPrenom" placeholder="Prenom"
                                name="firstName" value="<?php if (count($userAyyay) > 0) {
            echo $userAyyay[0]['firstName'];
        } ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNom" placeholder="Nom" name="lastName"
                                value="<?php if (count($userAyyay) > 0) {
            echo $userAyyay[0]['lastName'];
        } ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Courriel</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Mail" name="email"
                                value="<?php if (count($userAyyay) > 0) {
            echo $userAyyay[0]['email'];
        } ?>">
                        </div>
                    </div>


                    <div class=" form-group row">
                        <label for="inputUserName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputUserName" placeholder="Nom d'utilisateur"
                                name="userName" value="<?php if (count($userAyyay) > 0) {
            echo $userAyyay[0]['userName'];
        } ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Mot de passe"
                                name="userPassword">
                        </div>
                    </div>

                    <div>
                        <input type="submit" href="index.php?logout=1" class="btn btn-primary btn-lg"
                            value="Sauvegarder">
                    </div>
                </form>
            </div>




            <!-- <a class="btn btn-primary btn-lg" href="login.php" value="Login" role="button">Login</a> -->

            </form>

        </div>
</body>

</html>
<?php
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: login.php');
}