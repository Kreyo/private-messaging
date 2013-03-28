<?php
$link = array('Username : ', Auth::instance()->get_screen_name() );
echo Html::ul($link);