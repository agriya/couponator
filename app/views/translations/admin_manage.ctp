<?php /* SVN: $Id: admin_manage.ctp 71269 2011-11-14 10:50:18Z josephine_065at09 $ */ ?>
<div class="translations form">
<div class="clearfix">
<dl class="list clearfix ">
	<dt><?php echo __l('Verified');?></dt>
		<dd><?php echo $this->Html->link($verified_count, array('controller' => 'translations', 'action' => 'manage', 'language_id' => $this->request->data['Translation']['language_id'], 'filter' => 'verified'), array('title' => __l('Verified')));?></dd>
	<dt><?php echo __l('Unverified');?></dt>
		<dd><?php echo $this->Html->link($unverified_count, array('controller' => 'translations', 'action' => 'manage', 'language_id' => $this->request->data['Translation']['language_id'], 'filter' => 'unverified'), array('title' => __l('Unverified')));?></dd>
</dl>
<div class="grid_4">
    <?php /* Chart block */ ?>
    <?php
    $total = $verified_count + $unverified_count;
    $verified_percent =  round($verified_count*100/$total,3);
    $unverified_percent =  round($unverified_count*100/$total,3);
    $translate_verfified_percentage = $verified_percent.",".$unverified_percent;
    echo $this->Html->image('http://chart.googleapis.com/chart?cht=p&chd=t:'.$translate_verfified_percentage.'&chs=70x70&chco=74B732|C1C1BA&chf=bg,s,FF000000', array('title' => __l('Verified: ').$verified_percent.'%'));
    ?>
    <?php /* Chart block ends*/ ?>
</div>
</div>
<div class="page-info">
	<?php echo __l('If you translated with Google Translate, it may not be perfect translation and it may have mistakes. So you need to manually check all translated texts. The translation stats will give summary of verified/unverified translated text.');?>
</div>
<?php echo $this->Form->create('Translation', array('action' => 'manage', 'class' => 'normal')); ?>
	<fieldset>
	<?php
		echo $this->Form->input('language_id');
		echo $this->Form->input('filter', array('type' => 'hidden'));
		echo $this->Form->input('q', array('label' => 'Keyword'));
		?>
		<div class="submit-block clearfix">
		<?php
		echo $this->Form->submit(__l('Submit'), array('name' => 'data[Translation][makeSubmit]'));
		?>
		</div>
		<?php
		if(!empty($translations)):
			echo $this->element('paging_counter');
		endif;	     
		echo $this->Form->input('page', array('type' => 'hidden'));	
?>

<table class="list">
    <th class="select"><?php echo __l('Verified'); ?></th>
    <th><?php echo __l('Original'); ?></th>
    <th><?php echo __l('Translated'); ?></th>
    <?php
		if(!empty($translations)):
			foreach ($translations as $translation):
			?>
    		<tr><td class="select"> <?php echo $this->Form->input('Translation.'.$translation['Translation']['id'].'.is_verified', array('checked' => ($translation['Translation']['is_verified'])?true:false, 'class' => '', 'label' => false)); ?></td>
            <td> <?php echo $translation['Translation']['key']; ?></td>
             <td> <?php echo $this->Form->input('Translation.'.$translation['Translation']['id'].'.lang_text', array('label' => false, 'value' => $translation['Translation']['lang_text'])); ?></td>
            </tr>
		<?php	
            endforeach;
			?>
	<tr><td colspan="3">
	       <div class="submit-update-block clearfix">
	            <?php 
				echo $this->Form->submit(__l('Update'), array('name' => 'data[Translation][makeUpdate]'));
			?>  
			</div>
        </td>
	</tr>
            

            <?php
		else:
	?>
	<tr><td colspan="2">
	<?php echo __l('No translations available');?></td>
	</tr>
	<?php endif;?>
    </table>
	<?php  	if(!empty($translations)):
    			echo $this->element('paging_links');
			endif;
	?>

	</fieldset>
	<?php echo $this->Form->end(); ?>
</div>