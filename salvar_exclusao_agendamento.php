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
		echo "Não foi possível atender sua solicitação.";
		echo "Não existe agenda para essa atividade.";
		echo '<br>';
		echo '<a href="lista_atividade_agendamento.php">';
			echo '<button class="btn btn-lg btn-primary btn-block" type="reset">VOLTAR</button>';
		echo '</a>';
	}else{
		$query = "DELETE FROM tb_agenda WHERE id_agenda = '$idAgenda'";	
	}

	$excluir = mysql_query($query);

	header("location: carregaAgenda.html");

	if($excluir) {
		header("location: carregaAgenda.html");
	} else {
		echo "Não foi possível excluir os dados, tente novamente.";
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