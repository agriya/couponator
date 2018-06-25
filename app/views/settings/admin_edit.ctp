<div>
	<?php if (!empty($setting_categories['SettingCategory']['description'])):?>
		<div class=" info-details"><?php echo $setting_categories['SettingCategory']['description']; ?></div>
	<?php endif;?>
	<?php
		if (!empty($settings)):
			echo $this->Form->create('Setting', array('action' => 'edit', 'class' => 'normal setting-add-form add-live-form'));
			echo $this->Form->input('setting_category_id', array('label' => __l('Setting Category'),'type' => 'hidden'));
			// hack to delete the thumb folder in img directory
			$inputDisplay = 0;
			$is_changed = $prev_cat_id = 0;
			foreach ($settings as $setting):
				if($setting['Setting']['name'] == 'site.language'):
					$empty_language = 0;
					$get_language_options = $this->Html->getLanguage();
					if(!empty($get_language_options)):
						$options['options'] = $get_language_options;
					else:
						$empty_language = 1;
					endif;
				endif;
				$field_name = explode('.', $setting['Setting']['name']);
				if(isset($field_name[2]) && ($field_name[2] == 'is_not_allow_resize_beyond_original_size' || $field_name[2] == 'is_handle_aspect')){
					continue;
				}
				$options['type'] = $setting['Setting']['type'];
				$options['value'] = $setting['Setting']['value'];
				$options['div'] = array('id' => "setting-{$setting['Setting']['name']}");
				if($options['type'] == 'checkbox' && $options['value']):
					$options['checked'] = 'checked';
				endif;
				if($options['type'] == 'select'):
					$selectOptions = explode(',', $setting['Setting']['options']);
					$setting['Setting']['options'] = array();
					if(!empty($selectOptions)):
						foreach($selectOptions as $key => $value):
							if(!empty($value)):
								$setting['Setting']['options'][trim($value)] = trim($value);
							endif;
						endforeach;
					endif;
					$options['options'] = $setting['Setting']['options'];
				endif;
				if(empty($prev_cat_id)){
					$prev_cat_id = $setting['SettingCategory']['id'];
					$is_changed = 1;
				} else {
					$is_changed = 0;
					if ($setting_categories['SettingCategory']['id'] != 16 && $setting['SettingCategory']['id'] != $prev_cat_id ) {
	?>
	</fieldset>
	<?php
						$is_changed = 1;
						$prev_cat_id  = $setting['SettingCategory']['id'];
					}
				}
	?>
	<?php
				if(!empty($is_changed)):
					if($setting_categories['SettingCategory']['id'] != 12) :
	?>
		<fieldset  class="form-block">
			<h3 id="<?php echo str_replace(' ','',$setting['SettingCategory']['name']); ?>"> <?php echo $setting['SettingCategory']['name']; ?></h3>
			<?php if (!empty($setting['SettingCategory']['description']) && $setting_categories['SettingCategory']['id'] != 16):?>
				<div class=" info-details">
					<?php						
						$findReplace = array(
							'##TRANSLATIONADD##' => $this->Html->link(Router::url('/', true) . '/admin/translations/add', Router::url('/', true) . '/admin/translations/add', array('title' => __l('Translations add'))),
						);
						$setting['SettingCategory']['description'] = strtr($setting['SettingCategory']['description'], $findReplace);
						echo $setting['SettingCategory']['description'];
					?>
				</div>
			<?php endif;?>
		<?php
				endif;
			endif;
		?>
		<?php if (in_array( $setting['Setting']['id'], array(229, 224, 241, 176, 179, 242))) : ?>
			<h3>
				<?php echo (in_array($setting['Setting']['id'], array(229, 176)))? __l('Application Info') : ''; ?>
				<?php echo (in_array($setting['Setting']['id'], array(224, 179)))? __l('Credentials') : ''; ?>
				<?php echo (in_array($setting['Setting']['id'], array(241, 242)))? __l('Other Info') : ''; ?>
			</h3>
			<?php if(in_array( $setting['Setting']['id'], array(224, 179))):?>
				<div class=" info-details">
					<?php 
						if($setting['Setting']['id'] == 224) :
							echo __l('Here you can update Facebook credentials . Click \'Update Facebook Credentials\' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.');
						elseif($setting['Setting']['id'] == 179) :
							echo __l('Here you can update Twitter credentials like Access key and Accss Token. Click \'Update Twitter Credentials\' link below and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.');
						endif;
					?>
				</div>
			<?php endif;?>
			<?php if($setting['Setting']['id'] == 224): ?>
				<div class="clearfix credentials-info-block">
					<div class="credentials-left">
						<div class="credentials-right">
							<?php echo $this->Html->link(__l('<span>Update Facebook Credentials</span>'), $fb_login_url, array('escape'=>false,'class' => 'facebook-link', 'title' => __l('Here you can update Facebook credentials . Click this link and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.'))); ?>
						</div>
					</div>
					<div class="credentials-right-block">
			<?php elseif($setting['Setting']['id'] == 179): ?>
				<div class="clearfix credentials-info-block">
					<div class="credentials-left">
						<div class="credentials-right">
							<?php
								echo $this->Html->link(__l('<span>Update Twitter Credentials</span>'), $tw_login_url, array('escape'=>false,'class' => 'twitter-link', 'title' => __l('Here you can update Twitter credentials like Access key and Accss Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.')));
							?>
						</div>
					</div>
					<div class="credentials-right-block">
			<?php endif; ?>
		<?php endif; ?>
		<?php
			if($setting['Setting']['name'] == 'twitter.site_user_access_key' || $setting['Setting']['name'] == 'twitter.site_user_access_token' || $setting['Setting']['name'] == 'facebook.fb_access_token' || $setting['Setting']['name'] == 'facebook.fb_user_id'):
				$options['readonly'] = TRUE;
				$options['class'] = 'disabled';		
			endif;				
			if($setting['Setting']['name'] == 'site.language'):						
				$options['options'] = $this->Html->getLanguage();
			endif;
			$options['label'] = $setting['Setting']['label'];
			if (($setting['SettingCategory']['id'] == 46 || $setting['SettingCategory']['id'] == 43) && $setting['Setting']['id'] != 103  && $inputDisplay == 0):
				$options['class'] = 'image-settings';
				echo '<div class="outer-image-settings clearfix">';
			elseif(($setting['SettingCategory']['id'] == 46 || $setting['SettingCategory']['id'] == 43) && $setting['Setting']['id'] != 103):
				$options['class'] = 'image-settings image-settings-height';
			endif;	
			$findReplace = array(
				'##SITE_NAME##' => Configure::read('site.name'),
				'##USER_LOGIN##' => $this->Html->link(Router::url('/', true) . '/admin/user_logins', Router::url('/', true) . '/admin/user_logins', array('title' => __l('User Logins'))),
				'##REGISTER##' => $this->Html->link('registration', '#', array('title' => __l('registration'))),
			);
			$setting['Setting']['description'] = strtr($setting['Setting']['description'], $findReplace);
			if (!empty($setting['Setting']['description']) && empty($options['after'])):
				$options['help'] = "{$setting['Setting']['description']}";
			endif;
		?>
		<?php echo $this->Form->input("Setting.{$setting['Setting']['id']}.name", $options); ?>
		<?php
			if(($setting['SettingCategory']['id'] == 46 || $setting['SettingCategory']['id'] == 43) && $setting['Setting']['id'] != 103 && $inputDisplay == 2):
				echo '</div>';
			endif;
			$inputDisplay = ($inputDisplay == 2) ? 0 : $inputDisplay;
			unset($options);
			if (in_array($setting['Setting']['id'], array(195, 314))) {
		?>
			</div>
		</div>
		<?php
			}
			endforeach;
		?> 
	</fieldset>
	<?php
		if (!empty($beyondOriginals)) {
			echo $this->Form->input('not_allow_beyond_original', array('label' => __l('Not Allow Beyond Original'),'type' => 'select', 'multiple' => 'multiple', 'options' => $beyondOriginals));
        }
        if (!empty($aspects)) {
            echo $this->Form->input('allow_handle_aspect', array('label' => __l('Allow Handle Aspect'),'type' => 'select', 'multiple' => 'multiple', 'options' => $aspects));
        }
	?>
	<div class="submit-block clearfix">
		<?php echo $this->Form->end('Update'); ?>
	</div>
	<?php
		else:
	?>
		<div class="notice"><?php echo __l('No settings available'); ?></div>
	<?php
		endif;
	?>
</div>