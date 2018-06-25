<?php /* SVN: $Id: admin_index.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="bannedIps index js-response">
  <div class="clearfix">
  <div class="grid_left">
    <?php echo $this->element('paging_counter');?>
    </div>
    <div class="add-block grdi_left">
        <?php echo $this->Html->link(__l('Add'), array('controller' => 'banned_ips', 'action' => 'add'), array('class' => 'add','title' => __l('Add'))); ?>
    </div>
    </div>
    <?php echo $this->Form->create('BannedIp' , array('class' => 'normal','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    <table class="list">
        <tr>
            <th class="dc"><?php echo __l('Select'); ?></th>
            <th class="actions dc"><?php echo __l('Actions');?></th>
            <th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Victims'), 'address');?></div></th>
            <th class="dl"><div class=""><?php echo $this->Paginator->sort('reason');?></div></th>
            <th class="dl"><div class=""><?php echo $this->Paginator->sort(__l('Redirect to'), 'redirect');?></div></th>
            <th class="dc"><div class=""><?php echo $this->Paginator->sort(__l('Date Set'), 'thetime');?></div></th>
            <th class="dc"><div class=""><?php echo $this->Paginator->sort(__l('Expiry Date'), 'timespan');?></div></th>
        </tr>
        <?php
        if (!empty($bannedIps)):
            $i = 0;
            foreach ($bannedIps as $bannedIp):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                ?>
                <tr<?php echo $class;?>>
                <td><?php echo $this->Form->input('BannedIp.'.$bannedIp['BannedIp']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$bannedIp['BannedIp']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
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
                                <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $bannedIp['BannedIp']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
    			            </li>
    					 </ul>
    					</div>
    					<div class="action-bottom-block"></div>
    				  </div>
    				 </div>
                    </td>
                    <td class="dl">
                        <?php echo long2ip($bannedIp['BannedIp']['address']);?>
                        <?php if ($bannedIp['BannedIp']['range']) :
                            echo ' - '.long2ip($bannedIp['BannedIp']['range']);
                        endif; ?>
                    </td>
                    <td class="dl"><div class="js-truncate"><?php echo $this->Html->cText($bannedIp['BannedIp']['reason']);?></div></td>
	                <td class="dl"><?php echo $this->Html->cText($bannedIp['BannedIp']['referer_url']);?></td>
                    <td class="dc"><?php echo date("M d, Y H:i", $bannedIp['BannedIp']['thetime']); ?></td>
                    <td class="dc"><?php echo ($bannedIp['BannedIp']['timespan'] > 0) ? date("M d, Y H:i", $bannedIp['BannedIp']['timespan']) : __l('Never');?></td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="7" class="notice"><?php echo __l('No Banned Ips available');?></td>
            </tr>
            <?php
        endif;
        ?>
    </table>
    <?php
    if (!empty($bannedIps)):
        ?>
        <div class="clearfix">
		<div class="admin-select-block clearfix grid_left">
        <div>
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
        </div>
     
        <div class="admin-checkbox-button">
            <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
        </div>
		</div>
		   <div class="grid_right">
            <?php echo $this->element('paging_links'); ?>
        </div>
        </div>
        <div class="hide">
            <?php echo $this->Form->submit('Submit');  ?>
        </div>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>