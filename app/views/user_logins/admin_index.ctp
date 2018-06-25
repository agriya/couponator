<?php /* SVN: $Id: admin_index.ctp 4648 2010-05-07 03:28:35Z vidhya_112act10 $ */ ?>
<div class="userLogins index js-response">
  
     <div class="page-count-block clearfix">
		 <div class="grid_left">
			<?php echo $this->element('paging_counter');?>
		 </div>
		<div class="grid_left">
			<?php echo $this->Form->create('UserLogin' , array('class' => 'normal search-form','action' => 'index')); ?>
			<div class="filter-section clearfix">
					<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
					<?php echo $this->Form->submit(__l('Search'));?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
    <?php echo $this->Form->create('UserLogin' , array('class' => 'normal','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>

    <table class="list">
        <tr>
            <th class="dc"><?php echo __l('Select'); ?></th>
            <th class="actions dc"><?php echo __l('Actions');?></th>
            <th class="dc"><?php echo $this->Paginator->sort(__l('Login Time'), 'created');?></th>
            <th class="dl"><?php echo $this->Paginator->sort(__l('Username'), 'User.username');?></th>
            <th class="dl"><?php echo __l('IP');?></th>
            <th class="dl"><?php echo $this->Paginator->sort(__l('User agent'),'UserLogin.user_agent');?></th>
        </tr>
        <?php
           if (!empty($userLogins)):
            $i = 0;
            foreach ($userLogins as $userLogin):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                ?>
                <tr<?php echo $class;?>>
                    <td><?php echo $this->Form->input('UserLogin.'.$userLogin['UserLogin']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userLogin['UserLogin']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
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
                                        <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $userLogin['UserLogin']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
						            </li>
						            <li>
                                         <span><?php echo $this->Html->link(__l('Ban Login IP'), array('controller'=> 'banned_ips', 'action' => 'add', $userLogin['UserLogin']['user_login_ip_id']), array('class' => 'network-ip','title'=>__l('Ban Login IP'), 'escape' => false));?></span>
                                    </li>
        						 </ul>
        						</div>
        						<div class="action-bottom-block"></div>
							  </div>
							 </div>
                    </td>
                    
                    <td class="dc"><?php echo $this->Html->cDateTime($userLogin['UserLogin']['created']);?></td>
                    <td class="dl"><?php echo $this->Html->link($this->Html->cText($userLogin['User']['username']), array('controller'=> 'users', 'action'=>'view', $userLogin['User']['username'], 'admin' => false), array('escape' => false));?></td>
                    <td class="dl">
                        <?php if(!empty($userLogin['Ip']['ip'])): ?>							  
                            <?php echo  $this->Html->link($userLogin['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $userLogin['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$userLogin['Ip']['host'], 'escape' => false));								
							?>
							<p>
							<?php 					
                            if(!empty($userLogin['Ip']['Country'])):
                                ?>
                                <span class="flags flag-<?php echo strtolower($userLogin['Ip']['Country']['iso2']); ?>" title ="<?php echo $userLogin['Ip']['Country']['name']; ?>">
									<?php echo $userLogin['Ip']['Country']['name']; ?>
								</span>
                                <?php
                            endif; 
							 if(!empty($userLogin['Ip']['City'])):
                            ?>             
                            <span> 	<?php echo $userLogin['Ip']['City']['name']; ?>    </span>
                            <?php endif; ?>
                            </p>
                        <?php else: ?>
							<?php echo __l('N/A'); ?>
						<?php endif; ?>    
						</td>
                    <td class="dl"><?php echo $this->Html->cText($userLogin['UserLogin']['user_agent']);?></td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="6" class="notice"><?php echo __l('No User Logins available');?></td>
            </tr>
            <?php
        endif;
        ?>
    </table>

    <?php
    if (!empty($userLogins)) :
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