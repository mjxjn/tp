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
            $info = $GoodsList->where('gid = '.$id. ' and sid="'.$val['sid'].'"')->select();
            $center_sum = $GoodsList->where('gid = '.$id. ' and sid="'.$val['sid'].'"')->sum('center');
            $accord_sum = $GoodsList->where('gid = '.$id. ' and sid="'.$val['sid'].'"')->sum('accord');
            
            $PurchaseData['sid']=$val['sid'];
            $PurchaseData['Warehouse']='总仓';
            $PurchaseData['supplier']=$supplierInfo['supplier'];
            $PurchaseData['goods_num']=$center_sum;
            $PurchaseData['adminid']=  GetAdmin();
            $PurchaseData['cre_time']= Mdate();
            $PurchaseData['flag']=  1;
            $PurchaseData['state']=  1;
            $PurchaseData['gid']=  $id;
           
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
                        $PurchaseListData['goods_num']=$value['center'];
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
            $PurchaseData['gid']=  $id;

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
                        $PurchaseListData['goods_num']=$value['accord'];
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
        if($Purchase->delete($data)){
            $this->success("删除采购单成功", __APP__ . "/Purchase-purchase");
        }else{
            $this->error("删除采购单失败！");
        }
    }
    
    public function purchaseList(){
        $id = $this->_get('id');
        $sid = $this->_get('sid');
        if(empty($id)&&empty($sid)){
            $this->error("参数错误！");
        }
        $Supplier = D('Supplier');
        $Sinfo = $Supplier->scope('normal')->where('sid='.$sid)->field('supplier')->find();
        $Purchase = D('Purchase');
        $Pinfo = $Purchase->scope('normal')->where('id='.$id)->field('Warehouse,cre_time')->find();
        $PurchaseList = D('PurchaseList');
        import("ORG.Util.Page");// 导入分页类
	$count = $PurchaseList->scope('normal,latest')->where('pid='.$id)->count();// 查询满足要求的总记录数
	$Page = new Page($count,'13');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $PurchaseList->scope('normal,latest')->where('pid='.$id)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('supplier',$Sinfo['supplier']);
        $this->assign('cre_time',$Pinfo['cre_time']);
        $this->assign('Warehouse',$Pinfo['Warehouse']);
        $this->display();
    }
    
    public function upPurchase(){
        $id = $this->_get('id');
        $sid = $this->_get('sid');
        if(empty($id)&&empty($sid)){
            $this->error("参数错误！");
        }
        $Supplier = D('Supplier');
        $Sinfo = $Supplier->scope('normal')->where('sid='.$sid)->field('supplier')->find();
        $Purchase = D('Purchase');
        $Pinfo = $Purchase->scope('normal')->where('id='.$id)->field('gid,Warehouse')->find();
        $GoodsGroup = D('GoodsGroup');
        $Ginfo = $GoodsGroup->scope('normal')->where('id='.$Pinfo['gid'])->field('oid')->find();
        $this->assign('supplier',$Sinfo['supplier']);
        $this->assign('Warehouse',$Pinfo['Warehouse']);
        $this->assign('oid',$Ginfo['oid']);
        $this->assign('id',$id);
        $this->display();
    }
    
    public function csvUpload(){
        $id = $this->_post('id');
        if(empty($id)){
            $this->error("参数错误！");
        }
        $Purchase = D('Purchase');
        $Pinfo = $Purchase->scope('normal')->where('id='.$id)->find();
        if(empty($Pinfo)){
            $this->error("参数错误！");
        }
        import('ORG.Net.UploadFile');
        $upload = new UploadFile(); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->allowExts = array('csv'); // 设置附件上传类型
        $upload->savePath = './Public/Uploads/'; // 设置附件上传目录
        $upload->saveRule = 'time'; // 采用时间戳命名
        if (!$upload->upload()) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        } else {// 上传成功
            $info = $upload->getUploadFileInfo();
        }
        setlocale(LC_ALL, 'en_US.UTF-8');    //读之前 防止中文乱码
        $file = fopen('./Public/Uploads/'.$info[0]['savename'],"r"); //只读形式打开文件
        $row = 0;              //保存重复的行数   
        $sum = 0;
        $repeat_arr    = array();                                  //保存插入tp_server的ser_ids
        while ($data = fgetcsv($file, 1001, ',')) {     //开始读取csv文件
            $row++;
            if ($row == 1) {
                continue;
            }
            $repeat_arr[$row]['goods_code'] = trim($data[0]);
            $repeat_arr[$row]['goods_name'] = iconv("GBK","UTF-8",trim($data[1]));
            $repeat_arr[$row]['specification'] = iconv("GBK","UTF-8",trim($data[2]));
            $repeat_arr[$row]['marque'] = iconv("GBK","UTF-8",trim($data[3]));
            $repeat_arr[$row]['display'] = iconv("GBK","UTF-8",trim($data[4]));
            $repeat_arr[$row]['box_num'] = trim($data[5]);
            if($Pinfo['Warehouse']=='总仓'){
                $repeat_arr[$row]['get_goods_num'] = iconv("GBK","UTF-8",trim($data[6]));
            }elseif($Pinfo['Warehouse']=='和谐店'){
                $repeat_arr[$row]['get_goods_num'] = iconv("GBK","UTF-8",trim($data[7]));
            }
            $sum += $repeat_arr[$row]['b_num'];
        }
        fclose($file);                                                  //关闭文件
        $result = $Purchase->addPurchaseGoods($repeat_arr,$id,$sum);

        if($result === TRUE){
            $this->success("数据导入成功！", __APP__ . "/Purchase-purchaseList-id-".$id."-sid-".$Pinfo['sid']);
        }else{
            $this->error("数据导入失败，请重新导入！".$result);
        }
    }
    
    public function excelPurchase(){
        $id = $this->_get('id');
        $sid = $this->_get('sid');
        if(empty($id)&&empty($sid)){
            $this->error("参数错误！");
        }
        Vendor("PHPExcel.PHPExcel");
        // 创建一个处理对象实例   
        $objExcel = new PHPExcel();
        //设置文档基本属性   
        $objProps = $objExcel->getProperties();   
        $objProps->setCreator("yingge");   
        $objProps->setLastModifiedBy("yingge");   
        $objProps->setTitle("Office XLS yingge Document");   
        $objProps->setSubject("Office XLS yingge Document");   
        $objProps->setDescription("yingge document, generated by PHPExcel.");   
        $objProps->setKeywords("office excel PHPExcel");   
        $objProps->setCategory("YingGe");   
        
        //设置当前的sheet索引，用于后续的内容操作。   
        //一般只有在使用多个sheet的时候才需要显示调用。   
        //缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0   
        $objExcel->setActiveSheetIndex(0);   


        $objActSheet = $objExcel->getActiveSheet();   

        //设置当前活动sheet的名称   
        $objActSheet->setTitle('婴格日新进货单');
        
        //合并单元格   
        $objActSheet->mergeCells('A1:A2'); 
        
        //$objActSheet->getColumnDimension('A1')->setWidth(200);
        //添加图片 
        /*$objDrawing = new PHPExcel_Worksheet_Drawing();   
        $objDrawing->setName('Logo');   
        $objDrawing->setDescription('Image inserted by yingge');   
        $objDrawing->setPath('./Public/Images/LOGO.jpg'); 
        $objDrawing->setHeight(90);   
        $objDrawing->setCoordinates('A1');   
        $objDrawing->setOffsetX(0);   
        $objDrawing->setRotation(15);   
        $objDrawing->getShadow()->setVisible(true);   
        $objDrawing->getShadow()->setDirection(36);   
        $objDrawing->setWorksheet($objActSheet);  */
        
        // 为excel加图片
        /*$objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('./Public/Images/LOGO.jpg');
        $objDrawing->setHeight(90);
        $objDrawing->setWidth(200);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objActSheet);*/

        
        $outputFileName = "婴格进货单.xls";   
        
        $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
        //        到文件   
        //$objWriter->save($outputFileName);   
        //or   
        //到浏览器   
        header("Content-Type: application/force-download");   
        header("Content-Type: application/octet-stream");   
        header("Content-Type: application/download");   
        header('Content-Disposition:inline;filename="'.$outputFileName.'"');   
        header("Content-Transfer-Encoding: binary");   
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");   
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");   
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");   
        header("Pragma: no-cache");   
        $objWriter->save('php://output'); 
        
    }

}

?>
