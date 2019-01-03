<h2>Login</h2>

<?= form_open('login') ?>
    <label for="">email</label>
    <?= form_error('email'); ?>
    <input type="email" name="email" value="<?=set_value('email') ?>"> <br>

    <label for="">password</label>
    <?= form_error('password'); ?>
    <input type="password" name="password"> <br>

    <input type="submit" name="submit" value="login">
<?= form_close(); ?>

<?php
$enc = encrypt_my('1');
$dec = decrypt_my($enc);

echo $enc.'<br/>';
echo $dec;
?>