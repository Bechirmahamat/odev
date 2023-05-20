<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['amail'])) {
    header('location:login.php?error=you need to login!');
}

?>
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
    <style>
    /* .navbar i {
            font-size: 20px;
            color: blue;
        } */

    .navbar {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .navbar .bi-person {
        font-size: 22px;
    }

    .navbar a:hover {
        color: orangered;
    }

    .dfelx {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .dfelx {
        font-size: 18px;
    }

    .message {
        background: rgba(0, 200, 0, 0.2);
        color: green;
        padding: 10px 8px;
        text-align: center;
        border-radius: 5px;
        font-size: 17px;
    }
    </style>
    <title>odev</title>
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
                <ul class="navbar-nav dfelx">

                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="bi-bag"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="bi-person"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php?exit=true">
                            <button class="btn btn-dark"> <i class="bi bi-box-arrow-right"></i> logout</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5 py-5">
        <?php if (isset($_GET['message'])) { ?>
        <p id="paragraph" class="message"><?= $_GET['message']; ?></p>
        <?php } ?>
        <h1>Admin Profile</h1>
        <div class="row my-4">
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="https://via.placeholder.com/150" alt="Admin Avatar" />
                    <div class="card-body text-left">
                        <h5 class="card-title">Admin name:</h5>
                        <h5><span class="text-primary"><?= $_SESSION['username'] ?> </span></h5>
                        <h5 class="card-text">Email :</h5>
                        <h5><span class="text-primary"><?= $_SESSION['email'] ?></span></h5>
                        <a href="" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h3>Update Password</h3>
                <form>
                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" class="form-control" id="current-password" required />
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" class="form-control" id="new-password" required />
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm-password" required />
                    </div>
                    <button type="submit" class="btn my-2 btn-primary">
                        Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->

    <script>
    setTimeout(function() {
        var paragraph = document.getElementById('paragraph');
        paragraph.parentNode.removeChild(paragraph);
    }, 5000); // 30 seconds in milliseconds
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>