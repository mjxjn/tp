<?php

/**
 * Description of GoodsGroupModel
 *
 * @author Administrator
 */
class GoodsGroupModel extends RelationModel {

    protected $_validate = array(
    );
    protected $_auto = array(
        array('flag', '1'),
        array('cre_time', 'Mdate()', 1, 'function'),
        array('up_time', 'Mdate()', 2, 'function'),
        array('adminid', 'GetAdmin()', 1, 'function'),
        array('oid', 'GetOid()', 1, 'function'),
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
        'profile' => array(
            'mapping_type' => BELONGS_TO,
            'class_name' => 'Admin',
            'foreign_key' => 'id',
            'as_fields' => 'name',
        ),
    );

    public function addGoodsGroup($rows) {

        $goods_num = count($rows);
        $data['goods_num'] = $goods_num;
        $data['oid'] = GetOid();
        $data['adminid'] = GetAdmin();
        $data['cre_time'] = Mdate();
        if ($gid = $this->add($data)) {
            $goodsList = D('GoodsList');
            $result = $goodsList->addGoods($gid, $rows);
            if ($result === TRUE) {
                return TRUE;
            } else {
                return $result;
            }
        } else {
            return FALSE;
        }
    }

}

?>
