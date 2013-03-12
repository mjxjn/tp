<?php

/**
 * Description of PurchaseAction
 *
 * @author maxiang
 */
class PurchaseAction extends CommonAction {

    public function creatPurchase() {
        $id = $this->_get('id');
        if (empty($id)) {
            $this->error("参数有误！");
        }
        $GoodsGroup = M('GoodsGroup');
        $info = $GoodsGroup->where('id=' . $id)->field('goods_num')->find();
        $Purchase = D('Purchase');
        $data['cre_time'] =  Mdate();
        $data['goods_num'] = $info['goods_num'];
        $data['state'] =  0;
        $data['flag'] = 1;
        $data['adminid'] = GetAdmin();
        $data['gid'] = $id;
        if ($Purchase->add($data)) {
            $this->success("生成采购单成功！", __APP__ . "/Purchase-purchase");
        } else {
            $this->error("生成采购单失败！");
        }
    }
    
    public function purchase(){
        $this->display();
    }

}

?>
