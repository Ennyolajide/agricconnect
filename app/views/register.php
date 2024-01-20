<!-- register.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/auth.css">

</head>

<body>

    <div class="container p-4">
        <img src="/images/logo.png" class="logo text-center" alt="">

        <form method="POST" action="/register">
            <h4 class="text-center text-success">User Registration</h4>
            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p class="small"><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="email" class="label-txt">ENTER YOUR EMAIL</label>
                <input type="email" id="email" name="email" class="form-control input">
            </div>
            <div class="form-group">
                <label for="name" class="label-txt">ENTER YOUR NAME</label>
                <input type="text" id="name" name="name" class="form-control input">
            </div>
            <div class="form-group">
                <label for="address" class="label-txt">ENTER YOUR ADDRESS</label>
                <input type="text" id="address" name="address" class="form-control input">
            </div>
            <div class="form-group">
                <label for="user_type" class="label-txt">ENTER USER TYPE</label>
                <select id="user_type" name="user_type" class="form-control" required>
                    <option value="buyer">Buyer</option>
                    <option value="seller">Farmers</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="password" class="label-txt">ENTER YOUR PASSWORD</label>
                <input type="password" id="password" name="password" class="form-control input">
            </div>
            <div class="form-group">
                <label for="c_password" class="label-txt">CONFIRM YOUR PASSWORD</label>
                <input type="password" id="c_password" name="c_password" class="form-control input">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <p class="text-center py-2"><span class="text-danger">Already have an account?</span> <a href="login">Login here</a></p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
