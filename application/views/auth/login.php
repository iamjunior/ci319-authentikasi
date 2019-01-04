<h2>Login</h2>


<?= form_open('login') ?>
    <table>
        <tr>
            <td><label for="">username</label></td>
            <td>
                <?= form_error('username'); ?>
                <input type="username" name="username" required value="<?=set_value('username') ?>">
            </td>
        </tr>
        <tr>
            <td><label for="">password</label></td>
            <td>
                <?= form_error('password'); ?>
                <input type="password" required name="password">
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="login"></td>
        </tr>
    </table>
<?= form_close(); ?>