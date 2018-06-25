<?php /* SVN: $Id: admin_index.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="cities index js-response">
   <div class="page-count-block clearfix">
     <div class="grid_left">
        <?php echo $this->element('paging_counter');?>
     </div>
    <div class="grid_left">
            	<?php echo $this->Form->create('City', array('class' => 'normal search-form', 'action'=>'index')); ?>
    	<div class="filter-section clearfix">
            <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    			<?php echo $this->Form->submit(__l('Search'));?>
    	</div>
    	<?php echo $this->Form->end(); ?>
	</div>
		<div class="add-block grid_right">
		<?php echo $this->Html->link(__l('Add'), array('controller' => 'cities', 'action' => 'add'), array('class' => 'add', 'title' => __l('Add New City')));?>
	</div>
	</div>

      <ul class="filter-list clearfix">
        <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Approved) { echo 'class="active"';} ?>>
			<span class="active" title="<?php echo __l('Approved'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Approved'). '</span>', array('controller'=>'cities','action'=>'index','filter_id' => ConstMoreAction::Approved), array('escape' => false));?></span> 
		</li>
		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Disapproved) { echo 'class="active"';} ?>>
			<span class="inactive" title="<?php echo __l('Disapproved'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Disapproved'). '</span>', array('controller'=>'cities','action'=>'index','filter_id' => ConstMoreAction::Disapproved), array('escape' => false));?></span>
		</li>
		<li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>>
			<span title="<?php echo __l('Total'); ?>" class="yahoo"><?php echo $this->Html->link($this->Html->cInt($pending + $approved,false).'<span>' .__l('Total'). '</span>', array('controller'=>'cities','action'=>'index'), array('escape' => false));?></span> 
		</li>
      </ul>

            <?php
            echo $this->Form->create('City', array('action' => 'update','class'=>'normal')); ?>
            <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
			<div class="overflow-block">
            <table class="list">
                <tr>
                    <th><?php echo __l('Select'); ?></th>
                    <th><?php echo __l('Actions');?></th>
                    <th class="dl"><div class=""><?php echo $this->Paginator->sort('Country', 'Country.name', array('url'=>array('controller'=>'cities', 'action'=>'index')));?></div></th>
                    <th class="dl"><div class=""><?php echo $this->Paginator->sort('State', 'State.name', array('url'=>array('controller'=>'cities', 'action'=>'index')));?></div></th>
                    <th class="dl"><div class=""><?php echo $this->Paginator->sort('name');?></div></th>
                </tr>
                <?php
                if (!empty($cities)):
                    $i = 0;
                    foreach ($cities as $city):
                        $class = null;
                        if ($i++ % 2 == 0) :
                            $class = ' class="altrow"';
                        endif;
                        if($city['City']['is_approved'])  :
                            $status_class = 'js-checkbox-active';
                        else:
                            $status_class = 'js-checkbox-inactive';
                        endif;
                    ?>
                        <tr<?php echo $class;?>>
                            <td>
                                <?php
                                echo $this->Form->input('City.'.$city['City']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$city['City']['id'],'label' => false , 'class' => $status_class.' js-checkbox-list'));
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
                                        <span>
                                         <?php
                                    if($city['City']['is_approved']):
                                        echo $this->Html->link(__l('Approved'),array('controller'=>'cities','action'=>'update_status',$city['City']['id'],'disapprove'),array('class' =>'approve','title' => __l('Approved')));
                                    else:
                                    	echo $this->Html->link(__l('Disapproved'),array('controller'=>'cities','action'=>'update_status',$city['City']['id'],'approve') ,array('class' =>'pending','title' => __l('Disapproved')));
                                      endif;
                                      
                                     ?>
                                </span>
						            </li>
						            <li>
                                    <span>
                                    <?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $city['City']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
                                     </li>
                                     <li>
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $city['City']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete'))); ?></span>
                                     </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>
                            <td class="dl"><?php echo $this->Html->cText($city['Country']['name'], false);?></td>
                            <td class="dl"><?php echo $this->Html->cText($city['State']['name'], false);?></td>
                            <td class="dl"><?php echo $this->Html->cText($city['City']['name'], false);?></td>
                        </tr>
                    <?php
                    endforeach;
                    else:
                    ?>
                    <tr>
                        <td class="notice" colspan="10"><?php echo __l('No cities available');?></td>
                    </tr>
                    <?php
                    endif;
                    ?>
            </table>
			</div>
            <?php
                if (!empty($cities)) :
                    ?>
                    <div class="clearfix">
					<div class="admin-select-block clearfix grid_left">
                    <div>
                        <?php echo __l('Select:'); ?>
                        <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
                        <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
                        <?php echo $this->Html->link(__l('Unapproved'), '#', array('class' => 'js-admin-select-pending','title' => __l('Unapproved'))); ?>
                        <?php echo $this->Html->link(__l('Approved'), '#', array('class' => 'js-admin-select-approved','title' => __l('Approved'))); ?>
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
                endif;
            ?>
        <?
        echo $this->Form->end();
        ?>

</div>