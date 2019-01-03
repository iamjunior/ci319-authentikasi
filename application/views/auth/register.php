<h2>Backdoor Register</h2>
<h5>Jika Anda Berhasil Melihat Halaman Ini, Berarti anda seorang admin</h5>
<?= $code ?>
<?= form_open('daftar') ?>
<table>
    <tr>
        <td><label for="">Username</label></td>
        <td>
            <?= form_error('username'); ?>
            <input type="text" name="username" required value="<?=set_value('username') ?>">
        </td>
        
    </tr>
    <tr>
        <td><label for="">Email</label></td>
        <td>
            <?= form_error('email'); ?>
            <input type="email" name="email" required value="<?=set_value('email') ?>">
        </td>
    </tr>
    <tr>
        <td><label for="">Password</label></td>
        <td>
            <?= form_error('password'); ?>
            <input type="password" name="password" required value="<?=set_value('password') ?>">
        </td>
    </tr>
    <tr>
        <td><label for="">Ulangi Password</label></td>
        <td>
            <?= form_error('password2'); ?>
            <input type="password" name="password2" required value="<?=set_value('password2') ?>">
        </td>
    </tr>
    <tr>
        <td><label for="">Confirme Code</label></td>
        <td>
            <?= form_error('confirm'); ?>
            <input type="password" name="confirm" required value="<?=set_value('confirm') ?>">
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="register"></td>
    </tr>
</table>
<?= form_close(); ?>

<h4>Time Now: <?= date('y-m-d H:i')?><br/></h4>
