<?php
$link = array('Username : ', Auth::instance()->get_screen_name(), 'Email :', Auth::instance()->get('email'), 'Avatar : ' );
$attr = array('id' => 'todo','class' => 'nav');
echo Html::ul($link, $attr);