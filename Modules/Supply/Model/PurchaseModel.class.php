<?php

/**
 * Description of PurchaseModel
 *
 * @author maxiang
 */
class PurchaseModel extends RelationModel{
    protected $_validate = array(
        
    );
    protected $_auto = array(
        array('flag', '1'),
        array('state','1'),
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
            'order' => 'cre_time DESC',
        ),
    );
    protected $_link = array(
        'Admin' => array(
            'mapping_type' => BELONGS_TO,
            'foreign_key' => 'adminid',
            'as_fields' => 'name',
        ),
        'Supplier' => array(
            'mapping_type' => BELONGS_TO,
            'foreign_key' => 'sid',
            'as_fields' => 'sname',
        ),
    );
    
    public function addPurchaseGoods($rows,$id,$sum){
        $Pinfo = $this->scope('normal')->where('id='.$id)->find();
        $data['id']=$id;
        if($Pinfo['goods_num'] >= $sum){
            $data['state']=2;
            $data['up_time']=  Mdate();
            $this->save($data);
        }
        $PurchaseList = M('PurchaseList');
        foreach ($rows as $value) {
            if($PurchaseList->where('goods_code = "'.$value['goods_code'].'" and pid='.$id)->save($value)){
                
            }else{
                //$PurchaseList->add($value);
                return FALSE;
            }
        }
        return TRUE;
    }
    
}

?>
