<h2>Listing Messages</h2>
    <br/>
    <?php if ($messages): ?>
    <ul>
    <?php foreach ($messages as $message): ?><tr>
            <td><b><?php echo $message->name; ?></b></td>
            <td><?php echo $message->message; ?></td> <br/>
                <td><?php echo Html::anchor('messages/view/'.$message->id, 'View'); ?>
                    <?php echo Html::anchor('messages/edit/'.$message->id, 'Edit'); ?>
                    <?php echo Html::anchor('messages/delete/'.$message->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
                </td>
                <br/>
            </tr>
    <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>No Messages.</p>
    <?php endif; ?>
<p>
<?php echo Html::anchor('messages/create', 'Add new Message', array('class' => 'btn success')); ?>
</p>