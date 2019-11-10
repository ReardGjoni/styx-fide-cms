<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="reg.css">
    <title>Create new Password</title>
</head>
<body>
<header>CREATE NEW PASSWORD</header><br>

    <p style="padding-left: 40%;">
    Enter your new Password twice to reset it.
    </p>

    <?php

        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request.";
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                    <form id="form" class="topBefore" action="includes/reset_password.inc.php" method="post">
                        <input name="selector" type="hidden" value="<?php echo $selector ?>">
                        <input name="validator" type="hidden" value="<?php echo $validator ?>">
                        <input name="pwd" type="password" placeholder="New Password">
                        <input name="pwd-repeat" type="password" placeholder="Repeat new Password">
                        <input style="border-top: none;" name="reset_password_submit" id="submit" type="submit" value="RESET!">
                    </form>
                <?php
                
            }
        }
    ?>

</body>
</html>