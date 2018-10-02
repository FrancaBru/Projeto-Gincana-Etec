<?php
    
    $banco = "bd_gincana2";
    $usuario = "root";
    $senha = "";
    $hostname = "localhost";

    $conn = mysql_connect($hostname,$usuario,$senha); 
            mysql_select_db($banco) or die( "Não foi possível conectar ao banco MySQL");
        

    $sql = mysql_query("SELECT DISTINCT 
                               ativ.nm_atividade
                          FROM tb_atividade ativ
                         INNER JOIN tb_agenda age ON ativ.id_atividade = age.id_atividade
                         WHERE ativ.in_ativo = 'S'
                           AND ativ.nm_atividade != 'RIFA'
                         ORDER BY 1");
?>

<DOCTYPE html>
<html lang="PT-BR">
	<head>
		<title>SGEA</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/hover.css" media="all">
        <script src="js\jquery.js"></script>
		<img src="img\etec01.png" alt="ETEC" class="img_principal">

        <script type="text/javascript">
            
           $('#gravar').click(function() {
            alert("ola");
            
                var enviadados = $(".dados-dois").val();

                var xmlhttp;
                // Serie de verificação para saber se o navegador supor ajax
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                else if (window.ActiveXObject) {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                else {
                    alert("Seu navegador não suporta ajax!!");
                }
                // fuunção que determina ondesera colocado o resutado do ajax, nesse caso no 'RecebePesquisa'
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("dados-dois").innerHTML = xmlhttp.responseText;
                    }
                    else {
                        return false;
                    }
                }
                // selecio o valor que seguira como post ate a pagina da requisição
                busca = document.getElementById("buscar").value;
                // requisições ajax
                // enviando 
                xmlhttp.open("POST","salvar_atividade_pessoa.php",true);
                // padrão para metodo post
                xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                // Resposta
                xmlhttp.send("entradados="+enviadados);
                return false;
            });
        
        </script>

	</head>

	<body>

		<nav>

			
		</nav>
		<!-- conteudo principal !-->  
		<main>
			<h1 class="titulo_tela"><i>Registre suas Atividades<i></h1>

			<br>
			<div class="container droppedHover">
                <form class="form-signin"  role="form" action="salvar_atividade_pessoa.php" method="post" name="form">
                    <nav class="menu_">
                        <p><a href="index.html">HOME</a></p>
                        <p><a class="submenu" href="menu_participante.html">MENU</a></p>
                    </nav>
					<div class="campos_princ">
						<p> Escolha a Atividade</p>

                        <div class="campos_pri">
					    	<select name="atividade" id="atividade" class="form-control" required="" autofocus="">
        						<option value=""> Escolha... </option>
                                    <?php while($opc = mysql_fetch_array($sql)){ ?>
                                <option><?php echo $opc['nm_atividade'] ?> </option><?php }?>
        					</select>
                            <button type="button" class="btn btn-primary botao_search" id="buscar">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>

                        <br><br>
					
        				<div>
        					<div>
                                <div id="dados">
                                </div>
                                <script>
                                    function buscar(atividade)
                                        {
                                            var page = "registroAtivPes.php";
                                            $.ajax
                                            ({
                                                type: 'POST',
                                                dataType: 'html',
                                                url: page,
                                                beforeSend: function () {
                                                    $("#dados").html("Carregando...");
                                                },
                                                data: {atividade: atividade},
                                                success: function (msg)
                                                {
                                                    $("#dados").html(msg);
                                                }
                                            });
                                        }
                            
                                        $('#buscar').click(function () {
                                            buscar($("#atividade").val());
                                        });
                                </script>
					       </div>
				        </form>
			        </div>
		</main>

	   <!-- rodapé !-->
		<footer>
			
		</footer>
	</body>
</html>