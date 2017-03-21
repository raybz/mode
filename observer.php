<?php 
// 观察者模式
// 
class order {
	//容器
	protected $observers = array();
	//观察者 新增
	public function addObServer($type, $observer)
	{
		$this->observers[$type][] = $observer;
	}
	public function obServers($type) 
	{
		if (isset($this->observers[$type])) {
			foreach ($this->observers[$type] as $obser) {
				$a = new $obser;
				$a->update($this);
			}
		}
	}

	public function create()
	{
		echo "购物成功\n";
		$this->obServers('buy');
	}
}

class orderEmail {  
    public static function update($order) {  
        echo "发送购买成功一个邮件\n";  
    }  
}

class orderStatus {  
    public static function update($order) {  
        echo "改变订单状态\n";  
    }  
}

$ob = new order;  
$ob->addObServer('buy', 'orderEmail');  
$ob->addObServer('buy', 'orderStatus');  
$ob->create();  