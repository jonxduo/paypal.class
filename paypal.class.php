<?php 
class paypal_button{
	private $cmd;
	private $busisness;
	private $lc;
	private $item_name;
	private $item_number;
	private $amount;
	private $currency_code;
	private $no_note;
	private $bn;
	private $notify_url;
	private $return;
	private $cbt;
	private $rm;
	function __construct($email){
		$setting=$GLOBALS['setting'];
		$this->cmd='_xclick';
		$this->busisness=$email;
		$this->lc='IT';
		$this->currency_code='EUR';
		$this->no_note=0;
		$this->bn=urlencode('PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest');
		$this->notify_url=$setting['base_path'].'/ipn.php';
		$this->return=$setting['base_path'];
		$this->cbt='Torna a TEST PAYPAL';
		$this->rm=2;
	}
	function set_item_name($var){
		$this->item_name=$var;
	}
	function set_item_number($var){
		$this->item_number=$var;
	}
	function set_amount($var){
		$this->amount=$var;
	}
	function get_button($name, $number, $amount){
		$this->set_item_name($name);
		$this->set_item_number($number);
		$this->set_amount($amount);
		$url='https://www.sandbox.paypal.com/cgi-bin/webscr'
			.'?cmd='.$this->cmd
			.'&business='.$this->busisness
			.'&lc='.$this->lc
			.'&currency_code='.$this->currency_code
			.'&no_note='.$this->no_note
			.'&bn='.$this->bn
			.'&notify_url='.$this->notify_url
			.'&return='.$this->return
			.'&cbt='.$this->cbt
			.'&rm='.$this->rm
			.'&item_name='.$this->item_name
			.'&item_number='.$this->item_number
			.'&amount='.$this->amount;
		return '<a href="'.$url.'">Paga ora</a>';
	}
}

class paypal_ipn{
	private $stato;
	private $valuta;
	private $importo;
	private $data;
	private $id_prodotto;
	private $notifica;
	private $serialize;
	function __construct($array){
		$this->notifica=$array;
		$this->importo=$this->get_importo();
		$this->stato=$array['payment_status'];
		$this->valuta=$array['mc_currency'];
		$this->data=$array['payment_date'];
		$this->id_prodotto=$array['item_number'];
		$this->serialize=serialize($array);
	}
	function get_importo(){
		if (isset($this->notifica['mc_gross_x'])){
			return $this->notifica['mc_gross_x'];
		}else{
			return $this->notifica['mc_gross'];
		}
	}
}
?> 