<?php
    
    $banco = "bd_gincana2";
    $usuario = "root";
    $senha = "";
    $hostname = "localhost";

    $conn = mysql_connect($hostname,$usuario,$senha); 
            mysql_select_db($banco) or die("Não foi possível conectar ao banco MySQL");

    $sqlListaDoacao = mysql_query("SELECT cur.nm_curso
                                         ,concat(cur.nr_semestre,' - ' ,cur.nm_turma) turma
                                         ,pes.nm_pessoa
                                         ,doa.ds_doacao
                                         ,doa.vl_doacao
	                                     ,ctrl.qt_pontos
                                    FROM tb_pessoa pes
 							       INNER JOIN tb_curso_pessoa cpes ON pes.id_pessoa = cpes.id_pessoa
 								   INNER JOIN tb_curso cur ON cpes.id_curso = cur.id_curso
 								   INNER JOIN tb_controle_atividade ctrl ON pes.id_pessoa = ctrl.id_pessoa
 								   INNER JOIN tb_doacao doa ON ctrl.id_doacao = doa.id_doacao
 								   ORDER BY 1, 2, 3, 4");

?>
<DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>SGEA	</title>
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
			<h1 class="titulo_tela"><i>Lista de doações realizadas<i></h1>

			<nav class="submenu-telas">
				
			</nav>

			<br>
			<div class="container droppedHover">
				<form class="form-signin" role="form" method="post">
					<nav class="menu_">
						<p><a href="menu_adm.html">MENU</a></p>
						<p><a class="submenu" href="registro_doacao.html">VOLTAR</a></p>
					</nav>
					<div class="campos_princ">
						<div>
							<?php
								$vTotalPontos = 0;
								$vTotalValor = 0;
								echo '<table class="table table-hover table_font_">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Curso</th>';
											echo '<th>Turma</th>';
											echo '<th>Participante</th>';
											echo '<th>Material doado</th>';
											echo '<th>Valor da doação</th>';
											echo '<th>Pontos</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
										while($registro = mysql_fetch_array($sqlListaDoacao)){
											$vTotalPontos += $registro["qt_pontos"];
											$vTotalValor += $registro["vl_doacao"];
										echo '<tr>';
											echo '<td>'.utf8_encode($registro["nm_curso"]).'</td>';
											echo '<td>'.$registro["turma"].'</td>';
											echo '<td>'.utf8_encode($registro["nm_pessoa"]).'</td>';
											echo '<td>'.utf8_encode($registro["ds_doacao"]).'</td>';
											echo '<td>'.$registro["vl_doacao"].'</td>';
											echo '<td>'.$registro["qt_pontos"].'</td>';
										echo '</tr>';
										}
										echo '<tr>';
											echo '<td><b>Total:</b></td>';
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
											echo '<td><b>'.number_format($vTotalValor,2,".","").'</b></td>';
											echo '<td><b>'.$vTotalPontos.'</b></td>';
										echo '<tr>';
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