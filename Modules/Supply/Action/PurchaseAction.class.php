<?php

/**
 * Description of PurchaseAction
 *
 * @author maxiang
 */
class PurchaseAction extends CommonAction{
    public function creatPurchase(){
        $id = $this->_get('id');
        if(empty($id)){
            $this->error("参数有误！");
        }
        $GoodsGroup = M('GoodsGroup');
        $info = $GoodsGroup->where('id='.$id)->field('goods_num')->find();
        $Purchase = D('Purchase');
        if($Purchase->create($info)){
            //$info['goods_num'];
            if($Purchase->add()){
                $this->success("生成采购单成功！",__APP__ . "/Purchase-purchase");
            }else{
                $this->error("生成采购单失败！");
            }
        }else{
            $this->error($Purchase->getError());
        }
    }
}

?>
