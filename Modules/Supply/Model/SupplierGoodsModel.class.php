<?php

/**
 * Description of SupplierGoodsModel
 *
 * @author Administrator
 */
class SupplierGoodsModel extends RelationModel {
    protected $_validate = array(
        array('sid','require','供货商编号必须！'),
        array('goods_name','require','供货商名称必须！'),
        array('goods_code','require','供货商编号必须！'),
        array('goods_code','','供货商编号不能重复！',0,'unique',1),
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
    
    public function addSupplierGoods($rows) {
        foreach ($rows as $val) {
            $result = $this->where('goods_code='.$val['goods_code'].' and sid="'.$val['sid'].'"')->find();
            if(empty($result)){
                $val['adminid'] = GetAdmin();
                $val['flag'] = 1;
                $val['cre_time'] = Mdate();
                if ($this->add($val)) {
                    //return TRUE;
                } else {
                    return FALSE;
                }
            }else{
                $val['id']=$result['id'];
                $val['up_time'] = Mdate();
                $val['adminid'] = GetAdmin();
                if ($this->save($val)) {
                    //return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
        return TRUE;
    }
    
    public function getSupplierSid($goods_code){
        $info = $this->scope('normal')->where('goods_code="'.$goods_code.'"')->field('sid')->find();
        if(!empty($info)){
            return $info['sid'];
        }else{
            return;
        }
    }
}

?>
