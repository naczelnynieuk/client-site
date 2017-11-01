<?php 
namespace MyApp;

/**
* 
*/
class Order {
	private $_orderData;
	private $_messages;
	private $_instance;
	private $_result;

	public function __construct() {
		$this->_instance = DB::getInstance();
	}

	public function add($data) {
		$this->_instance->insert('orders', $data);
	}

	public function addNames() {
		$this->_orderData['coder_name'] = \MyApp\Db::getInstance()->getCoderNameFromOrders($this->_orderData['coder_id'] );
    	$this->_orderData['client_name'] = \MyApp\Db::getInstance()->getClientNameFromOrders($this->_orderData['client_id'] );
	}

	public function getOrderByHash($hash){
		if($this->_orderData = $this->_instance->select('orders', ['hash', '=', $hash])){
			$this->_result = 1;
		}else {
			$this->_result = 0;
		}
	}

	public function getById($id){
		if($this->_orderData = $this->_instance->select('orders', ['id', '=', $id])[0]){
			$this->_result = 1;
		}else {
			$this->_result = 0;
		}
	}

	public function updateById($params){
		$this->_result = null;

		$this->_result = $this->_instance->update('orders', ['id', '=', $this->_orderData[0]['id']], $params);
		return $this->_result;
	}

	public function updateByHash($params){
		$this->_result = null;

		$this->_result = $this->_instance->update('orders', ['hash', '=', $this->_orderData[0]['hash']], $params);
		return $this->_result;
	}

	public function isExists(){
		return $this->_result;
	}

	public function getData(){
		return $this->_orderData;
	}

	public function addMessage($id, $message){
		$this->_instance->insert('orders_messages', [
			'order_id' => $this->_orderData['id'],
			'user_id' => $id,
			'message' => $message,
			'date' => date('Y-m-d H:i:s')
		]);

	}

	public function dlMessages(){
		if($this->_messages = $this->_instance->select('orders_messages', ['order_id', '=', $this->_orderData['id']])){
			$this->_result = 1;
		}else {
			$this->_result = 0;
		}
	}

	public function getMessages(){
		return $this->_messages;
	}
}