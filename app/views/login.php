<!-- login.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/auth.css">
</head>

<body>

    <div class="container p-4">
        <img src="/images/logo.png" class="logo text-center" alt="">

        <form method="POST" action="/login">
            <h4 class="text-center text-success">User Login</h4>
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <p class="small"><?= $error ?></p>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="email" class="label-txt">ENTER YOUR EMAIL</label>
                <input type="email" id="email" name="email" class="form-control input">
            </div>
            <div class="form-group">
                <label for="password" class="label-txt">ENTER YOUR PASSWORD</label>
                <input type="password" id="password" name="password" class="form-control input">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <p class="text-center py-2"><span class="text-danger">No account? </span> <a href="register">Signup here</a></p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
