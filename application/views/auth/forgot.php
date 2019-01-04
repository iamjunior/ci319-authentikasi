<h2>Forgot Password</h2>

<?= $mail->smtp_user?>
<?= form_open('forgot') ?>
    <table>
        <tr>
            <td><label for="">Email</label></td>
            <td>
                <?= form_error('email'); ?>
                <input type="email" name="email" required value="<?=set_value('email') ?>">
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="sending"></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="<?= site_url('login')?>">Kembali</a></td>
        </tr>
    </table>
<?= form_close(); ?>