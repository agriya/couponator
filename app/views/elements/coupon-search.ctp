<?php 
$keyword='';
if(!empty($this->request->params['named']['keyword']))
{
	$keyword=$this->request->params['named']['keyword'];
}
if(!empty($this->request->params['named']['tag']))
{
	$keyword=str_replace('-',' ',$this->request->params['named']['tag']);
}

  if(!empty($view)):
	echo $this->requestAction(array('controller' => 'coupons', 'action' => 'search_box', 'view' => $view, 'what' => $what, 'where' => $where, 'admin' => false), array('return'));
  else:
    echo $this->requestAction(array('controller' => 'coupons', 'action' => 'search_box', 'admin' => false,'keyword'=>!empty($keyword)?$keyword:''), array('return'));
  endif;
?>