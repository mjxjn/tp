<?php

/**
 * Description of SupplierAction
 *
 * @author Administrator
 */
class SupplierAction extends CommonAction {
    
    public function index(){
    	$this->display ();
    }
    
    public function main(){
        $this->supplier();
    }

    public function supplier() {
        $Supplier = D('Supplier');
        import("ORG.Util.Page");// 导入分页类
	$count = $Supplier->scope('normal,latest')->count();// 查询满足要求的总记录数
	$Page = new Page($count,'13');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $Supplier->scope('normal,latest')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function upSupplier() {
        $sid = $this->_get('sid');
        if(empty($sid)){
            $this->error("参数错误！");
        }
        $Supplier = D("Supplier");
        $info = $Supplier->scope('normal')->where('sid="'.$sid.'"')->field('sid,supplier')->find();
        $this->assign('info',$info);
        $this->display();
    }

    public function csvUpload() {
        $sid = $this->_post('sid');
        if(empty($sid)){
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
        $file = fopen('./Public/Uploads/' . $info[0]['savename'], "r"); //只读形式打开文件
        $row = 0;
        $repeat_arr = array();                                   //保存重复的行数 
        while ($data = fgetcsv($file, 1001, ',')) {     //开始读取csv文件
            $row++;
            if ($row == 1) {
                continue;
            }
            $repeat_arr[$row]['sid'] = $sid;
            $repeat_arr[$row]['goods_code'] = iconv("GBK", "UTF-8", trim($data[1]));
            $repeat_arr[$row]['goods_name'] = iconv("GBK", "UTF-8", trim($data[2]));
            $repeat_arr[$row]['specification'] = iconv("GBK", "UTF-8", trim($data[3]));
            $repeat_arr[$row]['marque'] = iconv("GBK", "UTF-8", trim($data[4]));
            $repeat_arr[$row]['box_num'] = iconv("GBK", "UTF-8", trim($data[5]));
        }
        fclose($file);                                                  //关闭文件
        $SupplierGoods = D('SupplierGoods');
        $result = $SupplierGoods->addSupplierGoods($repeat_arr);
        if ($result === TRUE) {
            $this->success("数据导入成功！", __APP__ . "/Supplier-supplierGoods-sid-".$sid);
        } else {
            $this->error("数据导入失败，请重新导入！" . $result);
        }
    }

    public function addsupplier() {
        if (empty($_POST['sid'])) {
            $this->error("请填写表单后提交");
        }
        $act = $this->_post('act');
        if($act=='add'){
            $Supplier = D("Supplier");
            if ($Supplier->create()) {
                if ($Supplier->add()) {
                    $this->success("添加新供货商成功！", __APP__ . '/Supplier-supplier');
                } else {
                    $this->error("添加新供货商失败！");
                }
            } else {
                $this->error($Supplier->getError());
            }
        }elseif($act=='save'){
            $Supplier = D("Supplier");
            if ($Supplier->create()) {
                if ($Supplier->save()) {
                    $this->success("修改供货商信息成功！", __APP__ . '/Supplier-supplier');
                } else {
                    $this->error("修改供货商信息失败！");
                }
            } else {
                $this->error($Supplier->getError());
            }
        }
    }
    
    public function AjaxGetSupplierInfo(){
        $id = $this->_post('id');
        if(empty($id)){
            $this->error("参数错误！");
        }
        $Supplier = D("Supplier");
        $info = $Supplier->scope('normal')->where('id='.$id)->find();
        if(!empty($info)){
            $return['state']=0;
            $return['info']=$info;
        }else{
            $return['state']=1;
        }
        echo json_encode($return);
    }
    
    public function AjaxGetSupplierGoods(){
        $id = $this->_post('id');
        if(empty($id)){
            $this->error("参数错误！");
        }
        $SupplierGoods = D('SupplierGoods');
        $info = $SupplierGoods->scope('normal')->where('id='.$id)->find();
        if(!empty($info)){
            $return['state']=0;
            $return['info']=$info;
        }else{
            $return['state']=1;
        }
        echo json_encode($return);
    }

    public function supplierGoods(){
        $sid = $this->_get('sid');
        if(empty($sid)){
            $this->error("参数错误！");
        }
        $Supplier = D("Supplier");
        $info = $Supplier->scope('normal')->where('sid="'.$sid.'"')->field('sid,supplier')->find();
        $SupplierGoods = D("SupplierGoods");
        import("ORG.Util.Page");// 导入分页类
	$count = $SupplierGoods->scope('normal')->where("sid='".$sid."'")->count();// 查询满足要求的总记录数
	$Page = new Page($count,'15');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $SupplierGoods->scope('normal')->where("sid='".$sid."'")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('info',$info);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    public function supplierDel(){
        $id = $this->_get('id');
        $sid = $this->_get('sid');
        if(empty($id)&&empty($sid)){
            $this->error("参数错误！");
        }
        $Supplier = D("Supplier");
        $data['id']=$id;
        $data['sid']=$sid;
        if($Supplier->where($data)->delete()){
            $this->success("删除供货商成功", __APP__ . "/Supplier-supplier");
        }else{
            $this->error("删除供货商失败！");
        }
    }
    
    public function saveSupplierGoods(){
        $id = $this->_post('id');
        if(empty($id)){
            $this->error("参数错误！");
        }
        $SupplierGoods = D('SupplierGoods');
        if($SupplierGoods->create()){
            if($SupplierGoods->save()){
                $this->success("商品信息修改成功！");
            }else{
                $this->error("商品信息修改失败！");
            }
        }else{
            $this->error($SupplierGoods->getError());
        }
    }
}

?>
