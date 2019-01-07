<h2>Reset Password</h2>


<?= form_open('reset-get') ?>
    <table>
        <tr>
            <td><label for="">New Password</label></td>
            <td>
                <input type="text" name="id" required value="<?= $this->uri->segment(2)?>">
                <input type="text" name="token" required value="<?= $this->uri->segment(3)?>">
                <?= form_error('password'); ?>
                <input type="password" name="password" required value="<?=set_value('password') ?>">
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Reset"></td>
        </tr>
    </table>
<?= form_close(); ?>