<div>
    <?php
		echo $this->Form->create('User', array('action' => 'send_mail', 'class' => 'normal'));
		if(empty($this->request->data['Contact']['id'])):
			echo $this->Form->input('bulk_mail_option_id', array('empty' => __l('Select'), 'label' => __l('Bulk Mail Option')));
			echo $this->Form->autocomplete('send_to', array('id' => 'message-to',  'label'=> __l('Send To'), 'acFieldKey' => 'User.send_to_user_id',
                        				    'acFields' => array('User.email'),
    				                        'acSearchFieldNames' => array('User.email'),
                                            'maxlength' => '100', 'acMultiple' => true
                                           ));
	    else:
			 echo $this->Form->input('send_to', array('readonly' => 'readonly'));
			 echo $this->Form->input('Contact.id',array('type'=>'hidden'));
		endif;
        echo $this->Form->input('subject');
      	echo $this->Form->input('message', array('type' => 'textarea')); ?>
      	<div class="submit-block clearfix">
      	<?php
    	echo $this->Form->submit(__l('Send'));
		if(!empty($this->request->data['Contact']['id'])):
    ?>
	<div class="cancel-block">
            <?php echo $this->Html->link(__l('Cancel'), array('controller' => 'contacts', 'action' => 'index'), array('class' => 'cancel-link', 'title' => __l('Cancel'), 'escape' => false));?>
        </div>
    <?php endif; ?>
    </div>
    <?php
    	echo $this->Form->end();
    ?>
</div>