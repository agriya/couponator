<?php  
if(!empty($this->request->data['Coupon']['Where'])):
	 echo $this->element('printable-search', array('config' => 'sec', 'where' => $this->request->data['Coupon']['Where']));
endif;
if (!empty($this->request->data['Coupon']['What'])):
	 echo $this->element('printable-search', array('config' => 'sec', 'what' => $this->request->data['Coupon']['What']));
endif;
?>