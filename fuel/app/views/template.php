<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<style>
		body { margin: 40px; }
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span12">
				<h1><?php echo $title; ?></h1>
				<hr>
<?php
   if(Auth::instance()->check())
    { ?>

    <p>Logged in as: </p> <?php echo Auth::instance()->get_screen_name() ?>
    <br/>
    <ul class = "nav nav-pills">
        <li><a href='/users/logout'>Logout</a> </li>
        <li><a href='/users/profile'>Profile</a> </li>
        <li><a href='/messages/new'>New Messages</a></li>
        <li><a href='/messages/sent'>Sent Messages</a></li>
    </ul>
    <?php }
   else
    { ?>

      <ul class = "nav nav-pills">
          <li <?php if(URi::segment(2) == 'login') { ?> class="active"<?php } ?> ><a href='/users/login'>Login </a></li>
          <li <?php if(URi::segment(2) == 'register') { ?> class="active"<?php } ?> ><a href='/users/register'>Register </a></li>

      </ul>
    <?php }
  // echo Html::ul($link, $attr);
?>        
<?php if (Session::get_flash('success')): ?>
				<div class="alert-message success">
					<p>
					<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
					</p>
				</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
				<div class="alert-message error">
					<p>
					<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
					</p>
				</div>
<?php endif; ?>
			</div>
        </div>
        <div class="row">
		    <div class="span12">
                <?php echo $content; ?>

			</div>
		</div>
		<footer>
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php echo e(Fuel::VERSION); ?></small>
			</p>
		</footer>
	</div>
</body>
</html>
