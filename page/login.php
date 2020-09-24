<?php session_start();

require_once 'connexion.php';

if (isset($_POST['userName']) and isset($_POST['password'])) {
    $userName = trim(addslashes(htmlspecialchars($_POST['userName'])));
    $password = trim(addslashes(htmlspecialchars($_POST['password'])));
    $userExists = false;
    //check if the user infos are in database
    $sqlRequest = 'SELECT userPassword, userName FROM tp_user';

    if ($pdo != null) {
        $result = $pdo->query($sqlRequest);

        while ($data = $result->fetch()) {
            $userPasswordHashedFromDB = $data['userPassword'];
            $userNameFromDB = $data['userName'];

            if (password_verify($password, $userPasswordHashedFromDB) and $userName == $userNameFromDB) {
                $_SESSION['userName'] = $userName;
                header('Location: index.php');
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <?php require_once '../css/style_login.php'; ?>
</head>

<body>

    <div class="container">

        <div class="jumbotron">
            <h1 class="display-4">Login</h1>
            <p class="lead">L'usager par défaut est <span>userName: admin </span> et <span> passsword: admin </span>
            </p>
            <hr class="my-4">

            <div class="login">
                <form method="post">
                    <div class="form-group row">
                        <label for="inputUserName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="userName" id="inputUserName"
                                placeholder="Nom d'utilisateur">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="inputPassword"
                                placeholder="Mot de passe">
                        </div>
                    </div>
                    <input class="btn btn-primary btn-lg" type="submit" value="Login">
                </form>
            </div>

            </form>

        </div>

        <?php if (isset($userExists)) {
    if ($userExists == false):?>

        <div class="alert alert-danger" role="alert">
            Nom d'utilisateur ou mot de passe erroné
        </div>
        <?php endif;
}
    ?>


        <footer class="fixed-bottom">
            <div class="container-fluid">

            </div>
        </footer>


    </div>


</body>

</html>