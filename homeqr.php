<?php

	require 'phpqrcode/qrlib.php';
	$url = 'http://yingathungkikon.000.pe';


	$qrCodeImagePath = 'image/qr_image.png';

	QRcode::png($url, $qrCodeImagePath);

	echo 'QR code image generated successfully!';
?>