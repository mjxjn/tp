<?php

/**
 * Description of PurchaseModel
 *
 * @author maxiang
 */
class PurchaseModel extends RelationModel {

    protected $_validate = array(
    );
    protected $_auto = array(
        array('flag', '1'),
        array('state', '1'),
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

    public function addPurchaseGoods($rows, $id) {
        //$Pinfo = $this->scope('normal')->where('id=' . $id)->find();
        /*if ($Pinfo['goods_num'] >= $sum) {
            $data['state'] = 2;
            $data['up_time'] = Mdate();
            $this->save($data);
        }*/
        $PurchaseList = D('PurchaseList');
        $flag = $PurchaseList->checkPurchaseState($id);
        if($flag=='yes'){
            $data['id'] = $id;
            $data['state'] = 2;
            $data['up_time'] = Mdate();
            $this->save($data);
        }
        foreach ($rows as $value) {
            $result = $PurchaseList->scope('normal')->where('goods_code = "' . $value['goods_code'] . '" and pid=' . $id)->field('id')->find();
            if (empty($result)) {
                $value['pid'] =  $id;
                $value['cre_time'] =  Mdate();
                $value['adminid'] =  GetAdmin();
                $value['flag'] =  1;
                $value['state'] =  2;
                if ($PurchaseList->add($value)) {
                    
                } else {
                    return FALSE;
                }
            } else {
                if ($PurchaseList->where('goods_code = "' . $value['goods_code'] . '" and pid=' . $id)->save($value)) {
                    
                } else {
                    return FALSE;
                }
            }
        }
        return TRUE;
    }

}

?>
