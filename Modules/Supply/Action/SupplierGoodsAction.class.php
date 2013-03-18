<?php

/**
 * Description of SupplierGoodsAxtion
 *
 * @author Administrator
 */
class SupplierGoodsAction extends CommonAction {
    public function supplierGoodsDel(){
        $id = $this->_get('id');
        if(empty($id)){
            $this->error("参数错误！");
        }
        $SupplierGoods = D("SupplierGoods");
        $Sinfo = $SupplierGoods->where('id='.$id)->field("sid")->find();
        $data['id']=$id;
        if($SupplierGoods->where($data)->delete()){
            $this->success("删除供货商商品信息成功！",__APP__."/Supplier-supplierGoods-sid-".$Sinfo['sid']);
        }else{
            $this->error("删除供货商商品信息失败！");
        }
    }
}

?>
