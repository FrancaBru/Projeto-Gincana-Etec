<?php
    
    $banco = "bd_gincana2";
    $usuario = "root";
    $senha = "";
    $hostname = "localhost";

    $conn = mysql_connect($hostname,$usuario,$senha); 
            mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

    $sqlListaAtividade = mysql_query("SELECT ativ.id_atividade
	  										,ativ.nm_atividade
      										,age.id_agenda
      										,date_format(age.dt_atividade,'%d/%c/%Y') dt_atividade
      										,date_format(age.hr_inicio, '%H:%i') hr_inicio
      										,date_format(age.hr_fim, '%H:%i') hr_fim
 										FROM tb_atividade ativ 
 								   LEFT JOIN tb_agenda age ON ativ.id_atividade = age.id_atividade
				     				   WHERE ativ.in_ativo = 'S'
									   ORDER BY 2, 4, 5, 6");

?>
<DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>PLAYTECTI</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<img src="img\etec01.png" alt="ETEC" class="img_principal">
	</head>

	<body>

		<nav>
			
		</nav>
		<!-- conteudo principal !-->
		<main>
			<h1 class="titulo_tela"><i>Lista de atividades, data e horarios cadastrados<i></h1>

			<nav class="submenu-telas">
				
			</nav>

			<br>
			<div class="container droppedHover">
				<form class="form-signin" role="form" method="post" action="cadastro_atividade.html">
					<div class="campos_princ">
						<div class="campos_pri">
							<p> Selecione a atividade que deseja alterar</p>
						</div>
						<div>
							<?php
								echo '<table class="table table-hover table_font">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Nome Atividade</th>';
											echo '<th>Data</th>';
											echo '<th>Hora Inicio</th>';
											echo '<th>Hora Fim</th>';
											echo '<th></th>';
											echo '<th></th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
										while($registro = mysql_fetch_array($sqlListaAtividade)){
											$vID = $registro["id_atividade"];
										echo '<tr>';
											echo '<td>'.$registro["nm_atividade"].'</td>';
											echo '<td>'.$registro["dt_atividade"].'</td>';
											echo '<td>'.$registro["hr_inicio"].'</td>';
											echo '<td>'.$registro["hr_fim"].'</td>';
											echo '<td>'."<a href=alterar_agendamento.php?id=$vID>Alterar</a>".'</td>';
											echo '<td>'."<a href=excluir_agendamento.php?id=$vID>Excluir</a>".'</td>';
										echo '</tr>';
										}
									echo '</tbody>';
								echo '</table>'
					 		?>
					 	</div>
					</div>
				</form>
			</div>

		</main>
		
		<!-- rodapé !-->
		<footer>
			
		</footer>

		<?php
			mysql_close($conn);
		?>
	</body>
</html>