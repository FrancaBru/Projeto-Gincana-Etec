<?php

	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
	        mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

	$id = $_GET['id'];
    
    $queryUpDate = "UPDATE tb_controle_atividade SET qt_pontos = 0, dt_canc = sysdate(), dt_atlz = sysdate() WHERE id_controle_atividade = $id";

	$alterar = mysql_query($queryUpDate);

		if($alterar) {
			echo "Pontos cancelados!";
			echo '<br>';
			//echo $id;
			echo '<br>';
			//echo $queryUpDate;
			echo '<br>';
			//echo $alterar;
			echo '<br>';
			echo "Deseja Realizar outro cancelamento?";
			echo '<br>';
			echo '<div class="container droppedHover form-signin botao">';
				echo '<a href="cancelar_pontuacao.php">';
					echo '<button class="btn btn-lg btn-primary btn-block" type="reset">SIM</button>';
				echo '</a>';
				echo '<a href="menu_auxiliar.html">';
					echo '<button class="btn btn-lg btn-primary btn-block" type="reset">NÃO</button>';
				echo '</a>';
			echo '</div>';
			} else {
			echo "Não foi possível cancelar os pontos, tente novamente.";
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