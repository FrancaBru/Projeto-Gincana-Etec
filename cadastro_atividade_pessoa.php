<?php
    
    $banco = "bd_gincana2";
    $usuario = "root";
    $senha = "";
    $hostname = "localhost";

    $conn = mysql_connect($hostname,$usuario,$senha); 
            mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");
        

        $sql =mysql_query("SELECT nm_atividade FROM TB_ATIVIDADE");    

?>

<DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>SGEA</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/hover.css" media="all">
		<img src="img\etec01.png" alt="ETEC" class="img_principal">

	</head>

	<body>

		<nav>
			
		</nav>
		<!-- conteudo principal !-->
		<main>
			<h1 class="titulo_tela"><i>Registre suas Atividades<i></h1>

			<br>
			<div class="container droppedHover">
				<form class="form-signin" role="form">
					
					<div class="campos_princ">
						<p> Escolha a Atividade</p>

                        <div class="campos_pri">
					    	<select name="atividade" class="form-control" required="" autofocus="">
        						<option value=""> Escolha... </option>

                                <?php while($opc = mysql_fetch_array($sql)){ ?>

                            <option><?php echo $opc['nm_atividade'] ?> </option><?php }?>
        					</select>

                            <button type="button" class="btn btn-primary" id="botao_search">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                        <br><br>
                        <div class="campos_qua">
                        <p> Você pode participar
                        <input type="text" class="form-control" placeholder="" required="" contenteditable="false" disabled="true">
                        </div>
					
        				<div>
                            <br>
        					<div>
                                <p>Escolha o dia e o horário
                                <table class="table table_hora">
                                    <thead>
                                        <tr>
                                            <td><b> 11/06/2016 </b></td>
                                            <td><b> 12/06/2016 </b></td>
                                            <td><b> 13/06/2016 </b></td>
                                            <td><b> 14/06/2016 </b></td>
                                        </tr>
                                    </thead>
                                    <tboby>
                                        <tr>
                                            <td><input type="checkbox" name="data" value="?"> 09:00 - 10:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 09:00 - 10:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 09:00 - 10:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 09:00 - 10:00</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="data" value="?"> 10:00 - 11:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 10:00 - 11:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 10:00 - 11:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 10:00 - 11:00</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="data" value="?"> 11:00 - 12:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 11:00 - 12:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 11:00 - 12:00</td>
                                            <td><input type="checkbox" name="data" value="?"> 11:00 - 12:00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
        				</div>


                        <br><br>
                        <div class="botao">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Gravar</button>
                        </div>

                        <div class="botao">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Excluir</button>
                        </div>

                        <div class="botao">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Alterar</button>
                        </div>

					</div>



				</form>
			</div>

		</main>
		
		<!-- rodapé !-->
		<footer>
			
		</footer>

	</body>
</html>