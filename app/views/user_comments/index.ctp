<?php /* SVN: $Id: index.ctp 5937 2010-05-11 02:17:51Z sadeesh_115act10 $ */ ?>
<div class="js-response">
	<h2><span><?php echo __l("Comments for "); ?> <?php echo $username ; ?>:</span></h2>
	<div class="store-left">
		<div class="store-right">
			<div class="store-center clearfix">
				<div class="comments-inner-block">
					<?php if ($this->request->params['named']['user_id'] != $this->Auth->user('id')): ?>
						<?php if(!empty($userComments)): ?>
							<ul class="community-menu clearfix">
								<li class="write-comments">
									<?php echo $this->Html->link(__l('Leave a comment'), array('controller' =>'user_comments' ,'action' => 'add',$username),array('title' => __l('Leave a comment'),'class'=>'js-thickbox')); ?>
								</li>
							</ul>
						<?php endif; ?>
					<?php endif; ?>
					<ol class="comments">
						<?php if(!empty($userComments)): ?>
							<?php foreach ($userComments as $userComment): ?>
								<li>
								<div class="clearfix">
									<?php
										$userComment['User']['UserAvatar'] = !empty($userComment['User']['UserAvatar']) ? $userComment['User']['UserAvatar'] : array();
									?>
									<div class="avatar">
										<?php
											echo $this->Html->link($this->Html->showImage('UserAvatar', $userComment['User']['UserAvatar'], array('dimension' => 'nano_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($userComment['User']['username'], false)), 'title' => $this->Html->cText($userComment['User']['username'], false))), array('controller' => 'users', 'action' => 'view',  $userComment['User']['username'], 'admin' => false), array('escape' => false)); 
										?>
									</div>
									<div class="comment-desc">
									<p class="user-comments"><?php echo $userComment['UserComment']['comment']; ?></p>
									<p class="attribution"><?php echo  $userComment['User']['username'] . __l(' posted this ') . $this->Time->timeAgoInWords($userComment['UserComment']['created']); ?></p>
									</div>
									</div>
									<?php if ($this->Auth->sessionValid() && ($userComment['UserComment']['user_id'] == $this->Auth->user('id') && $userComment['UserComment']['user_id']!=0) || $this->Auth->user('user_type_id') == ConstUserTypes::Admin ) : ?>
										<div class="actions">
											<?php echo $this->Html->link(__l('Delete'), array('controller' => 'user_comments', 'action' => 'delete', $userComment['UserComment']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?>
										</div>
									<?php endif; ?>
									
								</li>
							<?php endforeach; ?>
						<?php else: ?>
							<li class="notice">
								<h4><?php echo __l('No comments available'); ?></h4>
								<?php if ($this->request->params['named']['user_id'] != $this->Auth->user('id')): ?>
									<span><?php	echo $this->Html->link(__l('Leave a comment for ').$username, array('controller' =>'user_comments' ,'action' => 'add',$username),array('title' => __l('Leave a comment'),'class'=>'js-thickbox')); ?></span>
								<?php endif; ?>
							</li>
						<?php endif; ?>
					</ol>
					<?php
						if (!empty($userComments)) {
							echo $this->element('paging_links');
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="coupon-bottom"></div>
</div>