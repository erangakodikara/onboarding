<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Onboading app</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<center>
    <?php if (!empty($data)) {
        if (isset($data['error']) || ($data['error'] != '')) { ?>
            <div class="error"> <?php echo $data['error']; ?> </div>
        <?php } ?>
        <?php if (isset($data['success']) || ($data['error'] != '')) { ?>
            <div class="success"> <?php echo $data['success']; ?> </div>
        <?php }
    } ?>
    <div class="floating-box">
        <form name="form1" method="post" action="index.php?controller=login&action=login">
            <label for="uname">User Name</label>
            <input type="text" id="user_name" name="user_name"><br><br>
            <label for="pwd">Password</label>
            <input type="password" id="password" name="password"><br><br>
            <input name="submit" type="submit" id="submit" value="Login"><br>
            <p>New User <a href="view/signupView.php">Register Here</a></p>
        </form>
    </div>
</center>
</body>
</html>

