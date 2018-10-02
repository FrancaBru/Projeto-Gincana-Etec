<?php

	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
	        mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

	$data = $_POST['data'];
	$nova_data = implode('-',array_reverse(explode('/',$_POST['data'])));
    $hrIncial = $_POST["hrIncial"];
    $hrFinal = $_POST["hrFinal"];
    $id = $_POST['id'];
    $idAgenda = $_POST['idAgenda'];

	if($idAgenda == ""){
		$query = "INSERT INTO tb_agenda(dt_atividade, hr_inicio, hr_fim,id_atividade, dt_incl) 
		               VALUES('$nova_data', '$hrIncial', '$hrFinal', '$id', sysdate())";
	}else{
		$query = "UPDATE tb_agenda 
	                 SET dt_atividade = '$data'
	                    ,hr_inicio = '$hrIncial'
	                    ,hr_fim = '$hrFinal'
	                    ,id_atividade = '$id'
	                    ,dt_atlz = sysdate()
	               WHERE id_agenda = '$idAgenda'";	
	}
	

	$alterar = mysql_query($query);

	header("location: carregaAgenda.html");

	if($alterar) {
		header("location: carregaAgenda.html");
	} else {
		echo "Não foi possível alterar os dados, tente novamente.";
		echo '<br>';
		// Exibe dados sobre o erro:
		echo "Dados sobre o erro:".'<br>'. mysql_error();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

</body>
</html>