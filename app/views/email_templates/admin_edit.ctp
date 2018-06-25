<div class="js-responses">
<h2><?php echo $this->Html->cText($this->request->data['EmailTemplate']['name'], false); ?></h2>
<?php
	echo $this->Form->create('EmailTemplate', array('id' => 'EmailTemplateAdminEditForm'.$this->request->data['EmailTemplate']['id'], 'class' => 'normal js-insert js-ajax-form', 'action' => 'edit'));
	echo $this->Form->input('id');
	echo $this->Form->input('from', array('id' => 'EmailTemplateFrom'.$this->request->data['EmailTemplate']['id'], 'help' => __l('(e.g. "displayname &lt;email address>")')));
	echo $this->Form->input('reply_to', array('id' => 'EmailTemplateReplyTo'.$this->request->data['EmailTemplate']['id'], 'help' => __l('(e.g. "displayname &lt;email address>")')));
	echo $this->Form->input('subject', array('class' => 'js-email-subject', 'id' => 'EmailTemplateSubject'.$this->request->data['EmailTemplate']['id']));
	echo $this->Form->input('email_content', array('class' => 'js-email-content', 'id' => 'EmailTemplateEmailContent'.$this->request->data['EmailTemplate']['id']));
    ?>
    <div class="submit-block clearfix">
    <?php
	echo $this->Form->submit(__l('Update'));
?>
</div>
 <?php
	echo $this->Form->end();
?>
</div>