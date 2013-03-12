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
    
    public function addSupplierGoods($rows){
        foreach ($rows as $val) {
            if($this->create($val)){
                if($this->add()){
                    //return TRUE;
                }else{
                    return FALSE;
                }
            }else{
                return $this->getError();
            }
        }
        return TRUE;
    }
    
    public function getSupplierSid($goods_code){
        $info = $this->where('goods_code="'.$goods_code.'"')->field('sid')->find();
        if(!empty($info)){
            return $info['sid'];
        }else{
            return;
        }
    }
}

?>
