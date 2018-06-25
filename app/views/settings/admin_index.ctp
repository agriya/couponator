<ul class="setting-links clearfix">
	<?php foreach ($setting_categories as $setting_category): ?>
		<li class="grid_12 omega alpha">
			<div class="setting-details-info setting-category-<?php echo $setting_category['SettingCategory']['id']; ?>">
				<h3><?php echo $this->Html->link($this->Html->cText($setting_category['SettingCategory']['name'], false), array('controller' => 'settings', 'action' => 'edit', $setting_category['SettingCategory']['id']), array('title' => $setting_category['SettingCategory']['name'], 'escape' => false)); ?></h3>
				<div class="js-truncate">
					<?php echo $setting_category['SettingCategory']['description']; ?>
				</div>
			</div>
		</li>
	<?php endforeach; ?>
</ul>