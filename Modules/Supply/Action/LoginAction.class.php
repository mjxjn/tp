<?php

class LoginAction extends Action {

    public function index() {
        if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->display("./Tpl/Login/index.html");
        } else {
            $this->redirect('Index-index');
        }
    }

    public function login() {
        if (!empty($_POST)) {
            $admin = D("Admin");
            if ($admin->create($_POST, 4)) {
                import('@.ORG.Util.RBAC');
                $admininfo = $admin->scope('normal')->where("name='" . $this->_post('name')."'")->field('id,name,department')->find();
                $_SESSION[C('USER_AUTH_KEY')] = $admininfo['id'];
                $_SESSION['loginUserName'] = $admininfo['name'];
                if ($admininfo['department'] == '管理员') {
                    $_SESSION['administrator'] = true;
                }
                //保存登录信息
                $last_login = Mdate();
                $data = array();
                $data['id'] = $admininfo['id'];
                $data['last_login'] = $last_login;
                $data['login_count'] = array('exp', 'login_count+1');
                $admin->save($data);
                // 缓存访问权限
                RBAC::saveAccessList();
                $this->success('登录成功！', __APP__ . '/Index-index');
            } else {
                $this->error("登录失败,".$admin->getError());
            }
        }
    }

    public function unlogin() {
        session(null);
        if (!session(C('USER_AUTH_KEY'))) {
            $this->success("用户成功退出", "/Login-index");
        }
    }

}

?>