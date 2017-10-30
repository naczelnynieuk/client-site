<?php 
namespace MyApp;

/**
* 
*/
class Order {
	private $_orderData;
	private $_instance;
	private $_result;

	public function __construct() {
		$this->_instance = DB::getInstance();
	}

	public function add($data) {
		$this->_instance->insert('orders', $data);
	}

	public function getOrderByHash($hash){
		if($this->_orderData = $this->_instance->select('orders', ['hash', '=', $hash])){
			$this->_result = 1;
		}else {
			$this->_result = 0;
		}
	}

	public function updateByHash($params){
		$this->_result = null;

		$this->_result = $this->_instance->update('orders', ['hash', '=', $this->_orderData[0]['hash']], $params);
		return $this->_result;
	}

	public function isExists(){
		return $this->_result;
	}
}