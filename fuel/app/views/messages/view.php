<h2>Viewing #<?php echo $message->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $message->name; ?></p>
<p>
	<strong>Message:</strong>
	<?php echo $message->message; ?></p>

<?php
    if($message->name == Auth::instance()->get_screen_name())
    { ?>
<?php echo Html::anchor('messages/edit/'.$message->id, 'Edit'); ?> |
<?php } ?>
<?php echo Html::anchor('messages', 'Back'); ?>