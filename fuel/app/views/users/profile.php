<?php
$link = array('Username : ', Auth::instance()->get_screen_name(), 'Avatar : ' );
$attr = array('id' => 'todo','class' => 'nav');
echo Html::ul($link, $attr);