<?php

namespace Admin\Controller;
use Think\Controller;
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");

class WechatController
{
	public function valid()
    {

        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj      = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername   = $postObj->ToUserName;//微信公众平台
                $keyword      = trim($postObj->Content);//用户的发送的内容
                $time         = time();
                $msgType      = $postObj->MsgType; //判断用户发送的消息是文本消息

                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if ($msgType == "text") {
                    if(!empty( $keyword ))
                    {
                        $msgType    = "text";
                        $contentStr = "Welcome to wechat world!";
                        //拼接XML字符串
                        $resultStr  = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }else{
                        echo "Input something...";
                    }  
                }
        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce     = $_GET["nonce"];
        		
		$token     = TOKEN;
		$tmpArr    = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr    = implode( $tmpArr );
		$tmpStr    = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

$wechatObj = new WechatController();
$wechatObj->responseMsg();
?>