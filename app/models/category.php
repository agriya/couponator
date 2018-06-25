<?php
/**
 * Couponator
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    couponator
 * @subpackage Core
 * @author     Agriya <info@agriya.com>
 * @copyright  2018 Agriya Infoway Private Ltd
 * @license    http://www.agriya.com/ Agriya Infoway Licence
 * @link       http://www.agriya.com
 */
class Category extends AppModel
{
    public $name = 'Category';
    public $displayField = 'title';
    public $actsAs = array(
        'Sluggable' => array(
            'label' => array(
                'title'
            )
        )
    );
	public $hasMany = array(
        'Coupon' => array(
            'className' => 'Coupon',
            'foreignKey' => 'category_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
	);
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'title' => array(
                'rule2' => array(
                    'rule' => 'isUnique',
                    'on' => 'create',
                    'message' => __l('Category name already exists')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
            ) ,
        );
		$this->moreActions = array(
            ConstMoreAction::Inactive => __l('Inactive') ,
            ConstMoreAction::Active => __l('Active') ,
            ConstMoreAction::Delete => __l('Delete')
        );
    }
    public function findCategoryId($slug = null)
    {
        $category_id = $this->find('first', array(
            'conditions' => array(
                'Category.slug' => $slug,
                'Category.is_active' => 1,
            ) ,
            'fields' => array(
                'Category.id',
            ) ,
            'recursive' => -1
        ));
        return ($category_id['Category']['id']);
    }
}
?>