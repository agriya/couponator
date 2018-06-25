<div class="users form js-login-response ajax-login-block">
  <div class="login-block clearfix">
        <div class="store-left">
          <div class="store-right">
            <div class="store-center coupon-center">
	     <h2>Login</h2>
	<?php
		  echo $this->Form->create('User', array('action' => 'login','class' => 'normal'));
		//echo $this->Form->input(Configure::read('user.using_to_login'));
	 //   echo $this->Form->input('passwd', array('label' => __l('Password')));
        ?>
       
        <?php
		if(!(!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') and Configure::read('user.is_enable_openid')): 
	?>
		           
	<?php
			echo $this->Form->input('openid', array('id' => 'openid_identifier','class' => 'bg-openid-input', 'label' => __l('OpenID')));
			echo $this->Form->input('type', array('type' => 'hidden', 'value' => 'openid'));
		endif;
		?>
		<?php
		echo $this->Form->input('User.is_remember', array('type' => 'checkbox', 'label' => __l('Remember me on this computer.')));?>
	  	<div class="fromleft open-id-block"> 	<?php echo $this->Html->link(__l('Forgot your password?') , array('controller' => 'users', 'action' => 'forgot_password', 'admin'=>false),array('title' => __l('Forgot your password?'),'class'=>''));
	?>
	<?php if(!(!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin')):	?>
	<?php echo $this->Html->link(__l('Register'), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('class'=>'js-thickbox','title' => __l('Register'))); ?> | 
	<?php echo $this->Html->link(__l('Login'), array('controller' => 'users', 'action' => 'login'), array('class'=>'','title' => __l('Login')));
		endif;
        $f = (!empty($_GET['f'])) ? $_GET['f'] : (!empty($this->request->data['User']['f']) ? $this->request->data['User']['f'] : (($this->request->url != 'admin/users/login' && $this->request->url != 'users/login') ? $this->request->url : ''));
		if(!empty($f)) :
            echo $this->Form->input('f', array('type' => 'hidden', 'value' => $f));
        endif;
        ?>
        	</div>
        	
			<div class="clearfix submit-block">
				<?php echo $this->Form->submit(__l('Submit'));?>	
			</div> 
			<?php echo $this->Form->end();?>
				</div>
			 </div>		
        </div>
        <div class="coupon-bottom"></div>
      </div>
</div>
<script type="text/javascript" id="__openidselector" src="https://www.idselector.com/widget/button/1"></script>