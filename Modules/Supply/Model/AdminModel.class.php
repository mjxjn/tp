<?php
class AdminModel extends RelationModel{
    protected $_validate = array(
        array('name','require','用户名必须！'),
        array('pwd','require','密码必须！'),
        array('name','','用户名已经存在！',0,'unique',1),// 在新增的时候验证name字段是否唯一
        array('repwd','pwd','确认密码不正确',0,'confirm'),
        array('pwd','/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{5,22}$/i','密码格式不正确',0,'regex'),
//        array('name','/^[\u4e00-\u9fa5]+$/i','用户名格式不正确',0,'regex'),
        array('name','checkName','帐号错误！',1,'callback',4),  // 只在登录时候验证
        array('pwd','checkPwd','密码错误！',1,'callback',4), // 只在登录时候验证
    );
    protected $_auto = array(
        array('password','',2,'ignore'),
        array('flag','1'),
        array('login_count',1),
        array('password','md5',3,'function'),
        array('cre_time','Mdate()',1,'function'),
        array('up_time','Mdate()',2,'function'),
        array('last_login','Mdate()',3,'function'),
    );
    protected $_scope = array(
        //
        'normal' => array(
            'where' => array('flag'=>1),
        ),
        
        'latest' => array(
            'order' => 'cre_time DESC',
        ),
        
        'adminname' => array(
            'field' => 'name',
        ),
    );
    protected $_link = array(
        'Admin' => array(
            'mapping_type' => HAS_MANY,
            'class_name' => 'GoodsGroup',
            'mapping_name' => 'GoodsGroup',
            'foreign_key' => 'adminid',
            'as_fields' => 'name',
        ),
    );


    /**
     *  1 可以全数字
     *  2 可以全字母
     *  3 可以全特殊字符(~!@#$%^&*.)
     *  4 三种的组合
     *  5 可以是任意两种的组合
     *  6 长度6-22
     * @return boolean
     */
    private function checkPwdRules(){
        $pwd = isset($_POST['pwd'])?$_POST['pwd']:'';
        if(preg_match('/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,22}$/i', $pwd)) {  
            return TRUE;
        }else{
            return FALSE;
        }
    }
    /**
     * 中文2~5个汉字
     * @return boolean
     */
    private function checkNameRules(){
        $name = trim($_POST['name']);
        if(preg_match('/^[\u0391-\uFFE5]{2,5}$/i', $name)) {  
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    protected function checkName(){
        $name = trim($_POST['name']);
        $result = $this->scope('normal')->where("name='".$name."'")->find();
        if($result) {
            return true;
        }else{
            return false;
        }
    }
    
    protected function checkPwd() {
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
        $name = trim($_POST['name']);
        $result = $this->scope('normal')->where("password='" . $this->pwdHash($pwd) . "' and name='" . $name . "'")->find();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    protected function pwdHash() {
        if(isset($_POST['pwd'])) {
            return md5($_POST['pwd']);
        }else{
            return false;
        }
    }
}