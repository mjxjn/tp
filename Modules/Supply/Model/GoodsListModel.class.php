<?php

/**
 * Description of GoodsListModel
 *
 * @author Administrator
 */
class GoodsListModel extends RelationModel {

    protected $_validate = array(
        array('goods_code', 'require', '商品编号必须！'),
        array('goods_name', 'require', '商品名称必须！'),
    );
    protected $_auto = array(
        array('flag', '1'),
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
    );

    public function addGoods($gid, $rows) {
        foreach ($rows as $val) {
            $val['gid'] = $gid;
            $val['adminid'] = GetAdmin();
            $val['cre_time'] = Mdate();
            $result = $this->add($val);
            if ($result) {
                //$this->success('操作成功！');
            } else {
                return FALSE;
            }
        }
        return TRUE;
    }

}

?>
