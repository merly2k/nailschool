<?php ?>
<form method="post" action="<?= WWW_ADMIN_PATH; ?>telega/sender">
    <label>Имя:</label><input type="text" name='user_name' placeholder="введите ваше имя">
    <label>E-mail:</label><input type="text" name='user_email' placeholder="введите ваш e-mail">
    <label>Телефон:</label><input type="text" name='user_phone' placeholder="введите ваш телефон">
    <label>сообщение:</label><textarea name='message' rows="4"></textarea>
    <button type="submit" >send</button>

</form>







