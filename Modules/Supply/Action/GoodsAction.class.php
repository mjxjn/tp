<?php

/**
 * Description of GoodsAction
 *
 * @author maxiang
 */
class GoodsAction extends CommonAction {

    public function index(){
    	$this->display ();
    }

    public function main(){
        $this->orderList();
    }
	
    public function orderList() {
        $GoodsGroup = D('GoodsGroup');
        import("ORG.Util.Page");// 导入分页类
	$count = $GoodsGroup->scope('normal,latest')->count();// 查询满足要求的总记录数
	$Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $GoodsGroup->relation(true)->scope('normal,latest')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function upGoodsList() {
        $this->display();
    }

    public function csvUpload() {
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
        $SupplierGoods = D('SupplierGoods');
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
            $repeat_arr[$row]['center'] = iconv("GBK","UTF-8",trim($data[6]));
            $repeat_arr[$row]['accord'] = iconv("GBK","UTF-8",trim($data[7]));
            $info = $SupplierGoods->where('goods_code="'.$repeat_arr[$row]['goods_code'].'"')->field('sid')->find();
            $repeat_arr[$row]['sid'] = $info['sid'];
        }
        fclose($file);                                                  //关闭文件
        $goodsGroup = D('GoodsGroup');
        $result = $goodsGroup->addGoodsGroup($repeat_arr);
        if($result === TRUE){
            $this->success("数据导入成功！", __APP__ . "/Goods-orderList");
        }else{
            $this->error("数据导入失败，请重新导入！".$result);
        }
    }
    
    public function goodsList(){
        $id=$this->_get('id');
        if(empty($id)){
            $this->error("参数错误");
        }
        $GoodsGroup = M('GoodsGroup');
        $info = $GoodsGroup->where("id=".$id)->field("cre_time,oid")->find();
        $GoodsList = D('GoodsList');
        import("ORG.Util.Page");// 导入分页类
	$count = $GoodsList->scope('normal,latest')->where("gid=".$id)->count();// 查询满足要求的总记录数
	$Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $GoodsList->scope('normal,latest')->relation('Supplier')->where("gid=".$id)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('info',$info);
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    public function search(){
        $keyword = $this->_post('keyword');
        if(empty($keyword)){
            $this->error("搜索商品条形码不能为空！");
        }
        $GoodsList = D('GoodsList');
        import("ORG.Util.Page");// 导入分页类
	$count = $GoodsList->scope('normal,latest')->where("goods_code like '%".$keyword."%'")->count();// 查询满足要求的总记录数
	$Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $GoodsList->scope('normal,latest')->relation(true)->where("goods_code like '%".$keyword."%'")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('keyword',$keyword);
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function goodsDel(){
        $id=$this->_get('id');
        if(empty($id)){
            $this->error("参数错误");
        }
        $GoodsGroup = D('GoodsGroup');
        $date['id']=$id;
        $result = $GoodsGroup->where($date)->delete();
        if($result){
            $GoodsList = D('GoodsList');
            $GoodsList->where('gid='.$id)->delete();
            $this->success("数据删除成功！",__APP__ . "/Goods-orderList");
        }else{
            $this->error("数据删除失败！");
        }
    }
    
    public function allDel(){
        if ($_POST['ids']) {
            $GoodsGroup = D('GoodsGroup');
            $GoodsList = D('GoodsList');
            foreach($_POST['ids'] as $id){
                $date['id']=$id;
                $result = $GoodsGroup->where($date)->delete();
                if($result){
                    $GoodsList->where('gid='.$id)->delete();
                }else{
                    $this->error("数据删除失败！");
                }
            }
            $this->success("数据删除成功！",__APP__ . "/Goods-orderList");
        }else{
            $this->error("请选择要删除的数据！");
        }
    }
    
    public function allGoodsDel(){
        if ($_POST['ids']) {
            $GoodsGroup = D('GoodsGroup');
            $GoodsList = D('GoodsList');
            foreach ($_POST['ids'] as $key => $id) {
                if($key==0){
                    $info = $GoodsList->where('id=' . $id)->find();
                }
                $result = $GoodsList->where('id=' . $id)->delete();
                if ($result) {
                    
                } else {
                    $this->error("数据删除失败！");
                }
            }
            $count = $GoodsList->where('gid='.$info['gid'])->count();
            $data['id']=$info['gid'];
            $data['goods_num']=$count;
            $GoodsGroup->save($data);
            $this->success("数据删除成功！",__APP__ . "/Goods-orderList");
        }else{
            $this->error("请选择要删除的数据！");
        }
    }
}

?>