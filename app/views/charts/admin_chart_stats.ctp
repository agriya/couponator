<div class="js-cache-load  {'chart_block':'admin-dashboard-user<?php echo ConstUserTypes::User; ?>', 'data_loading':'div.js-loadadmin-chart-users-ctp',  'data_url':'admin/charts/chart_users/is_ajax_load:1/user_type_id:<?php echo ConstUserTypes::User; ?>'}">
	<?php echo $this->element('chart-admin_chart_users', array('user_type_id'=> ConstUserTypes::User)); ?>
</div>
<?php echo $this->element('chart-admin_chart_user_logins', array('user_type_id'=> ConstUserTypes::User)); ?>
<?php echo $this->element('chart-admin_chart_coupons');?>
<?php echo $this->element('chart-admin_chart_stores');?>