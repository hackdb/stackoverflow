<?php
	require __DIR__ . '/vendor/autoload.php';
	exit( "Error" );
	$dom = new DomQuery('<div><h1 class="title">Hello</h1></div>');
	echo($dom->find('h1')->text()); // output: Hello
?>
