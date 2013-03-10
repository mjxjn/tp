<?php

/**
 * Description of GoodsAction
 *
 * @author maxiang
 */
class GoodsAction extends CommonAction {

    public function orderList() {
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
        $row = 0;             
        //$repeat_arr    = array();                                   //保存重复的行数                                   //保存插入tp_server的ser_ids
        while ($data = fgetcsv($file, 1001, ',')) {     //开始读取csv文件
            $row++;
            if ($row == 1) {
                continue;
            }
            $servname = iconv("GBK","UTF-8",trim($data[0]));
            dump($servname);
        }      
        fclose($file);                                                  //关闭文件
    }

}

?>