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
        
        $GoodsList = D('GoodsList');
        $sidList = $GoodsList->Distinct(true)->where('flag=1 and gid='.$id)->field('sid')->select();
        $Supplier = D('Supplier');
        
        $Purchase = D('Purchase');
        $PurchaseList = D('PurchaseList');
        foreach ($sidList as $val){
            $supplierInfo = $Supplier->where('sid="'.$val['sid'].'"')->field('supplier')->find();
            $info = $GoodsList->where('sid="'.$val['sid'].'"')->select();
            $center_sum = $GoodsList->where('sid="'.$val['sid'].'"')->sum('center');
            $accord_sum = $GoodsList->where('sid="'.$val['sid'].'"')->sum('accord');
            
            $PurchaseData['sid']=$val['sid'];
            $PurchaseData['Warehouse']='总仓';
            $PurchaseData['supplier']=$supplierInfo['supplier'];
            $PurchaseData['goods_num']=$center_sum;
            $PurchaseData['adminid']=  GetAdmin();
            $PurchaseData['cre_time']= Mdate();
            $PurchaseData['flag']=  1;
            $PurchaseData['state']=  1;
           
                if($pid = $Purchase->add($PurchaseData)){
                    foreach ($info as $key => $value) {
                        $PurchaseListData['pid']=$pid;
                        $PurchaseListData['goods_code']=$value['goods_code'];
                        $PurchaseListData['goods_name']=$value['goods_name'];
                        $PurchaseListData['specification']=$value['specification'];
                        $PurchaseListData['marque']=$value['marque'];
                        $PurchaseListData['display']=$value['display'];
                        $PurchaseListData['box_num']=$value['box_num'];
                        $PurchaseListData['sid']=$value['sid'];
                        $PurchaseListData['get_goods_num']=0;
                        $PurchaseListData['goods_num']=$value['goods_num'];
                        $PurchaseListData['state']=1;
                        $PurchaseListData['flag']=1;
                        $PurchaseListData['cre_time']=  Mdate();
                        $PurchaseListData['adminid']=  GetAdmin();
                        if($PurchaseList->add($PurchaseListData)){
                            
                        }else{
                            $this->error("添加采购单失败");
                        }
                    }
                }
            
            
            $PurchaseData['sid']=$val['sid'];
            $PurchaseData['Warehouse']='和谐店';
            $PurchaseData['supplier']=$supplierInfo['supplier'];
            $PurchaseData['goods_num']=$accord_sum;
            $PurchaseData['adminid']=  GetAdmin();
            $PurchaseData['cre_time']= Mdate();
            $PurchaseData['flag']=  1;
            $PurchaseData['state']=  1;

                if($pid = $Purchase->add($PurchaseData)){
                    foreach ($info as $key => $value) {
                        $PurchaseListData['pid']=$pid;
                        $PurchaseListData['goods_code']=$value['goods_code'];
                        $PurchaseListData['goods_name']=$value['goods_name'];
                        $PurchaseListData['specification']=$value['specification'];
                        $PurchaseListData['marque']=$value['marque'];
                        $PurchaseListData['display']=$value['display'];
                        $PurchaseListData['box_num']=$value['box_num'];
                        $PurchaseListData['sid']=$value['sid'];
                        $PurchaseListData['get_goods_num']=0;
                        $PurchaseListData['goods_num']=$value['goods_num'];
                        $PurchaseListData['state']=1;
                        $PurchaseListData['flag']=1;
                        $PurchaseListData['cre_time']=  Mdate();
                        $PurchaseListData['adminid']=  GetAdmin();
                        if($PurchaseList->add($PurchaseListData)){
                            
                        }else{
                            $this->error("生成采购单失败！");
                        }
                    }
                }
            
        }
        
        $GoodsGroup = D('GoodsGroup');
        $data['id']=$id;
        $data['flag']=2;
        $data['up_time']=  Mdate();
        $GoodsGroup->save($data);
        $this->success("生成采购单成功！", __APP__ . "/Purchase-purchase");
        
    }
    
    public function purchase(){
        $Purchase = D('Purchase');
        import("ORG.Util.Page");// 导入分页类
	$count = $Purchase->scope('normal,latest')->count();// 查询满足要求的总记录数
	$Page = new Page($count,'13');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $Purchase->scope('normal,latest')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    public function purchaseDel(){
        $id = $this->_get('id');
        if(empty($id)){
            $this->error("参数错误！");
        }
        $Purchase = D('Purchase');
        $data['id']=$id;
        $data['flag']=0;
        if($Purchase->save($data)){
            $this->success("删除供货商成功", __APP__ . "/Purchase-purchase");
        }else{
            $this->error("删除供货商失败！");
        }
    }
    
    public function purchaseList(){
        $id = $this->_get('id');
        if(empty($id)){
            $this->error("参数错误！");
        }
        $PurchaseList = D('PurchaseList');
        import("ORG.Util.Page");// 导入分页类
	$count = $PurchaseList->scope('normal,latest')->count();// 查询满足要求的总记录数
	$Page = new Page($count,'13');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $PurchaseList->scope('normal,latest')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    public function upPurchase(){
        
    }

}

?>
