<?php /* SVN: $Id: admin_index.ctp 4852 2010-05-12 12:58:27Z aravindan_111act10 $ */ ?>
<div class="users index js-response js-responses">
<ul class="filter-list clearfix">

		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) { echo 'class="active"';} ?>>
			<span class="active" title="<?php echo __l('Active'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Active'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false));?></span> 
		</li>
        <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) { echo 'class="active"';} ?>>
			<span class="inactive" title="<?php echo __l('Inactive'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Inactive'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false));?></span>
        </li>
    	<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::OpenID) { echo 'class="active"';} ?>>
			<span class="site" title="<?php echo __l('OpenID'); ?>"><?php echo $this->Html->link($this->Html->cInt($openid,false).'<span>' .__l('OpenID'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::OpenID), array('escape' => false));?></span>
		</li>
	    <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Gmail) { echo 'class="active"';} ?>>
       		<span class="openid" title="<?php echo __l('Gmail'); ?>"><?php echo $this->Html->link($this->Html->cInt($gmail,false).'<span>' .__l('Gmail'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Gmail), array('escape' => false));?></span>
		</li>
		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Yahoo) { echo 'class="active"';} ?>>
  		    <span class="facebook" title="<?php echo __l('Yahoo'); ?>"><?php echo $this->Html->link($this->Html->cInt($yahoo,false).'<span>' .__l('Yahoo'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Yahoo), array('escape' => false));?></span>
		</li>
		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Facebook) { echo 'class="active"';} ?>>
            <span class="twitter" title="<?php echo __l('Facebook'); ?>"><?php echo $this->Html->link($this->Html->cInt($facebook,false).'<span>' .__l('Facebook'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Facebook), array('escape' => false));?></span>
		</li>
		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Twitter) { echo 'class="active"';} ?>>
			<span class="gmail" title="<?php echo __l('Twitter'); ?>"><?php echo $this->Html->link($this->Html->cInt($twitter,false).'<span>' .__l('Twitter'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Twitter), array('escape' => false));?></span>
		</li>
		<li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>>
     		<span class="total-user" title="<?php echo __l('Total'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending + $approved,false).'<span>' .__l('Total'). '</span>', array('controller'=>'users','action'=>'index'), array('escape' => false));?></span>
		</li>
</ul>
<?php echo $this->element('paging_counter'); ?>
<div class="clearfix">
<div class="grid_left">
        <?php echo $this->Form->create('User', array('class' => 'normal search-form clearfix', 'action'=>'index')); ?>			
			<?php echo $this->Form->input('user_type_id',array('label' => __l('User Type'), 'empty' => __l('Please Select'),'div' =>'input select user-select')); ?>
            <?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
		<div class="clearfix submit-block">
			<?php echo $this->Form->submit(__l('Search'));?>
		</div>

	<?php echo $this->Form->end(); ?>
</div>
	<div class="add-block grid_right">
    	<?php echo $this->Html->link(__l('Add'), array('controller' => 'users', 'action' => 'add'), array('class' => 'add','title'=>__l('Add'))); ?>
        <?php echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'users', 'action' => 'index', 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export')); ?>
    </div>
</div>

<?php   echo $this->Form->create('User' , array('class' => 'normal','action' => 'update'));?>
<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>

<div class="overflow-block">
<table class="list">
	<tr>
		<th rowspan="2" class="select dc"><?php echo __l('Select'); ?></th>
		<th rowspan="2" class="actions dc"><?php echo __l('Action'); ?></th>		
		<th rowspan="2" class="dl"><?php echo $this->Paginator->sort(__l('User'),'username'); ?></th>
		<th rowspan="2" class="dc"><?php echo $this->Paginator->sort(__l('View count'), 'User.user_view_count'); ?></th>
		<th colspan="3" class="dc"><div class=""><?php echo $this->Paginator->sort(__l('Logins'), 'User.user_login_count'); ?></div></th>
		<th rowspan="2" class="dc"><div class=""><?php echo __l('Registered On'); ?></div></th>
	</tr>
	 <tr>		
		<th class="dc"><div class=""><?php echo $this->Paginator->sort(__l('Count'), 'User.user_login_count'); ?></div></th>
		<th class="dc"><div class=""><?php echo $this->Paginator->sort(__l('Time'), 'User.last_logged_in_time'); ?></div></th>
		<th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('IP'), 'LastLoginIp.ip'); ?></div></th>
	 </tr>	
  <?php
                if (!empty($users)):
                $i = 0;
                foreach ($users as $user):
                    $class = null;
					$active_class = '';
                    if ($i++ % 2 == 0):
                        $class = 'altrow';
                    endif;
					$email_active_class = ' email-not-comfirmed';
					if($user['User']['is_email_confirmed']):
						$email_active_class = ' email-comfirmed';
					endif;
                    if($user['User']['is_active']):
                        $status_class = 'js-checkbox-active';
                    else:
						$active_class = ' inactive-record';
                        $status_class = 'js-checkbox-inactive';
                    endif;
                    $online_class = 'offline';
                    if (!empty($user['CkSession']['user_id'])) {
                        $online_class = 'online';
                    }
                ?>

 <tr class="<?php echo $class.$active_class;?>">
		<td><?php echo $this->Form->input('User.'.$user['User']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$user['User']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
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
                        <?php if(Configure::read('user.is_email_verification_for_register') and (!$user['User']['is_active'] or !$user['User']['is_email_confirmed'])): ?>
            			<li>	<?php echo $this->Html->link(__l('Resend Activation'), array('controller' => 'users', 'action'=>'resend_activation', $user['User']['id'], 'admin' => false),array('class'=>'resend','title' => __l('Resend Activation'))); ?></li>
            			<?php endif;?>
            			<li><?php echo $this->Html->link(__l('Edit'), array('controller' => 'user_profiles', 'action'=>'edit', $user['User']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></li>
                        <?php if($user['User']['user_type_id'] != ConstUserTypes::Admin){ ?>
                            <li><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $user['User']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></li>
                        <?php } ?>
                         <li><?php echo $this->Html->link(__l('Change password'), array('controller' => 'users', 'action'=>'admin_change_password', $user['User']['id']), array('class'=>'password','title' => __l('Change password')));?></li>
					 </ul>
					</div>
					<div class="action-bottom-block"></div>
				  </div>

				 </div>

        </td>
        	<?php
			$reg_type_class='normal';

			if(!empty($user['User']['fb_user_id'])):
				$reg_type_class='facebook';
			 endif;
			 if(!empty($user['User']['twitter_user_id'])):
				$reg_type_class='twitter';
			 endif;
			 if(!empty($user['User']['is_gmail_register'])):
				$reg_type_class='open-id-gmail-thumb';
			 endif;
			 if(!empty($user['User']['is_yahoo_register'])):
				$reg_type_class='open-id-yahoo-thumb';
			 endif;
			 if(!empty($user['User']['is_openid_register'])):
				$reg_type_class='open-id-thumb';
			 endif;
			?>
			  <td class="users-actions dl">
                        <div class="clearfix user-info-block">
                        <p class="user-img-left grid_left">
                        	<?php
						$chnage_user_info = $user['User'];
							$user['User']['full_name'] = (!empty($user['UserProfile']['first_name']) || !empty($user['UserProfile']['last_name'])) ? $user['UserProfile']['first_name'] . ' ' . $user['UserProfile']['last_name'] :  $user['User']['username'];
						echo $this->Html->getUserAvatar($chnage_user_info['id'], 'micro_thumb',false);
						?>
                            <?php
                                 echo $this->Html->getUserLink($user['User']);
                            ?>
                            </p>
                              <p class="user-img-right grid_right">

                       <?php if($user['User']['user_type_id'] == ConstUserTypes::Admin):?>
								<span class="admin"> <?php echo __l('Admin'); ?> </span>
						<?php endif; ?>
						</p>
                        </div>
                        <div class="clearfix user-status-block user-info-block">
                        <?php
							if(!empty($user['UserProfile']['Country'])):
								?>
                                <span class="flags flag-<?php echo strtolower($user['UserProfile']['Country']['iso2']); ?>" title ="<?php echo $user['UserProfile']['Country']['name']; ?>">
									<?php echo $user['UserProfile']['Country']['name']; ?>
								</span>
                                <?php
	                        endif;
						?>
						
                        <?php if($user['User']['is_openid_register']):?>
								<span class="open-id" title="OpenID"> <?php echo __l('OpenID'); ?> </span>
						<?php endif; ?>
                        <?php if($user['User']['is_gmail_register']):?>
								<span class="gmail" title="Gmail"> <?php echo __l('Gmail'); ?> </span>
						<?php endif; ?>
                        <?php if($user['User']['is_yahoo_register']):?>
								<span class="yahoo" title="Yahoo"> <?php echo __l('Yahoo'); ?> </span>
						<?php endif; ?>
                        <?php if($user['User']['is_facebook_register']):?>
								<span class="facebook" title="Facebook"> <?php echo __l('Facebook'); ?> </span>
						<?php endif; ?>
                        <?php if($user['User']['is_twitter_register']):?>
								<span class="twitter" title="Twitter"> <?php echo __l('Twitter'); ?> </span>
						<?php endif; ?>
                         <?php if(!empty($user['User']['email'])):?>
								<span class="email <?php echo $email_active_class; ?>" title="<?php echo $user['User']['email']; ?>">
								<?php
								if(strlen($user['User']['email'])>20) :
									echo '..' . substr($user['User']['email'], strlen($user['User']['email'])-15, strlen($user['User']['email']));
								else:
									echo $user['User']['email'];
								endif;
								?>
                                </span>
						<?php endif; ?>
						</div>
                        </td>
		<td class="dc"><?php echo $this->Html->link($this->Html->cInt($user['User']['user_view_count'], false), array('controller' => 'user_views', 'action' => 'index', 'username' => $user['User']['username']));?></td>
        <td class="dc"><?php echo $this->Html->link($this->Html->cInt($user['User']['user_login_count'], false), array('controller' => 'user_logins', 'action' => 'index', 'username' => $user['User']['username']));?></td>
		<td class="dc">
			<?php if($user['User']['last_logged_in_time'] == '0000-00-00 00:00:00' || empty($user['User']['last_logged_in_time'])){
				echo '-';
			}else{
				echo $this->Html->cDateTimeHighlight($user['User']['last_logged_in_time']);
			}?>
		</td>
		<td class="dl">
			<?php if(!empty($user['LastLoginIp']['ip'])): ?>							  
				<?php echo  $this->Html->link($user['LastLoginIp']['ip'], array('controller' => 'users', 'action' => 'whois', $user['LastLoginIp']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$user['LastLoginIp']['host'], 'escape' => false));							
				?>
				<p>
				<?php 					
				if(!empty($user['LastLoginIp']['Country'])):
					?>
					<span class="flags flag-<?php echo strtolower($user['LastLoginIp']['Country']['iso2']); ?>" title ="<?php echo $user['LastLoginIp']['Country']['name']; ?>">
						<?php echo $user['LastLoginIp']['Country']['name']; ?>
					</span>
					<?php
				endif; 
				 if(!empty($user['LastLoginIp']['City'])):
				?>             
				<span> 	<?php echo $user['LastLoginIp']['City']['name']; ?>    </span>
				<?php endif; ?>
				</p>
			<?php else: ?>
				<?php echo __l('N/A'); ?>
			<?php endif; ?>    
		</td>		
		<td class="dc"><?php echo $this->Html->cDateTime($user['User']['created']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="14" class="notice"><?php echo __l('No users available');?></td>
	</tr>
<?php
endif;
?>
</table>
</div>
<?php
if (!empty($users)):
?>
       <div class="clearfix">
       <div class="admin-select-block grid_left">
            <div>
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
				<?php echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-admin-select-pending', 'title' => __l('Inactive'))); ?>
				<?php echo $this->Html->link(__l('Active'), '#', array('class' => 'js-admin-select-approved', 'title' => __l('Active'))); ?>
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