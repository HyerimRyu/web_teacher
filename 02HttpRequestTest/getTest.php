<?

	header('Content-Type:text/html; charset=utf-8');

	$name = $_GET['name'];
	$message = $_GET['msg'];

	echo "이름 : $name <br/>";
	echo "메세지 : $message <br/>";

?>