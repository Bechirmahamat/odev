<?php
include('./config.php'
);
session_start();
if (isset($_POST['sign'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password != $cpassword) {
        header('location:signup.php?error=password need to  match please ');
        exit;
    } else {
        $stmt1 = $conn->prepare("SELECT count(*) FROM users where email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($rows);
        $stmt1->store_result();
        $stmt1->fetch();

        if ($rows != 0) {
            header('location:signup.php?error=You already have account please login ');
            exit;
        } else {
            $stmt = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
            $stmt->bind_param("sss", $name,  $email, password_hash($password, PASSWORD_DEFAULT));
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $name;
                $_SESSION['email'] = $email;
                header('location:home.php?message= sign up successfully ');
            } else {
                header('location:signup.php?error=something went wrong try again later ');
            }
        }
    }
}; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                    <!-- <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">Action</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"
                                        >Another action</a
                                    >
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <a class="dropdown-item" href="#"
                                        >Something else here</a
                                    >
                                </li>
                            </ul>
                        </li> -->
                </ul>
                <!-- <form class="d-flex" role="search">
                        <input
                            class="form-contr me-2"
                            type="search"
                            placeholder="Search"
                            aria-label="Search"
                        />
                        <button class="btn btn-outline-success" type="submit">
                            Search
                        </button>
                    </form> -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <button class="btn btn-light">login</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <button class="btn btn-dark">sign up</button></a>
                    </li>
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
            <form action="signup.php" method="post">
                <h1 class="">Sign Up Now</h1>
                <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?= $_GET['error']; ?></p>
                <?php } ?>
                <div class="form-control">
                    <input type="text" name="name" id="" required />
                    <label for="">Enter fullname</label>
                </div>
                <div class="form-control">
                    <input type="email" name="email" id="" required />
                    <label for="">Email adress</label>
                </div>

                <div class="form-control">
                    <input type="password" name="password" id="" required />
                    <label for="">Password</label>
                </div>
                <div class="form-control">
                    <input type="password" name="cpassword" id="" required />
                    <label for="">Confirm password</label>
                </div>
                <button type="submit" name="sign" value="1" class="btn w-100 btn-info py-2">Sign up</button>
                <h6 class="text-center my-2 mt-3">
                    Already have an account? <a href="">login</a>
                </h6>
                <p>by cliking Sign up, you agree to terms of use.</p>

                <hr />
                <h3>Or use a third-party</h3>
                <div class="form-group">
                    <button class="btn py-2">
                        <i class="fa-brands fa-twitter"></i> Sign up with
                        Twitter
                    </button>
                </div>
                <div class="form-group">
                    <button class="btn py-2 btn-blue">
                        <i class="fa-brands fa-facebook"></i> Sign up with
                        Facebook
                    </button>
                </div>
                <div class="form-group">
                    <button class="btn py-2">
                        <i class="fa-brands fa-github"></i> Sign up with
                        GitHub
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>