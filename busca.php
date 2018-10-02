<?php

    $conecta = mysql_connect("localhost", "root", "")or die("Erro ao conectar!");
    $banco = mysql_select_db("bd_gincana2")or die("Erro ao selecionar BD!");

    $atividade = $_REQUEST['atividade'];
    $sql = "SELECT age.hr_inicio
                  ,age.hr_fim 
                  ,pes.nm_pessoa
                  ,ctrlativ.id_controle_atividade
             FROM tb_pessoa pes
            INNER JOIN tb_controle_atividade ctrlativ ON pes.id_pessoa = ctrlativ.id_pessoa
            INNER JOIN tb_agenda age ON ctrlativ.id_agenda = age.id_agenda
            INNER JOIN tb_atividade ativ ON age.id_atividade = ativ.id_atividade 
            WHERE ativ.nm_atividade = '$atividade'
              AND ativ.in_ativ_grupo = 'N'
              AND ctrlativ.qt_pontos = 0";
 
    $query = mysql_query($sql);
    $qtd = mysql_num_rows($query);
    mysql_close($conecta);
?>

<DOCTYPE html>
<html lang="PT-BR">
  <head>
    <title>SGEA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>

  <body>

    <!-- conteudo principal !-->
    <main>

      <br>
      <div class="container droppedHover">
        <form class="form-signin" role="form" method="post" action="registrar_pontuacao.php">
          <div>
            <div>
              <header class="panel-heading">
                Dados da busca: 
              </header>
            </div>

            <div>
              <?php
                if($qtd>0){
                  echo '<table class="table table-hover table_font">';
                    echo '<thead>';
                      echo '<tr>';
                        echo '<th>Hora Inicial</th>';
                        echo '<th>Hora Final</th>';
                        echo '<th>Participantes</th>';
                        echo '<th></th>';
                      echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                      while($linha = mysql_fetch_assoc($query)){
                        $vID = $linha["id_controle_atividade"];
                      echo '<tr>';
                        echo '<td>'.$linha["hr_inicio"].'</td>';
                        echo '<td>'.$linha["hr_fim"].'</td>';
                        echo '<td>'.$linha["nm_pessoa"].'</td>';
                        echo '<td>'."<a href=registrar_pontuacao.php?id=$vID>Registrar</a>".'</td>';
                      echo '</tr>';
                      }
                    echo '</tbody>';
                  echo '</table>';
                }else{
                  echo mysql_error();
              }
              ?>
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