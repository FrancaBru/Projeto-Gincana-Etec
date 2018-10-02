<?php
	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
	        mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

	$nomeAtiv = $_POST['nomeAtiv'];
	$descricao = $_POST['descricao'];
	$pontos = $_POST['pontos'];
	$curso = $_POST['curso'];
	$sexo = $_POST['sexo'];
	$grupo = 'N';
	$vID = $_POST['id'];
	
	if(isset($_POST["grupo"])){
		$grupo = $_POST['grupo'];
	}

	if(isset($_POST['inRifa'])){
		$inRifa = 'S';
	}else{
		$inRifa = 'N';
	}

	if($inRifa == 'S'){
		$valorRifa = $_REQUEST['valorRifa'];
		$qtdMin = '0';
		$qtdMax = '0';
		$limite = '9999999';
	}else{
		$valorRifa = '0';
		$qtdMin = $_POST['qtdMin'];
		$qtdMax = $_POST['qtdMax'];
		$limite = $_POST['limite'];
	}

	$queryExcluir = "DELETE FROM tb_atividade WHERE id_atividade = $vID";

		$excluir = mysql_query($queryExcluir);

		if($excluir) {
			/*echo "Dados excluido com sucesso!";
			echo '<br>';
			echo "Deseja voltar para a tela de cadastro";
			echo '<br>';
			echo '<br>';
			echo '<div class="container droppedHover form-signin botao">';
				echo '<a href="cadastro_atividade.html">';
					echo '<button class="btn btn-lg btn-primary btn-block" type="reset">SIM</button>';
				echo '</a>';

				echo '<a href="menu_adm.html">';
					echo '<button class="btn btn-lg btn-primary btn-block" type="reset">NÃO</button>';
				echo '</a>';
			echo '</div>';
			*/} else {
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
	<script type="text/javascript">
		function redirecionar(){
				if(confirm("Exclusão realizada com sucesso ... Deseja voltar para a tela de cadastro ?")){
					setTimeout("window.location='cadastro_atividade.html'");
				}else{
					setTimeout("window.location='menu_adm.html'");
				}
		}
	</script>
</head>
<body>
	<script>redirecionar();</script>
</body>
</html>