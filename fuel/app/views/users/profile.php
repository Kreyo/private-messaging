<?php
$link = array('Username : ', Auth::instance()->get_screen_name(), 'Email :', Auth::instance()->get_email(), 'Avatar : ' );
$attr = array('id' => 'todo','class' => 'nav');
echo Html::ul($link, $attr); ?>
<fieldset name="Change your password" id="email_change">
    <form action = "POST">
        <input type="text" placeholder="Your new email">
        <input type="submit">
    </form>
</fieldset>