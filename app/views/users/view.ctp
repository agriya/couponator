<?php /* SVN: $Id: view.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="user-view-information-block">
      <div class="user-view-block clearfix" >
      	<div class="store-left">
        	<div class="store-right">
        	<div class="store-center clearfix">
        		<div class="admin-inner-content-block">
            	 <div class="user-view-block-left-block">
                 <?php echo $this->Html->getUserAvatar($user['User']['id'], 'big_thumb'); ?>
                </div>
                 <div class="user-view-block-right-block">
                  
                         <ul class="community-menu">
              	             <li class="community-home"><?php echo $this->Html->link('Community', array('controller' => 'users','action' => 'index','shared'=>'shared'),array('title' => 'Community')); ?> </li>
            		      	 <?php if($this->Auth->sessionValid() && $this->Auth->user('id')==$user['User']['id']): ?>
            		      	<li class="community-edit"><?php echo $this->Html->link('Edit Profile', array('controller' => 'user_profiles','action' => 'edit', $user['User']['id']),array("id"=>"editProfileButton",'title' => 'Edit Profile')); ?>
            		      	 </li>
            			 <?php endif; ?>
            	       	</ul>
        	       	
                	 <h3 class="user-title">
                		 <?php
                		 echo $this->Html->cText($user['User']['username']);
                		 ?>
            		 </h3>
        			<div class="user-links">
        			
        				<?php $url = Router::url(array('controller' => 'users','action' => 'view',$user['User']['username']) , true);
        				echo $this->Html->link($url, $url,array('title' => $this->Auth->user('username')));
        				?>
        			</div>
        			<div class="user-description">
                    	<?php
        				echo $user['UserProfile']['about_me'];?>
        				</div>

        	    	<p class="gender-info">
            		  <?php  echo $user['User']['username'].__l(" joined the community")."  ".$this->Time->timeAgoInWords($user['User']['created']);
            		  if(!empty($user['Gender'])){ echo __l(" and is a ").$user['Gender']['name']; } ?>
                  </p>
                 </div>
                </div>
                </div>
        	</div>
			</div>
			<div class="coupon-bottom"></div>
       </div>
  

			<?php   echo $this->element('user_comment-index', array('config' => 'sec', 'user_id' => $user['User']['id'])); ?>               
   
   

     

      <h2><span><?php echo $user['User']['username'].'\'s Activity'; ?></span></h2>
      <div class="store-left">
        	<div class="store-right">
            	<div class="store-center clearfix">
            		<div class="admin-inner-content-block">
                    	<?php  echo $this->element('coupon_user-index', array('config' => 'sec', 'user_id' => $user['User']['id'])); ?>
               
		

	<?php   echo $this->element('coupon_user-index', array('config' => 'sec', 'user_id' => $user['User']['id'],'vote'=>'up')); ?>               
		<?php   echo $this->element('coupon_user-index', array('config' => 'sec', 'user_id' => $user['User']['id'],'vote'=>'down')); ?>            


    	<?php  echo $this->element('coupon_comments-index', array('user_id' => $user['User']['id'], 'config' => 'sec')); ?>	 
     </div>
                </div>
          </div>
        </div>
        <div class="coupon-bottom"></div>
 </div>