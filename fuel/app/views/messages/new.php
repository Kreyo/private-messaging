<?php
if(Auth::instance()->check())
{ ?>

<h2>New Messages</h2>
<br/>
<?php if ($messages): ?>
<ul>
    <?php foreach ($messages as $message): ?><tr>
        <?php if($message->recipient == Auth::instance()->get_screen_name() or $message->recipient == NULL or $message->name == Auth::instance()->get_screen_name()) { ?>
          <?php if($message->is_read == FALSE or $message->is_read == NULL ){ ?>
            <td><b><?php echo $message->name; ?></b></td>
            <?php if($message->recipient != NULL){?> <td><b><?php echo"- ", $message->recipient; ?></b></td> <br/>    <?php }; ?>
            <td><?php echo $message->message; ?></td> <br/>
            <td><?php echo Html::anchor('messages/view/'.$message->id, 'View'); ?>
            <?php
            if($message->name == Auth::instance()->get_screen_name())
            { ?>
                <td><?php echo Html::anchor('messages/edit/'.$message->id, 'Edit'); ?></td>
                <td><?php echo Html::anchor('messages/delete/'.$message->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?></td>
                <?php
            } ?>
            </td>
            <br/>
          <?php } ?>
        <?php } ?>
    </tr>

    <?php endforeach; ?>
</ul>
<?php else: ?>
<p>No Messages.</p>
<?php endif; ?>
<?php if(Auth::instance()->check()){ ?>
<p>
    <?php echo Html::anchor('messages', 'Back to messages', array('class' => 'btn success')); ?>
</p>

<?php } ?>
<?php } ?>