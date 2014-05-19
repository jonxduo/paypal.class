<?php
include('../paypal.class.php');

$pp_btn=new paypal_button('test-store@jxd.it');
$pp_btn->set_return('http://margheritadiaprile.it/paypalclass/example/');
$pp_btn->set_notify_url('http://margheritadiaprile.it/paypalclass/example/ipn.php');

$pay_id=substr(md5(time()), 0, 8);
$bottone=$pp_btn->get_button('Test Paypal Class', $pay_id, '0.50');
?>
<html>
	<head>
		<style>
			.wrapper{width:800px; margin:20px auto; background:#efefef; border:1px solid #ddd; padding:20px;}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<h1>Test Paypal</h1>
			<p>Questa pagina serve per testare la classe di paypal di cui si parla in questo articolo [Link all'articolo su webhouse]</p>
			<div class="row1">
				<h2>Prova un nuovo pagamento</h2>
				<p>La transazione avviene mediante un account sandbox, per cui non verrà effettuato nessun reale pagamento.</p>
				<p>Per effettuare il pagamento puoi utilizzare l'account sandbox: test-user@jxd.it, la password è: 12345678</p>
				<p>Il codice identificativo di questo pagamento sarà: <?php echo $pay_id; ?></p>

				<div class="paybutton"><?php echo $bottone; ?></div>
			</div>
			<div class="row2">
				<h2>Controlla lo stato del tuo pagamento di prova</h2>
				<?php if(!$_GET['id']){ ?>
				<p>Inserisci il codice identificativo del pagamento di prova che hai fatto nel campo qui sotto e premi invia</p>
				<form method="GET">
					Item Number: <input type="textfield" name="id" /><br/>
				</form>
				<?php }else{
					$ipn=unserialize(file_get_contents('report/order-'.$_GET['id'].'.txt'));
					debug($ipn);
				} ?>
			</div>
		</div>
	</body>
</html>

<?php
function debug ($var, $title=NULL){
	if($title==NULL)$title='';
	echo '<pre>'.$title.'<br/>'.print_r($var, true).'</pre>';
}
?>