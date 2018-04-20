<?php



/*
* ajax登录返回函数，type=1成功 
* msg 返回信息 
*/
function ajax_return($type=1,$msg=''){
	if($type){
		return json_encode(array('info'=>'success','msg'=>$msg));
	}else{
		return json_encode(array('info'=>'error','msg'=>$msg));
	}
}

/*
 * 聚合发短信接口 $name 模板变量 $captcha 模板变量
 * */
function send_sms($tpl_id,$phone,$captcha,$name='',$money=0){
    header('content-type:text/html;charset=utf-8');

    $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
    if($name && $money){
		$tpl_value = '#name#='.$name.'&#code#='. $captcha.'&#money#='.$money ;
	}elseif($name){
        $tpl_value = '#name#='.$name.'&#code#='. $captcha ;
    }else{
        $tpl_value = '#code#='. $captcha ;
    }
    $smsConf = array(
        'key'   => 'e3e6ac7d6e49eb2a0aab644c2ab4441b', //您申请的APPKEY
        'mobile'    => $phone, //接受短信的用户手机号码
        'tpl_id'    => $tpl_id, //您申请的短信模板ID，根据实际情况修改
        'tpl_value' => $tpl_value//您设置的模板变量，根据实际情况修改
    );

    $content = juhecurl($sendUrl,$smsConf,1); //请求发送短信

    if($content){
        $result = json_decode($content,true);
        $error_code = $result['error_code'];
        if($error_code == 0){

            if(!$name || $money){
                return array('info'=>'success');
            }
            //echo "短信发送成功,短信ID：".$result['result']['sid'];
        }else{
            //状态非0，说明失败
            $msg = $result['reason'];
            return array('info'=>'error','msg'=>$msg);
        }
    }else{
        //返回内容异常，以下可根据业务逻辑自行修改
        return array('info'=>'error','msg'=>'请求发送短信失败');
    }
}
 function juhecurl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
}
/**
*单文件上传封装，
 **/
function upload_file($path,$file){
    $up = new \Think\Upload();
    $up->exts = array('jpg','jpeg','png','icon');
    $up->rootPath  = '.' . $path;
    $info = $up->uploadOne($file);
    if(!$info){
        $this->error($up->getError());
    }else{
        $res =  $info['savepath'] . $info['savename'];
    }
    return $res;
}
/*
 * 多文件上传
 * $is_ajax是否ajax返回 $is_juedui=0 是否返回绝对路径
 */
function upload_files($path,$is_ajax=0,$is_juedui=0){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  = '.' . $path;

// 上传文件
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
        $this->error($upload->getError());
    }else{// 上传成功 获取上传文件信息
        foreach($info as $file){
            if($is_ajax){
				if($is_juedui){ // 返回绝对路径
					echo json_encode($path . $file['savepath'].$file['savename']);
				}else{ //返回相对路径
					echo json_encode($file['savepath'].$file['savename']);
				}
                
            }
        }
    }
}

//检查数组每个元素是否是真
function check_arr($array){
    if(!is_array($array)){
        return false;
    }
    foreach($array as $value){
        if(!$value){
            return false;
        }
    }
    return true;
}



?>