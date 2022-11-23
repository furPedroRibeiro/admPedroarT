<?php
session_start();
  $user = 'root';
  $pass = '';
  $banco = 'vitrine';
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
                <td id="tdProd">'.$row['valor'].'</td>
                <td id="tdProd">
                  <a href="index.php?removeProd='.$row['cd_produto'].'&nomeProd='.$row['nome'].'" style="text-decoration: none">
                    <img src="img/lixeira.png" alt="" width="25px" />
                  </a>
                  <a href="produto.php?codigo='.$row['cd_produto'].'" style="text-decoration: none">
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
                <td id="tdProd" style="background-color: var(--fundo); color: var(--corPrimaria)">'.$row['valor'].'</td>
                <td id="tdProd" style="background-color: var(--fundo); color: var(--corPrimaria)">
                  <a href="index.php?removeProd='.$row['cd_produto'].'&nomeProd='.$row['nome'].'" style="text-decoration: none">
                    <img src="img/lixeira.png" alt="" width="25px" />
                  </a>
                  <a href="produto.php?codigo='.$row['cd_produto'].'" style="text-decoration: none">
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
              <img src="img/logo.png" width="200px"/>
            </div>
            <div class="text">
              <p>Nome do Produto: '.$row['nome'].'</p>
              <p>Código do Produto: '.$row['cd_produto'].'</p>
              <p>Código da Categoria: '.$row['cd_categoria'].'</p>
              <p>Descrição do produto: '.$row['ds_produto'].'</p>
              <p>Valor: '.$row['valor'].'</p>
              <p>Link do instagram: '.$row['link'].'</p>
            </div>
          </div>
        ';
        echo '
          <script>
            document.getElementeById("descProd").innerHTML = "'.$row['ds_produto'].'"
          </script>
        ';
      }
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