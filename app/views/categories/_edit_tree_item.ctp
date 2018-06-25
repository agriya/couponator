<div class="actions-handle">
    <?php echo $this->Html->link($data['Category']['title'], array('action' => 'edit', $data['Category']['id']), array('title' => __('Edit this category', true))); ?> <?php echo ($data['Category']['is_active']) ? __l('Active') : __l('Inactive'); ?>

    <div class="row-actions">
        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $data['Category']['id']), array('class' => 'action_delete delete js-delete', 'escape' => false, 'title' => __('Delete this category', true))); ?>
    </div>
</div>
