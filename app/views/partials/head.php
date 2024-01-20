<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Products Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Include Summernote CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
   

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Acddtional styles or scripts -->
    <?php
        foreach($additionalStyles ?? [] as $url) {
            echo '<link rel="stylesheet" href="'.$url.'">';
        }
    ?>
     <!-- Include Parsley CSS (Adjust the path accordingly) -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/parsleyjs/2.10.2/parsley.css">
     
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light mb-3">
        <a class="navbar-brand" href="/">
            <img src="/images/logo.png" alt="Logo" height="65">
        </a>
        <form action="<?= $auth->isAuthenticated() ? '/listings' : 'home' ?>" class="form-inline my-2 my-lg-0 ml-auto search-box">
            <div class="input-group">
                <input name="search" class="form-control" type="search" placeholder="Search Everything"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary search-btn" type="submit">Search</button>
                </div>
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Listings</a>
            </li>
            <?php if(@$auth->isAuthenticated()): ?>
                <?php if(strtolower($auth->type) == 'farmer' || strtolower($auth->type) == 'seller'): ?>
                <li class="nav-item">
                    <a href="/create-post" class="btn btn-orange">Post Item</a>
                </li>
                <?php endif; ?>
            <?php endif; ?>
            <!-- Notification Icon -->
            <li class="nav-item mx-3">
                <a class="nav-link" href="/chats">Chats
                    <span class="position-relative">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">+</span>
                    </span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <?php if(@$auth->isAuthenticated()): ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user user-icon"></i>Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                     <a class="dropdown-item" href="/my-profile">My Profile</a>
                        <a class="dropdown-item" href="/my-listings">My Listings</a>
                        <a class="dropdown-item" href="/logout">Logout</a>

                    </div>
                <?php else: ?>
                    <a class="btn btn-success" href="/login">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>