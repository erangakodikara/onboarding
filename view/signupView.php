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
    <form method="post" action="../index.php?controller=signup&action=save">
        First name:<br>
        <input type="text" name="user_name">
        <br>
        Email:<br>
        <input type="email" name="email_id">
        <br><br>
        Password:<br>
        <input type="password" name="password">
        <br><br>
        <input type="submit" value="Submit">
    </form>
</center>
</body>
</html>
