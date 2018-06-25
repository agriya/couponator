<div class="users stats js-response js-responses clearfix js-admin-stats-block">
	<div class="grid_19 omega alpha">
	<?php echo $this->element('admin-charts-stats'); ?>
    </div>
       <div class="grid_5 dashboard-side2 omega alpha grid_right">
    <div class="dashboard-center-block">
    <div class="admin-side1-tl ">
                <div class="admin-side1-tr">
                  <div class="admin-side1-tc">
                    <h2><?php echo __l('Timings'); ?></h2>
                  </div>
                </div>
            </div>
		<div class="admin-center-block dashboard-center-block">
            <div class="admin-dashboard-links">
                <p>
                	<?php $title = ' title="' . strftime(Configure::read('site.datetime.tooltip') , strtotime('now')) . ' ' . Configure::read('site.timezone_offset') . '"'; ?>
                    <?php echo __l('Current time: '); ?><span <?php echo $title; ?>><?php echo strftime(Configure::read('site.datetime.format')); ?></span>
                </p>
                <p>
                    <?php echo __l('Last login: '); ?><?php echo $this->Html->cDateTimeHighlight($this->Auth->user('last_logged_in_time')); ?>
                </p>
            </div>
		</div>
	</div>
    <div class="dashboard-center-block">
      <div class="admin-side1-tl ">
                <div class="admin-side1-tr">
                  <div class="admin-side1-tc">
                    <h2><?php echo __l('Recently registered users'); ?></h2>
                  </div>
                </div>
            </div>
    	<div class="admin-center-block dashboard-center-block">
            <?php
                if (!empty($recentUsers)):
                    $users = '';
                    foreach ($recentUsers as $user):
						$users .= sprintf('%s, ',$this->Html->link($this->Html->cText($user['User']['username'], false), array('controller'=> 'users', 'action' => 'view', $user['User']['username'], 'admin' => false)));
					endforeach;
					echo substr($users, 0, -2);
				else:
			?>
				<p class="notice"><?php echo __l('Recently no users registered');?></p>
			<?php
				endif;
			?>
		</div>
	</div>
    <div class="dashboard-center-block">
     <div class="admin-side1-tl ">
        <div class="admin-side1-tr">
          <div class="admin-side1-tc">
            <h2><?php echo __l('Online users'); ?></h2>
          </div>
        </div>
        </div>
        <div class="admin-center-block dashboard-center-block">
            <?php
                if (!empty($onlineUsers)):
                    $users = '';
                    foreach ($onlineUsers as $user):
						$users .= sprintf('%s, ',$this->Html->link($this->Html->cText($user['User']['username'], false), array('controller'=> 'users', 'action' => 'view', $user['User']['username'], 'admin' => false)));
					endforeach;
					echo substr($users, 0, -2);
				else:
			?>
					<p class="notice"><?php echo __l('Recently no users online');?></p>
			<?php
				endif;
			?>
		</div>
	</div>
        <div class="dashboard-center-block">
    <div class="admin-side1-tl ">
                <div class="admin-side1-tr">
                  <div class="admin-side1-tc">
                     <h2><?php echo Configure::read('site.name'); ?></h2>
                  </div>
                </div>
            </div>
		<div class="admin-center-block dashboard-center-block">
              <div class="admin-dashboard-links">
                <h4 class="version-info">
                    <?php echo __l('Version').' ' ?>
					<span>
					<?php echo Configure::read('site.version'); ?>
					</span>
                </h4>
                <p>
                    <?php echo $this->Html->link(__l('Product Support'), 'http://customers.agriya.com/', array('target' => '_blank', 'title' => __l('Product Support'))); ?>
                </p>
                <p>
                    <?php echo $this->Html->link(__l('Product Manual'), 'http://dev1products.dev.agriya.com/doku.php?id=couponator' ,array('target' => '_blank','title' => __l('Product Manual'))); ?>
                </p>
                <p>
                    <?php echo $this->Html->link(__l('CSSilize'), 'http://www.cssilize.com/', array('target' => '_blank', 'title' => __l('CSSilize'))); ?>
					<small><?php echo __l("PSD to XHTML Conversion and ") . Configure::read('site.name') .__l(" theming");?></small>
                </p>
                <p>
                    <?php echo $this->Html->link(__l('Agriya Blog'), 'http://blogs.agriya.com/' ,array('target' => '_blank','title' => __l('Agriya Blog'))); ?>
					<small>Follow Agriya news</small>
                </p>
            </div>
		</div>
	</div>

</div>
 </div>

