<?php /* SVN: $Id: admin_index.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<div class="pageTags index">
<?php
echo $this->Form->create('PageTag', array('class' => 'normal','action'=>'index'));
foreach ($pageTags as $pageTag):
    $i = 0;
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
    ?>
    <h3><?php echo $this->Html->cText($pageTag['PageTag']['name']); ?></h3>
    <table class="list">
    <tr>
        <th>Page</th>
        <th>Display Order</th>
    </tr>
    <?php
    if(!empty($pageTag['Page'])): ?>
           <?php foreach($pageTag['Page'] as $page): ?>
           <?php
                $j = 0;
            	$class = null;
            	if ($j++ % 2 == 0) {
            		$class = ' class="altrow"';
            	}
           ?>
               <tr<?php echo $class;?>>
            		<td><?php echo $this->Html->cText($page['title']);?></td>
            		<td><?php echo $this->Form->input('PagesPageTag.'.$page['PagesPageTag']['id'].'.display_order', array('value' => $page['PagesPageTag']['display_order']));?></td>
            	</tr>
        	<?php
                endforeach;
            ?>
        </table>
        <?php
    else:
        ?>
	<tr>
		<td colspan="5" class="notice"><?php echo __l('No Page Tags available');?></td>
	</tr>
    <?php
    endif;
endforeach;
    ?>
<?php echo $this->Form->submit('Submit'); ?>
<?php echo $this->Form->end(); ?>
</div>
