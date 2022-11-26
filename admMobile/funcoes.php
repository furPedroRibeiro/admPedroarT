<?php
  session_start();
  $user = 'bairpfhw_melbbss';
  $pass = 'Pep-25mai06';
  $banco = 'bairpfhw_vitrine';
  $server = 'localhost';
  $conn = new mysqli($server, $user, $pass, $banco);
  if(!$conn){
    echo "Erro de conexão ".$conn->error;
  }
  /* Funções realizadas pelo administrador */
  function redirect($text){
    header("refresh: 0.1 , url = index.php");
    echo '
      <script>
        alert("'.$text.'")
      </script>
    ';
  }
  function redirectProd($text, $cod){
    header("refresh: 0.1 , url = produto.php?codigo=".$cod);
    echo '
      <script>
        alert("'.$text.'")
      </script>
    ';
  }
  function CadastrarCategoria($name){
    $sql = 'INSERT INTO categoria VALUES (null, "'.$name.'")';
    $res = $GLOBALS['conn']->query($sql);

    if($res){
      $text = 'Categoria cadastrada com sucesso!!!';
      redirect($text);
    } else{
      $text = 'Erro ao cadastrar categoria!!!';
      redirect($text);
    }
  }
  function EditarCategoria($name, $cat){
    $sql = 'UPDATE categoria SET nome = "'.$name.'" WHERE cd ='.$cat;
    $res = $GLOBALS['conn']->query($sql);

    if($res){
      $text = 'Categoria editada com sucesso!!!';
      redirect($text);
    } else{
      $text = 'Erro ao editar categoria!!!';
      redirect($text);
    }
  }
  function MostrarCategoria(){
    $sql = 'SELECT * FROM categoria';
    $res = $GLOBALS['conn']->query($sql);

    if($res -> num_rows > 0){
      while($row = $res->fetch_assoc()){
        if($row['cd'] % 2 == 1){
          echo '
              <tr>
                <td id="tdCat">'.$row['cd'].'</td>
                <td id="tdCat">'.$row['nome'].'</td>
                <td id="tdCat">
                  <a href="index.php?removeCat='.$row['cd'].'&nomeCat='.$row['nome'].'" style="text-decoration: none">
                    <img src="img/lixeira.png" alt="" width="25px" />
                  </a>
                  <a href="#editar" onclick="mostrarEditCat()" style="text-decoration: none">
                    <img src="img/escrever.png" alt="" width="25px" />
                  </a>
                </td>
              </tr>
        ';
        } else{
          echo '
              <tr>
                <td id="tdCat" style="background-color: var(--fundo); color: var(--corPrimaria)">'.$row['cd'].'</td>
                <td id="tdCat" style="background-color: var(--fundo); color: var(--corPrimaria)">'.$row['nome'].'</td>
                <td id="tdCat" style="background-color: var(--fundo); color: var(--corPrimaria)">
                  <a href="index.php?removeCat='.$row['cd'].'&nomeCat='.$row['nome'].'" style="text-decoration: none">
                    <img src="img/lixeira.png" alt="" width="25px" />
                  </a>
                  <a href="#editar" onclick="mostrarEditCat()" style="text-decoration: none">
                    <img src="img/escrever.png" alt="" width="25px" />
                  </a>
                </td>
              </tr>
        ';
        }
      }
    } else{
      echo '
              <tr>
                <td id="tdCat">Null</td>
                <td id="tdCat">Null</td>
                <td id="tdCat">
                  <a href="" style="text-decoration: none">
                    <img src="img/lixeira.png" alt="" width="25px" />
                  </a>
                  <a href="" style="text-decoration: none">
                    <img src="img/escrever.png" alt="" width="25px" />
                  </a>
                </td>
              </tr>
        ';
    }
  }
  function MostrarCategoriaSelect(){
    $sql = 'SELECT * FROM categoria';
    $res = $GLOBALS['conn']->query($sql);

    if($res -> num_rows > 0){
      while($row = $res->fetch_assoc()){
        echo '
                <option value="'.$row['cd'].'">'.$row['nome'].'</option>
        ';
      }
    }
  }
  function ExcluirCategoria($cd, $nome){
      $sql = 'DELETE FROM categoria WHERE cd ='.$cd;
      $res = $res = $GLOBALS['conn']->query($sql);
      if($res){
        $text = 'Categoria excluída com sucesso!!!';
        redirect($text);
      } else{
        $text = 'Erro ao excluir categoria(verifique se há produtos utilizando)!!!';
        redirect($text);
      }
  }
  function CadastrarProduto($cdCat, $descProd, $imagem, $link, $nome, $valor){
    $sql = 'INSERT INTO produto(cd_categoria, cd_produto, ds_produto, imagem, link, nome, valor) VALUES ("'.$cdCat.'", null, "'.$descProd.'", "'.$imagem.'", "'.$link.'", "'.$nome.'", "'.$valor.'")';
    $res = $GLOBALS['conn']->query($sql);
    if($res){
      $text = 'Produto cadastrado com sucesso!!!';
      redirect($text);
    } else{
      $text = 'Erro ao cadastrar produto!!!';
      redirect($text);
    }
  }
  /* EditarProduto($_POST['descProd'], $file, $_POST['linkProd'], $_POST['nomeProdEdit'], $_POST['valor']); */
  function EditarProduto($descProd, $imagem, $link, $nome, $valor, $codigo){
    $sql = 'UPDATE produto SET ds_produto="'.$descProd.'", imagem="'.$imagem.'", link="'.$link.'", nome="'.$nome.'", valor='.$valor.' WHERE cd_produto='.$codigo;
    $res = $GLOBALS['conn']->query($sql);
    if($res){
      $text = 'Produto editado com sucesso!!!';
      redirectProd($text, $codigo);
    } else{
      $text = 'Erro ao editar produto!!!'.$sql;
      redirectProd($text, $codigo);
    }
  }
  function MostrarProduto(){
    $sql = 'SELECT * FROM produto';
    $res = $GLOBALS['conn']->query($sql);

    if($res -> num_rows > 0){
      while($row = $res->fetch_assoc()){
        if($row['cd_produto'] % 2 == 1){
          echo '
              <tr>
                <td id="tdProd">'.$row['cd_produto'].'</td>
                <td id="tdProd">'.$row['nome'].'</td>
                <td id="tdProd">R$'.$row['valor'].'</td>
                <td id="tdProd">
                  <a href="index.php?removeProd='.$row['cd_produto'].'&nomeProd='.$row['nome'].'" style="text-decoration: none">
                    <img src="img/lixeira.png" alt="" width="25px" />
                  </a>
                  <a href="produto.php?codigo='.$row['cd_produto'].'" target="_blank" style="text-decoration: none">
                    <img src="img/escrever.png" alt="" width="25px" />
                  </a>
                </td>
              </tr>
        ';
        } else{
          echo '
              <tr>
                <td id="tdProd" style="background-color: var(--fundo); color: var(--corPrimaria)">'.$row['cd_produto'].'</td>
                <td id="tdProd" style="background-color: var(--fundo); color: var(--corPrimaria)">'.$row['nome'].'</td>
                <td id="tdProd" style="background-color: var(--fundo); color: var(--corPrimaria)">R$'.$row['valor'].'</td>
                <td id="tdProd" style="background-color: var(--fundo); color: var(--corPrimaria)">
                  <a href="index.php?removeProd='.$row['cd_produto'].'&nomeProd='.$row['nome'].'" style="text-decoration: none">
                    <img src="img/lixeira.png" alt="" width="25px" />
                  </a>
                  <a href="produto.php?codigo='.$row['cd_produto'].'" target="_blank" style="text-decoration: none">
                    <img src="img/escrever.png" alt="" width="25px" />
                  </a>
                </td>
              </tr>
        ';
        }
      }
    } else{
      echo '
              <tr>
                <td id="tdProd">Null</td>
                <td id="tdProd">Null</td>
                <td id="tdProd">Null</td>
                <td id="tdProd">
                  <a href="" style="text-decoration: none">
                    <img src="img/lixeira.png" alt="" width="25px" />
                  </a>
                  <a href="" style="text-decoration: none">
                    <img src="img/escrever.png" alt="" width="25px" />
                  </a>
                </td>
              </tr>
        ';
    }
  }
  function MostrarProdutoEspecifico($codigo){
    $sql = 'SELECT * FROM produto WHERE cd_produto='.$codigo;
    $res = $GLOBALS['conn']->query($sql);

    if($res){
      while($row = $res->fetch_assoc()){
        echo '
          <div class="card">
            <div class="img">
              <img src="'.$row['imagem'].'" width="300px"/>
            </div>
            <div class="text">
              <p>Nome do Produto: '.$row['nome'].'</p>
              <p>Código do Produto: '.$row['cd_produto'].'</p>
              <p>Código da Categoria: '.$row['cd_categoria'].'</p>
              <p>Descrição do produto: '.$row['ds_produto'].'</p>
              <p>Valor: R$'.$row['valor'].'</p>
              <p>Link do instagram: '.$row['link'].'</p>
            </div>
          </div>
        ';
        /*Formulário de edição*/
        echo '
        <form action="" method="post" class="form">
              <h3 id="titleForm">Editar produto</h3>
              <p>Não é preciso preencher todos os dados novamente, apenas os que você deseja editar</p>
              <input
                type="text"
                name="descProd"
                id="descProd"
                placeholder="Digite a descrição do produto:"
                class="input"
                value="'.$row['ds_produto'].'"
              />
              <input
                type="url"
                name="linkImagem"
                id="linkImagem"
                placeholder="Endereço da imagem do produto:"
                class="input"
                value="'.$row['imagem'].'"
              />
              <input
                type="url"
                name="linkProd"
                id="linkProd"
                placeholder="Coloque o link do instagram do produto:"
                class="input"
                value="'.$row['link'].'"
              />
              <input
                type="text"
                name="nomeProdEdit"
                id="nomeProdEdit"
                placeholder="Digite o nome do produto:"
                class="input"
                value="'.$row['nome'].'"
              />
              <input
                type="text"
                name="valor"
                id="valor"
                placeholder="Digite o valor, Ex.: 40.00"
                class="input"
                value="'.$row['valor'].'"
              />
        ';
      }
    }
  }
  function EditarCategoriaProduto($cat, $cdprod){
    $sql = 'UPDATE produto SET cd_categoria = "'.$cat.'" WHERE cd_produto ='.$cdprod;
    $res = $GLOBALS['conn']->query($sql);
    if($res){
      $text = 'Categoria de produto atualizada com sucesso!!!';
      redirectProd($text, $cdprod);
    } else{
      $text = 'Categoria de produto atualizada sem sucesso!!!';
      redirectProd($text, $cdprod);
    }
  }
  function ExcluirProduto($cd, $nome){
    $sql = 'DELETE FROM produto WHERE cd_produto ='.$cd;
    $res = $GLOBALS['conn']->query($sql);
    if($res){
      $text = 'Produto excluído com sucesso!!!';
      redirect($text);
    } else{
      $text = 'Erro ao excluir produto!!!';
      redirect($text);
    }
  }
  /*function JsonCategoria(){
    $sql = 'SELECT * FROM categoria';
    $res = $GLOBALS['conn']->query($sql);

    if($res -> num_rows > 0){
      while($row = $res->fetch_assoc()){
        $myObj = '{codigo: '.$row['cd'].', categoria:"'.$row['nome'].'"}';

        $myJSON = json_encode($myObj);

        echo $myJSON;
      }
    }
  }*/
?>