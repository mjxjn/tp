<?php
class AdminModel extends CommonModel{
    protected $_validate = array(
        array('name','require','用户名必须！'),
        array('pwd','require','密码必须！'),
        array('name','','用户名已经存在！',0,'unique',1),// 在新增的时候验证name字段是否唯一
        array('repwd','pwd','确认密码不正确',0,'confirm'),
        array('pwd','checkPwdRules','密码格式不正确',0,'function'),
        array('name','checkNameRules','用户名格式不正确',0,'function'),
        array('name','checkName','帐号错误！',1,'function',4),  // 只在登录时候验证
        array('pwd','checkPwd','密码错误！',1,'function',4), // 只在登录时候验证
    );
    protected $_auto = array(
        array('password','',2,'ignore'),
        array('flag','1'),
        array('password','md5',3,'function'),
        array('cre_time','Mdate()',1,'function'),
        array('up_time','Mdate()',2,'function'),
    );
    protected $_scope = array(
        //
        'normal' => array(
            'where' => array('flag'=>1),
        ),
        
        'latest' => array(
            'order' => 'cre_date DESC',
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
        $pwd = $this->_post('pwd','trim,htmlspecialchars');
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
        $name = $this->_post('name','trim,htmlspecialchars');
        if(preg_match('/^^[\u0391-\uFFE5]{2,5}$/i', $name)) {  
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    private function checkName(){
        $name = $this->_post('name','trim,htmlspecialchars');
        $admin = M('admin');
        if($admin->scope('normal')->where('name='.$name)->find()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    private function checkPwd(){
        $pwd = $this->_post('pwd','trim,htmlspecialchars');
        $name = $this->_post('name','trim,htmlspecialchars');
        $admin = M('admin');
        if(!empty($name)){
            if($admin->scope('normal')->where('pwd='.md5($pwd).' and name='.$name)->find()){
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
}