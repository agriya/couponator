<div class="userProfiles form">
	<?php if($this->Auth->sessionValid() && $this->Auth->user('user_type_id') != ConstUserTypes::Admin){ ?>
    <h2><?php echo sprintf(__l('Edit Profile - %s'), $this->request->data['User']['username']); ?></h2>
    <?php } ?>
	<div class="store-left">
        	<div class="store-right">
        	<div class="store-center clearfix">
        	<div class="admin-inner-content-block">
            <div class="main-content-block js-corner round-5">
            
                <div class="form-blocks  js-corner round-5">
                    <?php echo $this->Form->create('UserProfile', array('action' => 'edit', 'class' => 'normal', 'enctype' => 'multipart/form-data'));?>
                	<fieldset>
                	<div class="profile-image">
                    <?php echo $this->Html->link($this->Html->showImage('UserAvatar', $this->request->data['UserAvatar'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($this->request->data['User']['username'], false)), 'title' => $this->Html->cText($this->request->data['User']['username'], false))), array('controller' => 'users', 'action' => 'view',  $this->request->data['User']['username'], 'admin' => false), array('escape' => false)); ?>
                    </div>
        		<?php
                if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
                    echo $this->Form->input('User.id');
                endif;
                if($this->request->data['User']['user_type_id'] == ConstUserTypes::Admin):
                    echo $this->Form->input('User.username');
                endif;
                echo $this->Form->input('first_name');
        		echo $this->Form->input('last_name');
        		echo $this->Form->input('middle_name');
        		echo $this->Form->input('gender_id', array('empty' => __l('Please Select'))); ?>
				<div class="input <?php if($this->request->data['User']['user_type_id'] == ConstUserTypes::Admin): ?> required <?php endif; ?> date-time end-date-time-block">
				<div class="js-datetime">
						<?php echo $this->Form->input('dob', array('label' => __l('DOB'), 'orderYear' => 'asc', 'maxYear' => date('Y') , 'minYear' => date('Y') - 100, 'div' => false, 'empty' => __l('Please Select'))); ?>
				</div>
			</div>
		

            <?php	echo $this->Form->input('about_me');
			?>
			<?php
        		if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):                  
                    echo $this->Form->input('User.is_active', array('label' => __l('Active')));                 
                endif;
        		echo $this->Form->input('UserAvatar.filename', array('type' => 'file','size' => '33', 'label' => 'Upload Photo','class' =>'browse-field'));
        	?>
        	</fieldset>
        	<div class="clearfix submit-block">
            <?php echo $this->Form->submit(__l('Update')); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        </div>
          </div>
                </div>
        	</div>
			</div>
			<div class="coupon-bottom"></div>
</div>