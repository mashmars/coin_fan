<?php
/**
 * User: aile
 * Date: 2017/4/6
 * Time: 下午8:55
 * Created by movesay
 */


// 钱包对接扩展
class client
{
	public $url;
	public $timeout;
	public $username;
	public $password;
	public $is_batch = false;
	public $batch = [];
	public $debug = false;
	public $jsonformat = false;
	public $res = "";
	public $headers = [
		"User-Agent: Movesay.com Rpc",
		"Content-Type: application/json",
		"Accept: application/json",
		"Connection: close"
	];
	public $ssl_verify_peer = true;
	// $username 钱包服务器用户名
	// $password 钱包服务器密码
	// $ip 钱包服务器ip
	// $port 钱包服务器端口
	// $timeout 超时
	// $headers 标题
	// $jsonformat json 格式
	public function __construct($username = null, $password = null, $ip = null, $port = null, $timeout = null, $headers = null, $jsonformat = null)
	{
		
		$this->url = "http://" . $ip . ":" . $port;
		$this->username = $username;
		$this->password = $password;
		$this->timeout = $timeout;
		$this->headers = array_merge($this->headers, $headers);
		$this->jsonformat = $jsonformat;
	}
	
	/**
	 * 魔法调用
	 * ++++++++++++++
	 */
	public function __call($method = null, $params = [])
	{
		
		if (count($params) === 1 && is_array($params[0])) {
			$params = $params[0];
		}
		$res = self::execute($method, $params);
		return $res ? $res : $this->res;
	}
	
	/**
	 * 执行请求
	 * ++++++++++++++
	 */
	public function execute($procedure, $params = null)
	{
		return $this->doRequest($this->prepareRequest($procedure, $params));
	}
	
	
	/**
	 * 处理远程调用参数
	 * ++++++++++++++
	 */
	public function prepareRequest($procedure = null, $params = null)
	{
		$payload = [
			"jsonrpc" => "2.0",
			"method"  => $procedure,
			"id"      => mt_rand()
		];
		if (!empty($params)) {
			$payload["params"] = $params;
		}
		
		return $payload;
	}
	
	
	/**
	 * http 请求
	 * ++++++++++++++
	 */
	private function doRequest($payload = [])
	{
		
		$stream = fopen(trim($this->url), "r", false, $this->getContext($payload));
		if (!is_resource($stream)) {
			self::error("Unable to establish a connection");
			return false;
		}
		
		$metadata = [];
		$metadata = stream_get_meta_data($stream);
		if (!$metadata) {
			return false;
		}
		
		$response = [];
		$response = json_decode(iconv("utf-8", "gb2312//IGNORE", stream_get_contents($stream)), true);
		
		if (isset($response["result"])) {
			return $response["result"];
		} else {
			return $response;
		}
	}
	
	/**
	 * 构造rpc请求数据
	 * ++++++++++++++
	 */
	private function getContext($payload = [])
	{
		$headers = [];
		$headers = $this->headers;
		if (!empty($this->username) && !empty($this->password)) {
			$headers[] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password);
		}
		
		return stream_context_create([
			"http" => [
				"method"           => "POST",
				"protocol_version" => 1.1,
				"timeout"          => $this->timeout,
				"max_redirects"    => 2,
				"header"           => implode("\r\n", $headers),
				"content"          => json_encode($payload),
				"ignore_errors"    => true
			],
			"ssl"  => [
				"verify_peer"      => $this->ssl_verify_peer,
				"verify_peer_name" => $this->ssl_verify_peer
			]
		]);
	}
	
	/**
	 * 打印调试信息
	 */
	protected function debug($str)
	{
		if (is_array($str)) {
			$str = implode("#", $str);
		}
		ms::debug($str, "CoinClient");
	}
	
	/**
	 * 报错信息
	 */
	protected function error($str)
	{
		if ($this->jsonformat) {
			$this->res = json_encode([
				"data"   => $str,
				"status" => 0
			]);
		} else {
			echo json_encode([
				"info"   => $str,
				"status" => 0
			]);
			die();
		}
	}
}