<h2>Listing Messages</h2>
    <br/>
    <?php if ($messages): ?>
    <ul>
    <?php foreach ($messages as $message): ?><tr>
       <?php if($message->adress_name == Auth::instance()->get_screen_name() or $message->adress_name == NULL or $message->name == Auth::instance()->get_screen_name()) { ?>
            <td><b><?php echo $message->name; ?></b></td>
            <?php if($message->adress_name != NULL){?><td><b><?php echo"- ", $message->adress_name; ?></b></td> <br/>    <?php }; ?>
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
            </tr>
       <?php } ?>
    <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>No Messages.</p>
    <?php endif; ?>
<?php if(Auth::instance()->check()){ ?>    
<p>
<?php echo Html::anchor('messages/create', 'Add new Message', array('class' => 'btn success')); ?>
</p>
<?php } ?>