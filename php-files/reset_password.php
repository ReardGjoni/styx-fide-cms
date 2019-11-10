<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="reg.css">
<title>Reset Password</title>
</head>
<body>
<header>RESET PASSWORD</header><br>

<p style="padding-left: 31%;">
An E-Mail will be sent to you with instructions on how to reset your password.
</p>

<form id="form" class="topBefore" action="includes/reset_request.php" method="post">
    <input name="email" type="email" placeholder="E-Mail">
    <input style="border-top: none; width: 470px;" name="reset_request_submit" id="submit" type="submit" value="GO!">
</form>

    <?php
        if (isset($_GET['reset'])) {
            if ($_GET['reset'] == 'success') {
                $errors[] = 'Check your E-Mail';
            }
        }
    ?>

    <?php foreach($errors as $error): ?>
        <div class="well w-75" style="padding-left: 33.5%;">
            <p class="alert alert-warning w-75" style="background-color: white; border-radius: 3px; text-align:center;"><?= $error ?></p>
        </div>
    <?php endforeach ?>

</body>
</html>