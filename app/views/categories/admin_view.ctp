<?php /* SVN: $Id: admin_view.ctp 31 2009-11-14 12:10:21Z annamalai_034ac09 $ */ ?>
<div class="categories view">
<h2><?php echo __l('Category');?></h2>
	<dl class="list"><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Id');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($category['Category']['id']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Parent Id');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($category['Category']['parent_id']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Lft');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($category['Category']['lft']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Rght');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($category['Category']['rght']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Title');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($category['Category']['title']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Slug');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($category['Category']['slug']);?></dd>
	</dl>
</div>

