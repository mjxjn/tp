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
    
    public function search(){
        $keyword = $this->_post('keyword');
        $sid = $this->_post('sid');
        if(empty($keyword)||empty($sid)){
            $this->error("请填写关键字！");
        }
        $Supplier = D("Supplier");
        $info = $Supplier->scope('normal')->where('sid="'.$sid.'"')->field('sid,supplier')->find();
        $SupplierGoods = D("SupplierGoods");
        $where = "(( `goods_code` LIKE '%".$keyword."%' ) OR ( `goods_name` LIKE '%".$keyword."%' )) AND ( `sid` = '".$sid."' )";
        import("ORG.Util.Page");// 导入分页类
	$count = $SupplierGoods->scope('normal')->where($where)->count();// 查询满足要求的总记录数
	$Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $SupplierGoods->scope('normal')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('sid',$sid);
        $this->assign('info',$info);
        $this->assign('page',$show);// 赋值分页输出

        $this->display('Supplier:supplierGoods');
    }
}

?>
