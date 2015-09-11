<?php
namespace Robote\Alipay;

class AlipayWap
{

    private $_input_charset = 'UTF-8';

    protected $config;

    public function __construct($app)
    {
        $this->config = $app->config->get('robote-alipay-wap');
    }


    public function payment($order_id, $amount, $show_url, $subject = '', $body = '', $it_b_pay = '' , $extern_token = '')
    {
        require_once("lib/alipay_submit.class.php");

        //支付类型
        $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = $this->config['notify_url'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = $this->config['return_url'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //商户订单号
        $out_trade_no = $order_id;
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = $subject;
        //必填

        //付款金额
        $total_fee = $amount;
        //必填

        //商品展示地址
        $show_url = $show_url;
        //必填，需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html

        //订单描述
        $body = $body;
        //选填

        //超时时间
        $it_b_pay = $it_b_pay;
        //选填

        //钱包token
        $extern_token = $extern_token;
        //选填

        /************************************************************/

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "alipay.wap.create.direct.pay.by.user",
            "partner" => $this->config['partner'],
            "seller_id" => $this->config['partner'],
            "payment_type"	=> $payment_type,
            "notify_url"	=> $notify_url,
            "return_url"	=> $return_url,
            "out_trade_no"	=> $out_trade_no,
            "subject"	=> $subject,
            "total_fee"	=> $total_fee,
            "show_url"	=> $show_url,
            "body"	=> $body,
            "it_b_pay"	=> $it_b_pay,
            "extern_token"	=> $extern_token,
            "_input_charset"	=> trim(strtolower($this->_input_charset))
        );

        //建立请求
        $alipaySubmit = new AlipaySubmit($this->config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
    }


}