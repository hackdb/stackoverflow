<?php
	use Rct567\DomQuery\DomQuery;
	require __DIR__ . '/vendor/autoload.php';
	$page = (int)file_get_contents( "cronData/id" );
	$url = "https://stackoverflow.com/questions?page=$page&pagesize=50";
	$html = file_get_contents( $url );
	$dom = new DomQuery( $html );
	echo(count($dom->find('.question-summary'))); // output: Hello
	exit();
	$dsn = "mysql:host=localhost;dbname=stackoverflow";
	$user = "root";
	$passwd = "";
	$con = new PDO($dsn, $user, $passwd);
	$sql = "INSERT INTO
		question_mst(
			question_uid,
			question_title,
			question_description,
			question_url,
			question_time
		) VALUES(
			:question_uid,
			:question_title,
			:question_description,
			:question_url,
			:question_time
		)
	";
	$stmt = $con->prepare( $sql );
	foreach( $data as $question ){
		$stmt->execute( [
			"question_uid" => $question->uid,
			"question_title" => $question->title,
			"question_description" => $question->description,
			"question_url" => $question->url,
			"question_time" => $question->question_time
		] );
	}
?>
