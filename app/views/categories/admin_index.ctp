<?php /* SVN: $Id: admin_index.ctp 632 2009-12-01 08:01:06Z annamalai_034ac09 $ */ ?>
<div class="categories index js-response js-responses">
	<h2><?php echo __l('Categories');?></h2>
	<ul class="filter-list clearfix">
		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) { echo 'class="active"';} ?>>
			<span class="active" title="<?php echo __l('Active'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Active'). '</span>', array('controller'=>'categories','action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false));?></span> 
		</li>
		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) { echo 'class="active"';} ?>>
			<span class="inactive" title="<?php echo __l('Inactive'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Inactive'). '</span>', array('controller'=>'categories','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false));?></span>
		</li>    	
		<li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>>
			<span class="yahoo round-5" title="<?php echo __l('Total'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending + $approved,false).'<span>' .__l('Total'). '</span>', array('controller'=>'categories','action'=>'index'), array('escape' => false));?></span>
		</li>
	</ul>

    <div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
	 <div class="add-block grid_right">
		<?php echo $this->Html->link(__l('Add'), array('controller' => 'categories', 'action' => 'add'), array('class' => 'add', 'title' => __l('Add')));?>
	</div>
    <div class="grid_left">
            <?php echo $this->Form->create('Category' , array('class' => 'normal search-form','action' => 'index')); ?>
    	<div class="filter-section clearfix">
    			<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>
	
	<?php echo $this->Form->create('Category' , array('class' => 'normal','action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<table class="list">
		<tr>
			<th><?php echo __l('Select'); ?></th>
			<th class="actions"><?php echo __l('Actions');?></th>
			<th><div class=""><?php echo $this->Paginator->sort('created');?></div></th>
			<th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Title'), 'title');?></div></th>
		</tr>
		<?php
			if (!empty($categories)):
				$i = 0;
				foreach ($categories as $category):
					$class = null;
					$active_class = '';
					if ($i++ % 2 == 0) {
						$class = 'altrow';
					}					
					if($category['Category']['is_active']):
						$status_class = 'js-checkbox-active';
					else:
						$active_class = ' inactive-record';
						$status_class = 'js-checkbox-inactive';
					endif;
		?>
		<tr class="<?php echo $class.$active_class;?>">
			<td><?php echo $this->Form->input('Category.'.$category['Category']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$category['Category']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
                    <td class="actions">
                        <div class="action-block">
                        <span class="action-information-block">
                            <span class="action-left-block">&nbsp;&nbsp;</span>
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
                                      <span><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $category['Category']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
                                    </li>
                                    <li>
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $category['Category']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						            </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>

            <td><?php echo $this->Html->cDateTime($category['Category']['created']);?></td>
			<td class='dl'><?php echo  $this->Html->cText($category['Category']['title']);?></td>
		</tr>
		<?php
				endforeach;
			else:
		?>
		<tr>
			<td colspan="8" class="notice"><?php echo __l('No Categories available');?></td>
		</tr>
		<?php
			endif;
		?>
	</table>
	<?php if (!empty($categories)) : ?>
     <div class="clearfix">
		<div class="admin-select-block grid_left">
			<div>
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
				<?php echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-admin-select-pending', 'title' => __l('Inactive'))); ?>
				<?php echo $this->Html->link(__l('Active'), '#', array('class' => 'js-admin-select-approved', 'title' => __l('Active'))); ?>
			</div>
			<div class="admin-checkbox-button">
				<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
			</div>
		</div>
		<div class="hide">
			<?php echo $this->Form->submit('Submit');  ?>
		</div>
		<div class=" grid_right">
			<?php echo $this->element('paging_links'); ?>
		</div>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>