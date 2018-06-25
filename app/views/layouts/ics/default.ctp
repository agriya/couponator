<?php /* SVN FILE: $Id: default.ctp 12 2009-11-14 10:17:05Z annamalai_034ac09 $ */ ?>
<?php
header('Content-Disposition: inline; filename="' . str_replace('/', '_', $this->request->url) . '"');
?>
<?php echo $content_for_layout; ?>