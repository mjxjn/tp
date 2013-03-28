<?php

/**
 * Description of PurchaseAction
 *
 * @author maxiang
 */
class PurchaseAction extends CommonAction {
    
    public function index(){
    	$this->display ();
    }
    
    public function main(){
        $this->purchase();
    }

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
            $center_sum = $GoodsList->where('center>0 and gid = '.$id. ' and sid="'.$val['sid'].'"')->count();
            $accord_sum = $GoodsList->where('accord>0 and gid = '.$id. ' and sid="'.$val['sid'].'"')->count();
            
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
                        if($value['center']>0){
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
                        if($value['accord']>0){
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
                                echo $key;
                            }else{
                                $this->error("生成采购单失败！");
                            }
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
	$Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $Purchase->scope('normal,latest')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    public function findSupplier(){
        $sid = $this->_post('sid');
        $Purchase = D('Purchase');
        import("ORG.Util.Page");// 导入分页类
	$count = $Purchase->scope('normal,latest')->where('sid="'.$sid.'"')->count();// 查询满足要求的总记录数
	$Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $Purchase->scope('normal,latest')->where('sid="'.$sid.'"')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display('Purchase:purchase');
    }

    public function purchaseDel(){
        $id = $this->_get('id');
        if(empty($id)){
            $this->error("参数错误！");
        }
        $Purchase = D('Purchase');
        $data['id']=$id;
        if($Purchase->where($data)->delete()){
            $PurchaseList = D('PurchaseList');
            $PurchaseList->where('pid='.$id)->delete();
            $this->success("删除采购单成功", __APP__ . "/Purchase-purchase");
        }else{
            $this->error("删除采购单失败！");
        }
    }
    
    public function allDel(){
        if ($_POST['ids']) {
            $Purchase = D('Purchase');
            $PurchaseList = D('PurchaseList');
            foreach($_POST['ids'] as $id){
                $date['id']=$id;
                $result = $Purchase->where($date)->delete();
                if($result){
                    $PurchaseList->where('pid='.$id)->delete();
                }else{
                    $this->error("数据删除失败！");
                }
            }
            $this->success("数据删除成功！",__APP__ . "/Purchase-purchase");
        }else{
            $this->error("请选择要删除的数据！");
        }
    }
    
    public function allListDel(){
        if ($_POST['ids']) {
            $Purchase = D('Purchase');
            $PurchaseList = D('PurchaseList');
            foreach($_POST['ids'] as $key => $id){
                if($key==0){
                    $info = $PurchaseList->where('id='.$id)->find();
                }
                $date['id']=$id;
                $result = $PurchaseList->where($date)->delete();
                if($result){
                }else{
                    $this->error("数据删除失败！");
                }
            }
            $list = $PurchaseList->where('pid='.$info['pid'])->field('goods_num')->select();
            foreach ($list as $val){
                $count += $val['goods_num'];
            }
            $flag = $PurchaseList->checkPurchaseState($info['pid']);
            $data['id']=$info['pid'];
            $data['goods_num']=$count;
            if($flag=='yes'){
                $data['state']=2;
            }else{
                $data['state']=1;
            }
            $Purchase->save($data);
            
            $this->success("数据删除成功！",__APP__ . "/Purchase-purchase");
        }else{
            $this->error("请选择要删除的数据！");
        }
    }

    public function purchaseList(){
        $id = $this->_get('id');
        $sid = $this->_get('sid');
        $state = $this->_get('state');
        if(empty($id)&&empty($sid)){
            $this->error("参数错误！");
        }
        $Supplier = D('Supplier');
        $Sinfo = $Supplier->scope('normal')->where('sid='.$sid)->field('supplier')->find();
        $Purchase = D('Purchase');
        $Pinfo = $Purchase->scope('normal')->where('id='.$id)->field('Warehouse,cre_time')->find();
        $PurchaseList = D('PurchaseList');
        $allcount = $PurchaseList->scope('normal,latest')->where('goods_num > 0')->where('pid='.$id)->count();
        import("ORG.Util.Page");// 导入分页类
        if(empty($state)){
	$count = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and pid='.$id)->count();// 查询满足要求的总记录数
	$Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and pid='.$id)->limit($Page->firstRow.','.$Page->listRows)->select();
        }else{
            switch ($state) {
                case 1://全部导航商品
                    $count = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and get_goods_num=goods_num and pid='.$id)->count();// 查询满足要求的总记录数
                    $Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
                    $show = $Page->show();// 分页显示输出
                    $list = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and get_goods_num=goods_num and pid='.$id)->limit($Page->firstRow.','.$Page->listRows)->select();
                    break;
                case 2://未完全到货商品
                    $count = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and get_goods_num<goods_num and pid='.$id)->count();// 查询满足要求的总记录数
                    $Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
                    $show = $Page->show();// 分页显示输出
                    $list = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and get_goods_num<goods_num and pid='.$id)->limit($Page->firstRow.','.$Page->listRows)->select();
                    break;
                case 3://超出到货数量商品
                    $count = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and get_goods_num>goods_num and pid='.$id)->count();// 查询满足要求的总记录数
                    $Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
                    $show = $Page->show();// 分页显示输出
                    $list = $PurchaseList->scope('normal,latest')->where('get_goods_num>goods_num and pid='.$id)->limit($Page->firstRow.','.$Page->listRows)->select();
                    break;
                case 4://未采购商品
                    $count = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and get_goods_num=0 and pid='.$id)->count();// 查询满足要求的总记录数
                    $Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
                    $show = $Page->show();// 分页显示输出
                    $list = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and get_goods_num=0 and pid='.$id)->limit($Page->firstRow.','.$Page->listRows)->select();
                    break;
                default:
                    break;
            }
        }
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$allcount);//采购数量
        $getcount = $PurchaseList->scope('normal,latest')->where('goods_num > 0 and get_goods_num > 0 and pid='.$id)->count();
        $this->assign('getcount',$getcount);//实际到货商品数量
        $getbai = number_format($getcount/$count,2)*100;
        $this->assign('getbai',$getbai);//到货率
        $this->assign('supplier',$Sinfo['supplier']);
        $this->assign('cre_time',$Pinfo['cre_time']);
        $this->assign('Warehouse',$Pinfo['Warehouse']);
        $this->assign('id',$id);
        $this->assign('sid',$sid);
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
        }
        fclose($file);                                                  //关闭文件
        $result = $Purchase->addPurchaseGoods($repeat_arr,$id);

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
        $Supplier = D('Supplier');
        $Sinfo = $Supplier->where('flag=1 and sid="'.$sid.'"')->find();
        $Purchase = D('Purchase');
        $Pinfo = $Purchase->where('id='.$id)->field('Warehouse')->find();
        $goodsGroup = D('goodsGroup');
        $Ginfo = $goodsGroup->where('id='.$Pinfo['gid'])->field('oid')->find();
        $PurchaseList = D('PurchaseList');
        $Plist = $PurchaseList->where('pid='.$id." and sid='".$sid."'")->select();
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
        if($Pinfo['Warehouse']=='总仓'){
            $objActSheet->setTitle('婴格总仓进货单');
        }else{
            $objActSheet->setTitle('婴格和谐店进货单');
        }
        
        //合并单元格   
        //$objActSheet->mergeCells('A1:B1'); 
        $objActSheet->mergeCells('A1:F1');
        $objActSheet->mergeCells('A2:B2');
        $objActSheet->mergeCells('E2:F2');
        $objActSheet->mergeCells('A3:C3');
        $objActSheet->mergeCells('E3:F3');
        $objActSheet->mergeCells('A4:B4');
        $objActSheet->mergeCells('E4:F4');
        $objActSheet->mergeCells('A5:C5');
        $objActSheet->mergeCells('E5:F5');
        $objActSheet->mergeCells('A6:F6');
        
        
        
        //$objActSheet->getColumnDimension('A1')->setWidth(200);
        //添加图片 
        /*$objDrawing = new PHPExcel_Worksheet_Drawing();   
        $objDrawing->setName('Logo');   
        $objDrawing->setDescription('Logo');   
        $objDrawing->setPath('./Public/Images/LOGO.jpg'); 
        $objDrawing->setHeight(90);
        $objDrawing->setWidth(200);
        $objDrawing->setCoordinates('A1');   
        $objDrawing->setOffsetX(0);   
        $objDrawing->setRotation(15);   
        $objDrawing->getShadow()->setVisible(true);   
        $objDrawing->getShadow()->setDirection(36);   
        $objDrawing->setWorksheet($objActSheet); */
        if($Pinfo['Warehouse']=='总仓'){
            $objExcel->getActiveSheet()->setCellValue('A1', '进 货 订 单（ 总 仓 ）');
        }else{
            $objExcel->getActiveSheet()->setCellValue('A1', '进 货 订 单（ 和 谐 ）');
        }
        $objStyleC1 = $objActSheet->getStyle('A1');
        $objFontC1 = $objStyleC1->getFont();   
        $objFontC1->setName('Courier New');   
        $objFontC1->setSize(30);   
        $objFontC1->setBold(true); 
        
        $objExcel->getActiveSheet()->setCellValue('A2', 'TO:'.$Sinfo['supplier']); 
        $objExcel->getActiveSheet()->setCellValue('C2', '联系人:'.$Sinfo['name'].'手机:'.$Sinfo['phone']);
        $objExcel->getActiveSheet()->setCellValue('D2', '电话:');
        $objExcel->getActiveSheet()->setCellValue('E2', $Sinfo['tel']);
        $objExcel->getActiveSheet()->setCellValue('A3', '公司地址:'.$Sinfo['address']);
        $objExcel->getActiveSheet()->setCellValue('D3', '单号:');
        $objExcel->getActiveSheet()->setCellValue('E3', $Ginfo['oid']);
        
        $objExcel->getActiveSheet()->setCellValue('A4', 'FROM:昆明婴格经贸有限公司'); 
        $objExcel->getActiveSheet()->setCellValue('A4', 'FROM:昆明婴格经贸有限公司'); 
        $objExcel->getActiveSheet()->setCellValue('C4', '联系人:手机:');
        $objExcel->getActiveSheet()->setCellValue('D4', '电话:');
        $objExcel->getActiveSheet()->setCellValue('E4', '0871-8082727');
        
        if($Pinfo['Warehouse']=='总仓'){
            $objExcel->getActiveSheet()->setCellValue('A5', '公司地址：云南省昆明市西山区日新中路滇池境界9栋2楼');
        }else{
            $objExcel->getActiveSheet()->setCellValue('A5', '公司地址：云南省昆明市五华区小康大道中段和谐世纪二层');  
        }
        $objExcel->getActiveSheet()->setCellValue('D5', '传真:');
        $objExcel->getActiveSheet()->setCellValue('E5', '0871-8082727-115');
        if($Pinfo['Warehouse']=='总仓'){
            $objExcel->getActiveSheet()->setCellValue('A6', '烦请订购以下商品！请送往日新店');
        }else{
            $objExcel->getActiveSheet()->setCellValue('A6', '烦请订购以下商品！请送往和谐店');
        }
        $objStyleC6 = $objActSheet->getStyle('A6');
        $objFontC6 = $objStyleC6->getFont();   
        $objFontC6->setName('Courier New');   
        $objFontC6->setSize(20);   
        $objFontC6->setBold(true); 
        
        
        $objExcel->getActiveSheet()->setCellValue('A7', '序');
        $objExcel->getActiveSheet()->setCellValue('B7', '条形码');
        $objExcel->getActiveSheet()->setCellValue('C7', '商品全名');
        $objExcel->getActiveSheet()->setCellValue('D7', '规格');
        $objExcel->getActiveSheet()->setCellValue('E7', '型号');
        $objExcel->getActiveSheet()->setCellValue('F7', '数量');
        
        $i=8;
        foreach ($Plist as $key => $val){
            $objExcel->getActiveSheet()->setCellValue('A'.$i, $key+1);
            $objActSheet->setCellValueExplicit('B'.$i, $val['goods_code'],   
                                    PHPExcel_Cell_DataType::TYPE_STRING);
            //$objExcel->getActiveSheet()->setCellValue('B'.$i, $val['goods_code']);
            $objExcel->getActiveSheet()->setCellValue('C'.$i, $val['goods_name']);
            $objExcel->getActiveSheet()->setCellValue('D'.$i, $val['specification']);
            $objExcel->getActiveSheet()->setCellValue('E'.$i, $val['marque']);
            $objExcel->getActiveSheet()->setCellValue('F'.$i, $val['goods_num']);
            $i++;
        }
        // 为excel加图片
        /*$objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('./Public/Images/LOGO.jpg');
        $objDrawing->setHeight(90);
        $objDrawing->setWidth(200);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($objActSheet);*/

        
        $outputFileName = "婴格进货单-".$Sinfo['supplier']."-".$Pinfo['Warehouse']."-".$Ginfo['oid'].".xls";   
        
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
