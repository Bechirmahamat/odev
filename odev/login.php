<?php
include('./config.php'
);
session_start();
if (isset($_POST['login'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location:login.php?error=Invalid email');
        exit;
    }
    $stmt = $conn->prepare("SELECT id ,name,email, password FROM users where email=?");
    $stmt->bind_param('s', $email);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $name, $email, $hpassword);
        $stmt->store_result();
        $stmt->fetch();
        if (!password_verify($password, $hpassword)) {
            header('location:login.php?error=Incorrect password');
            exit;
        } else {
            $_SESSION["user_id"] = $id;
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $name;
            header('location:home.php?message=logged in succesffully');
        }
    }
} elseif (isset($_GET['exit'])) {
    session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="https://kit.fontawesome.com/d4d6485b0b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css?v=<?= time(); ?>" />
    <title>odev</title>
    <style>
        .error {
            background: rgba(200, 0, 0, 0.1);
            color: rgb(250, 0, 0);
            padding: 15px 8px;
            text-align: center;
            border-radius: 5px;
            font-size: 17px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-light fixed-top navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand text-primary" href="#">Bech delevery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Shopping</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <button class="btn btn-light">login</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <button class="btn btn-dark">sign up</button></a>
                    </li>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="bi-bag"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="bi-person"></i></a>
                        </li>
                    </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid my-5 py-5">
        <div class="container">
            <form action="login.php" method="post">
                <h1 class="">Login</h1>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?= $_GET['error']; ?></p>
                <?php } ?>
                <div class="form-control">
                    <input type="email" name="email" id="" required />
                    <label for="">Email adress</label>
                </div>

                <div class="form-control">
                    <input type="password" name="password" id="" required />
                    <label for="">password</label>
                </div>
                <button type="submit" name="login" value="1" class="btn btn-info w-100 py-2">login</button>
                <h6 class="text-center my-2 mt-3">
                    Dont Have Account Yet? <a href="">signup</a>
                </h6>
                <p>by cliking Sign up, you agree to terms of use.</p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>