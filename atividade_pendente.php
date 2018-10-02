<?php
    
    $banco = "bd_gincana2";
    $usuario = "root";
    $senha = "";
    $hostname = "localhost";

    $conn = mysql_connect($hostname,$usuario,$senha); 
            mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

    $sqlListaAtividade = mysql_query("SELECT pes.id_pessoa
    	                                    ,pes.nm_pessoa
                                            ,ativ.nm_atividade
                                            ,date_format(age.dt_atividade,'%d/%m/%Y') as dt_atividade
                                            ,age.hr_inicio
                                            ,age.hr_fim
                                        FROM tb_pessoa pes
                                       INNER JOIN tb_controle_atividade ctrl ON pes.id_pessoa = ctrl.id_pessoa
                                       INNER JOIN tb_agenda age ON ctrl.id_agenda = age.id_agenda
                                       INNER JOIN tb_atividade ativ ON age.id_atividade = ativ.id_atividade
                                       WHERE ctrl.qt_pontos = 0
                                       ORDER BY date_format(age.dt_atividade,'%d/%m/%Y')
                                            	,age.hr_inicio
                                            	,age.hr_fim
                                            	,ativ.nm_atividade;");

?>
<DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>SGEA</title>
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
			<h1 class="titulo_tela"><i>Suas Atividades Pendentes<i></h1>

			<nav class="submenu-telas">
				
			</nav>

			<br>
			<div class="container droppedHover">
				<form class="form-signin" role="form" method="post" action="cadastro_atividade.html">
					<nav class="menu_">
						<p><a href="index.html">HOME</a></p>
						<p><a href="menu_participante.html" class="submenu">MENU</a></p>
					</nav>

					<div class="campos_princ">
						<div class="campos_pri">
							<p> Segue suas atividades não realizadas</p>
						</div>
						<div>
							<?php
								$vPontos = 0;
								echo '<table class="table table-hover table_font">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>data da Atividade</th>';
											echo '<th>Horário Inicial</th>';
											echo '<th>Horário Final</th>';
											echo '<th>Nome Atividade</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
										while($registro = mysql_fetch_array($sqlListaAtividade)){
											$vID = $registro["id_pessoa"];
										echo '<tr>';
											echo '<td>'.$registro["dt_atividade"].'</td>';
											echo '<td>'.$registro["hr_inicio"].'</td>';
											echo '<td>'.$registro["hr_inicio"].'</td>';
											echo '<td>'.$registro["nm_atividade"].'</td>';
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