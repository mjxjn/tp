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
    
    public function allDel(){
        $sid = $this->_post('sid');
        if(empty($sid)){
            $this->error("参数错误！");
        }
        if ($_POST['ids']) {
            $SupplierGoods = D('SupplierGoods');
            foreach($_POST['ids'] as $id){
                $date['id']=$id;
                $result = $SupplierGoods->where($date)->delete();
                if($result){
                   
                }else{
                    $this->error("数据删除失败！");
                }
            }
            $this->success("数据删除成功！",__APP__."/Supplier-supplierGoods-sid-".$sid);
        }else{
            $this->error("请选择要删除的数据！");
        }
    }
}

?>
