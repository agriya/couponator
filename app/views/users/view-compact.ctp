<div class="coupon-codes-block">
 <h3><?php echo ucfirst($user['User']['username']); ?></h3>
 	<div class="store-left">
        <div class="store-right">
        <div class="store-center coupon-center">
        		<div class="user-content-block clearfix">
        		  <div class="useravatar-block">
                     <?php echo $this->Html->showImage('UserAvatar', $user['UserAvatar'], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($user['User']['username'], false)), 'class' => 'profilePhoto', 'title' => $this->Html->cText($user['User']['username'], false)));?>
                    </div>
                     <ul class="profiles-link">
                         <li>
                           <?php echo $this->Html->link('View Profile', array('controller' => 'users','action' => 'view',$user['User']['username'])); ?>
                         </li>
                         <li> <?php echo $this->Html->link('Edit Profile', array('controller' => 'user_profiles','action' => 'edit',$user['User']['id']),array("id"=>"editProfileButton",'title' => 'Edit Profile')); ?></li>
                     </ul>
                </div>
             </div>
        	</div>
		</div>
	<div class="coupon-bottom"></div>
	</div>