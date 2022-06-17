<?php

$message =
[
	'3-D Secure imzası geçersiz veya doğrulama',
	'Kart sahibi veya bankası sisteme kayıtlı değil',
	'Kartın bankası sisteme kayıtlı değil',
	'Doğrulama denemesi, kart sahibi sisteme daha sonra kayıt olmayı seçmiş',
	'Doğrulama yapılamıyor',
	'3-D Secure hatası',
	'Sistem hatası',
	'Bilinmeyen kart no',
];

if ($_POST['mdStatus'] == 1)
{
	require_once('IyzipayBootstrap.php');

	IyzipayBootstrap::init();

	$options = new \Iyzipay\Options();
	$options->setApiKey('sandbox-V9iQ8Cca5kWaJl7gSOgBwEgD4v9P007U');
	$options->setSecretKey('sandbox-3MsFgN7ihKX0HlbEG3SsryJ8g4nfBdeD');
	$options->setBaseUrl("https://sandbox-api.iyzipay.com");

	$request = new \Iyzipay\Request\CreateThreedsPaymentRequest();
	$request->setConversationId($_POST['conversationId']);
	$request->setPaymentId($_POST['paymentId']);
	$request->setConversationData($_POST['conversationData']);

	$payment = \Iyzipay\Model\ThreedsPayment::create($request, $options);

	if ($payment->getStatus() == 'failure')

		echo $payment->getErrorMessage();

	else echo 'Ödeme tamamlandı';
}

else echo $message[$_POST['mdStatus']];

?>