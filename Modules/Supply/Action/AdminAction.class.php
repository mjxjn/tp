<?php

/**
 * Description of AdminAction
 *
 * @author maxiang
 */
class AdminAction extends CommonAction {
    
    public function adminList(){
        $Admin = D("Admin");
        import("ORG.Util.Page");// 导入分页类
	$count = $Admin->scope('normal')->count();// 查询满足要求的总记录数
	$Page = new Page($count,'50');// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        $list = $Admin->relation(true)->scope('normal,latest')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    
    public function addAdmin(){
        $act = $this->_post('act');
        if($act == 'add'){
            $Admin = D("Admin");
            if($Admin->create()){
                if($Admin->add()){
                    $this->success("添加管理员成功！");
                }else{
                    $this->error("添加管理员失败！");
                }
            }else{
                $this->error("添加管理员失败：".$Admin->getError());
            }
        }elseif($act == 'save'){
            $Admin = D("Admin");
            if($Admin->create()){
                $pwd = $this->_post('password');
                if(empty($pwd)){
                    $data['id'] = $this->_post('id');
                    $data['name'] = $this->_post('name');
                    $data['department'] = $this->_post('department');
                    $data['phone'] = $this->_post('phone');
                    $data['up_time'] = Mdate();
                    if($Admin->save($data)){
                        $this->success("修改管理员成功！");
                    }else{
                        $this->error("修改管理员失败！");
                    }
                }else{
                    if($Admin->save()){
                        $this->success("修改管理员成功！");
                    }else{
                        $this->error("修改管理员失败！");
                    }
                }
            }else{
                $this->error("修改管理员失败：".$Admin->getError());
            }
        }
    }
    
    public function AjaxAdminInfo(){
        $id = $this->_post('id');
        if(empty($id)||$id==1){
            $return['state']=1;
        }
        $Admin = D("Admin");
        $info = $Admin->scope('normal')->where('id='.$id)->find();
        if(!empty($info)){
            $return['state']=0;
            $return['info']=$info;
        }else{
            $return['state']=1;
        }
        echo json_encode($return);
    }
    
    public function adminDel(){
        $id = $this->_get('id');
        if(empty($id)||$id==1){
            $this->error("参数错误！");
        }
        $Admin = D("Admin");
        if($Admin->where('id='.$id)->delete()){
            $this->success("删除管理员成功！");
        }else{
            $this->error("删除管理员失败！");
        }
    }
    
    public function setPower(){
        $id = $this->_get('id');
        if(empty($id)||$id==1){
            $this->error("参数错误！");
        }
        $this->display();
    }
}

?>
