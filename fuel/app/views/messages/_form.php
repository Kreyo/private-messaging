<?php echo Form::open(); ?>

	<fieldset>
		<div class="clearfix">

			<div class="input">
				<?php echo 'Name: '.Auth::instance()->get_screen_name(); ?>

			</div>
		</div>
		<div class="clearfix">


            <?php echo Form::label('Message to:', 'Message_to'); ?>
            <div class="input">
                <?php echo Form::textarea('recipient', Input::post('recipient', isset($recipient) ? $recipient->recipient : ''), array('class' => 'span1')); ?>

            </div>
			<div class="input">
				<?php echo Form::textarea('message', Input::post('message', isset($message) ? $message->message : ''), array('class' => 'span8', 'rows' => 8)); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>