<?php /* SVN: $Id: $ */ ?>
<div class="googleAds index js-response js-responses">
<ul class="filter-list clearfix">

		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) { echo 'class="active"';} ?>>
			<span class="active" title="<?php echo __l('Active'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Active'). '</span>', array('controller'=>'google_ads','action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false));?></span> 
		</li>
        <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) { echo 'class="active"';} ?>>
			<span class="inactive" title="<?php echo __l('Inactive'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Inactive'). '</span>', array('controller'=>'google_ads','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false));?></span>
        </li>    	
		<li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>>
     		<span class="yahoo round-5" title="<?php echo __l('Total'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending + $approved,false).'<span>' .__l('Total'). '</span>', array('controller'=>'google_ads','action'=>'index'), array('escape' => false));?></span>
		</li>
</ul>
<div class="clearfix">
<div class="grid_left">
<?php echo $this->element('paging_counter');?>
</div>
<div class="add-block clearfix grid_right">
<?php echo $this->Html->link(__l('Add Ads'), array('controller' => 'google_ads', 'action' => 'add'),array('class' => 'add', 'title' => __l('Google Add'))); ?>
</div>
</div>
<div class="overflow-block">
<table class="list">
    <tr>
        <th class="actions dc"><?php echo __l('Actions');?></th>
        <th class="dc"><?php echo $this->Paginator->sort('created');?></th>
        <th class="dl"><?php echo $this->Paginator->sort('name');?></th>
        <th class="dl"><?php echo $this->Paginator->sort('content');?></th>
    </tr>
<?php
if (!empty($googleAds)):
$i = 0;
foreach ($googleAds as $googleAd):
	$class = null;
	$active_class = null;
	if ($i++ % 2 == 0) {
		$class = 'altrow';
	}	
	if(!$googleAd['GoogleAd']['is_active']):
		$active_class = ' inactive-record';	
	endif;
?>
	<tr class="<?php echo $class.$active_class;?>">
      <td class="actions">
                <div class="action-block">
                <span class="action-information-block">
                    <span class="action-left-block">&nbsp;&nbsp;</span>
                        <span class="action-center-block">
                            <span class="action-info">
                                <?php echo __l('Action');?>
                             </span>
                        </span>
                    </span>
                    <div class="action-inner-block">
                    <div class="action-inner-left-block">
                        <ul class="action-link clearfix">
                            <li>
                                <span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $googleAd['GoogleAd']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
                            </li>
                            <li>
                                <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $googleAd['GoogleAd']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
    			            </li>
    					 </ul>
    					</div>
    					<div class="action-bottom-block"></div>
    				  </div>
    				 </div>
        </td>
        <td class="dc"><?php echo $this->Html->cDateTime($googleAd['GoogleAd']['created']);?></td>
		<td class='dl'><?php echo $this->Html->cText($googleAd['GoogleAd']['name']);?></td>		 
		<td class='dl'><div class="js-truncate"><?php echo $this->Html->cText($googleAd['GoogleAd']['content']);?></div></td>		
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7" class="notice"><?php echo __l('No Google Ads available');?></td>
	</tr>
<?php
endif;
?>
</table>
</div>
<?php
if (!empty($googleAds)) {
    echo $this->element('paging_links');
}
?>
</div>