<?php

/**
 * Description of SupplierModel
 *
 * @author Administrator
 */
class SupplierModel extends RelationModel {
    protected $_validate = array(
        array('sid','require','供货商编号必须！'),
        array('supplier','require','供货商名称必须！'),
        array('sid','','供货商编号已经存在！',0,'unique',1),
    );
    protected $_auto = array(
        array('flag','1'),
        array('cre_time','Mdate',1,'function'),
        array('up_time','Mdate',2,'function'),
        array('adminid','GetAdmin',1,'function'),
    );
    protected $_scope = array(
        //
        'normal' => array(
            'where' => array('flag'=>1),
        ),
        
        'latest' => array(
            'order' => 'cre_time DESC',
        ),
    );
    
}

?>
