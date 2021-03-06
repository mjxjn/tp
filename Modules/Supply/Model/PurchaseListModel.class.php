<?php

/**
 * Description of PurchaseModel
 *
 * @author maxiang
 */
class PurchaseListModel extends RelationModel{
    protected $_validate = array(
        
    );
    protected $_auto = array(
        array('flag', '1'),
        array('state','0'),
        array('cre_time', 'Mdate', 1, 'function'),
        array('up_time', 'Mdate', 2, 'function'),
        array('adminid', 'GetAdmin', 1, 'function'),
    );
    protected $_scope = array(
        //
        'normal' => array(
            'where' => array('flag' => 1),
        ),
        'latest' => array(
            'order' => 'state ASC',
        ),
    );
    
    public function checkPurchaseState($pid){
        $list = $this->where('pid='.$pid)->select();
        foreach ($list as $val){
            if($val['goods_num']>$val['get_goods_num']){
                return "no";
            }
        }
        return "yes";
    }
}

?>
