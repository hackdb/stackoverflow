<?php
	$module = $_POST["module"];
	$data = false;
	if( isset( $data ) ){
		$data = $_POST["data"];
		$data = json_decode( $data );
	}

	$dsn = "mysql:host=localhost;dbname=stackoverflow";
	$user = "root";
	$passwd = "";
	$con = new PDO($dsn, $user, $passwd);

	switch( $module ){

		case "add-question_mst":
			if( !$data )
				exit( "No Data" );
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
			exit( "Done" );
		break;

	}
?>