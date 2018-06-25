<?php /* SVN: $Id: admin_index.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="states index js-response">
    <div class="clearfix">
	<div class="add-block grid_right">
        <?php echo $this->Html->link(__l('Add'), array('controller' => 'states', 'action' => 'add'), array('class' => 'add', 'title' => __l('Add New State')));?>
    </div>

    <div class="page-count-block clearfix grid_left">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
    <?php echo $this->Form->create('State', array('class' => 'normal search-form', 'action'=>'index')); ?>
    	<div class="filter-section clearfix">
            <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    		<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
	</div>
    </div>
	
  <ul class="filter-list clearfix">
		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Approved) { echo 'class="active"';} ?>>
			<span class="active" title="<?php echo __l('Approved'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Approved'). '</span>', array('controller'=>'states','action'=>'index','filter_id' => ConstMoreAction::Approved), array('escape' => false));?></span> 
		</li>
		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Disapproved) { echo 'class="active"';} ?>>
			<span class="inactive" title="<?php echo __l('Disapproved'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Disapproved'). '</span>', array('controller'=>'states','action'=>'index','filter_id' => ConstMoreAction::Disapproved), array('escape' => false));?></span>
		</li>
		<li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>>
			<span title="<?php echo __l('Total'); ?>" class="yahoo"><?php echo $this->Html->link($this->Html->cInt($pending + $approved,false).'<span>' .__l('Total'). '</span>', array('controller'=>'states','action'=>'index'), array('escape' => false));?></span> 
		</li>
    </ul>

        <?php
        echo $this->Form->create('State' , array('action' => 'update','class'=>'normal'));?>
        <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
		<div class="overflow-block">
        <table class="list">
            <tr>
                <th class="dc"><?php echo __l('Select'); ?></th>
                <th class="dc"><?php echo __l('Actions');?></th>
                <th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Country'), 'Country.name');?></div></th>
                <th class="dl"><div class=""><?php echo $this->Paginator->sort('name');?></div></th>
                <th class="dc"><div class=""><?php echo $this->Paginator->sort('code');?></div></th>
                <th class="dc"><div class=""><?php echo $this->Paginator->sort('adm1code');?></div></th>
            </tr>
            <?php
                if (!empty($states)):
                $i = 0;
                    foreach ($states as $state):
                        $class = null;
                        if ($i++ % 2 == 0) :
                            $class = ' class="altrow"';
                        endif;
                        if($state['State']['is_approved'])  :
                            $status_class = 'js-checkbox-active';
                        else:
                            $status_class = 'js-checkbox-inactive';
                        endif;
                        ?>
                        <tr<?php echo $class;?>>
                            <td>
                                <?php
                                    echo $this->Form->input('State.'.$state['State']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$state['State']['id'],'label' => false , 'class' => $status_class.' js-checkbox-list'));
                                ?>
                            </td>
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
                                            <span><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $state['State']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
    						            </li>
    						            <li>
                                            <span><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $state['State']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
                                        </li>
                                        <li>
                                            <span>
                                                <?php if($state['State']['is_approved']):?>
                                                <?php echo $this->Html->link(__l('Approved'),array('controller'=>'states','action'=>'update_status',$state['State']['id'],'disapprove'),array('class' =>'approve','title' => __l('Approved')));?>
                                                <?php else:?>
                                                <?php echo $this->Html->link(__l('Disapproved'),array('controller'=>'states','action'=>'update_status',$state['State']['id'],'approve') ,array('class' =>'pending','title' => __l('Disapproved')));?>
                                                <?php endif; ?>
                                            </span>
                                        </li>
            						 </ul>
            						</div>
            						<div class="action-bottom-block"></div>
    							  </div>
    							 </div>
                        </td>
                            <td class="dl"><?php echo $this->Html->cText($state['Country']['name']);?></td>
                            <td class="dl"><?php echo $this->Html->cText($state['State']['name']);?></td>
                            <td class="dc"><?php echo $this->Html->cText($state['State']['code']);?></td>
                            <td class="dc"><?php echo $this->Html->cText($state['State']['adm1code']);?></td>
                        </tr>
                        <?php
                    endforeach;
            else:
                ?>
                <tr>
                    <td class="notice" colspan="6"><?php echo __l('No states available');?></td>
                </tr>
                <?php
            endif;
            ?>
        </table>
		</div>
        <?php
         if (!empty($states)) : ?>
         <div class="clearfix">
			<div class="admin-select-block clearfix grid_left">
			<div>
                <?php echo __l('Select:'); ?>
                <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title'=>__l('All'))); ?>
                <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title'=>__l('None'))); ?>
                <?php echo $this->Html->link(__l('Unapproved'), '#', array('class' => 'js-admin-select-pending','title'=>__l('Unapproved'))); ?>
                <?php echo $this->Html->link(__l('Approved'), '#', array('class' => 'js-admin-select-approved','title'=>__l('Approved'))); ?>
            </div>
        
            <div class="admin-checkbox-button">
                 <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
            </div>
			</div>
			    <div class=" grid_right">
            <?php  echo $this->element('paging_links'); ?>
            </div>
            </div>
            <div class="hide">
                <?php echo $this->Form->submit('Submit');  ?>
            </div>
            <?php
         endif; ?>
        <?php echo $this->Form->end();?>

</div>