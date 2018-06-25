<?php /* SVN: $Id: admin_index.ctp 1564 2009-11-23 11:47:59Z sridevi_093at09 $ */ ?>
<div class="userComments index js-response">
	<div class="page-count-block clearfix">
		 <div class="grid_left">
			<?php echo $this->element('paging_counter');?>
		 </div>		
	</div>
	<?php echo $this->Form->create('UserComment' , array('class' => 'normal','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<table class="list">
    <tr>
		<th class="dc"><?php echo __l('Select'); ?></th>
        <th class="actions dc"><?php echo __l('Actions');?></th>
        <th class="dc"><?php echo $this->Paginator->sort('created');?></th>
        <th class="dl"><?php echo $this->Paginator->sort(__l('User'), 'ToUser.username');?></th>
        <th class="dl"><?php echo $this->Paginator->sort(__l('Commented By'), 'User.username');?></th>
        <th class="dl"><?php echo $this->Paginator->sort('comment');?></th>
    	<th class="dl"><?php echo __l('IP');?></th>
	</tr>
<?php
if (!empty($userComments)):
$i = 0;
foreach ($userComments as $userComment):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Form->input('UserComment.'.$userComment['UserComment']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userComment['UserComment']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
		<td class="actions">
			<div class="action-block">
				<span class="action-information-block">
					<span class="action-left-block">&nbsp;&nbsp;
					</span>
					<span class="action-center-block">
						<span class="action-info">
							<?php echo __l('Action');?>
						</span>
					</span>
				</span>
			<div class="action-inner-block">
				<div class="action-inner-left-block">
					<ul class="action-link clearfix">
						<li>
							<span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $userComment['UserComment']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
						</li>
						<li>
							<span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $userComment['UserComment']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						</li>
					</ul>
				</div>
				<div class="action-bottom-block"></div>
			</div>
			</div>
		</td>		
		<td class="dc"><?php echo $this->Html->cDateTime($userComment['UserComment']['created']);?></td>
		<td class="dl"><?php echo $this->Html->link($this->Html->cText($userComment['ToUser']['username']), array('controller' => 'users', 'action' => 'view', $userComment['ToUser']['username'], 'admin' => false), array('escape' => false));?></td>
		<td class="dl"><?php echo $this->Html->link($this->Html->cText($userComment['User']['username']), array('controller' => 'users', 'action' => 'view', $userComment['User']['username'], 'admin' => false), array('escape' => false));?></td>
		<td class="dl"><div class="js-truncate"><?php echo $this->Html->cText($userComment['UserComment']['comment']);?></div></td>
		<td class="dl">
			<?php if(!empty($userComment['Ip']['ip'])): ?>
				<?php echo  $this->Html->link($userComment['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $userComment['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$userComment['Ip']['host'], 'escape' => false)); ?>
				<p>
					<?php if(!empty($userComment['Ip']['Country'])): ?>
						<span class="flags flag-<?php echo strtolower($userComment['Ip']['Country']['iso2']); ?>" title ="<?php echo $userComment['Ip']['Country']['name']; ?>"><?php echo $userComment['Ip']['Country']['name']; ?></span>
					<?php endif; ?>
					<?php if(!empty($userComment['Ip']['City'])): ?>
						<span><?php echo $userComment['Ip']['City']['name']; ?></span>
					<?php endif; ?>
				</p>
			<?php else: ?>
				<?php echo __l('N/A'); ?>
			<?php endif; ?>
		</td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="12" class="notice"><?php echo __l('No User Comments available');?></td>
	</tr>
<?php
endif;
?>
</table>
 <?php
    if (!empty($userComments)) :
 ?>
        <div class="clearfix">
        <div class="admin-select-block grid_left">
        <div>
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
        </div>
        
        <div class="admin-checkbox-button">
            <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
        </div>
        </div>
        <div class=" grid_right">
            <?php echo $this->element('paging_links'); ?>
        </div>
        </div>
        <div class="hide">
            <?php echo $this->Form->submit('Submit');  ?>
        </div>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>
