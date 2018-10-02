<?php

	$banco = "bd_gincana2";
	$usuario = "root";
	$senha = "";
	$hostname = "localhost";

	$conn = mysql_connect($hostname,$usuario,$senha); 
	        mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

	$id = $_GET['id'];   
	
	$queryBusca = "SELECT ativ.qt_pontos
  					 FROM tb_controle_atividade ctrl
 				    INNER JOIN tb_agenda age ON ctrl.id_agenda = age.id_agenda
 				    INNER JOIN tb_atividade ativ ON age.id_atividade = ativ.id_atividade
 				    WHERE ctrl.id_controle_atividade = $id";
    
    $ponto = mysql_query($queryBusca);
    $qtPontos = mysql_fetch_assoc($ponto);
    $vPonto = $qtPontos['qt_pontos'];
    
    $queryUpDate = "UPDATE tb_controle_atividade SET qt_pontos = '$vPonto', dt_atlz = sysdate() WHERE id_controle_atividade = $id";

	$alterar = mysql_query($queryUpDate);

		if($alterar) {
			echo "Pontos registrados com sucesso!";
			echo '<br>';
			echo '<br>';
			echo '<div class="container droppedHover form-signin botao">';
				echo '<a href="cadastro_pontuacao_atividade_dupla.php">';
					echo '<button class="btn btn-lg btn-primary btn-block" type="reset">OK</button>';
				echo '</a>';
			echo '</div>';
			} else {
			echo "Não foi possível registrar os pontos, tente novamente.";
			echo '<br>';
			// Exibe dados sobre o erro:
			echo "Dados sobre o erro:".'<br>'. mysql_error();
		}
?>