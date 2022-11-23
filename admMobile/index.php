<?php
    include('funcoes.php');
?>
<?php
  if(isset($_POST['nomeCat'])){
    CadastrarCategoria($_POST['nomeCat']);
  }
?>
<?php
  if(isset($_POST['nomeEditCat'])){
    EditarCategoria($_POST['nomeEditCat'], $_POST['selectCat']);
  }
?>
<?php
  $file = 'logo.png';
  if(isset($_POST['nomeProd'])){
    CadastrarProduto($_POST['selectCat'], $_POST['descProd'], $file, $_POST['linkProd'], $_POST['nomeProd'], $_POST['valor']);
  }
?>
<?php
  if(isset($_GET['removeCat'])){
    ExcluirCategoria($_GET['removeCat'], $_GET['nomeCat']);
  }
  if(isset($_GET['removeProd'])){
    ExcluirProduto($_GET['removeProd'], $_GET['nomeProd']);
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administração</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
    <style>
/* CSS geral */

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body{
  overflow-x: hidden;
  color: var(--corSecundaria);
}
:root{
  --corPrimaria: rgb(255, 255, 255);
  --corSecundaria: rgb(139, 92, 192);
  --fundo: rgba(179, 153, 209, 0.741);
}
.textDefault{
  color: var(--corSecundaria);
  font-size: 22px;
  font-weight: 450;
}
#textDefault{
  color: var(--corSecundaria);
  font-size: 22px;
  font-weight: 450;
}
#tituloDefault{
  color: var(--corSecundaria);
  font-size: 35px;
  font-weight: 1000;
}
a {
  text-decoration: none;
  color: var(--corSecundaria);
}

/* CSS do header */

.header {
  background-color: white;
  color: var(--corSecundaria);

  height: 12vh;
  width: 100vw;

  display: flex;
  justify-content: space-around;
  align-items: center;
}
.header .textLogo h3 a {
  text-decoration: none;
  color: var(--corSecundaria);
}
#textLogo {
  font-family: 'Freehand', cursive;
  font-size: 27px;
  font-weight: 450;
}

/* CSS do content */

#alertas{
  color: var(--corPrimaria);
  background-color: var(--corSecundaria);

  padding: 0.7rem;
}
.content{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.principal{
  height: 88vh;
  width: 100vw;

  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: row;
  flex-wrap: wrap;
}
.esquerda{
  width: 50vw;
  height: 70vh;

  gap: 3rem;

  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  text-align: justify;

  padding: 10vw;

  border-right: 1px solid var(--corSecundaria);
}
.direita{
  width: 50vw;
  
  display: flex;
  justify-content: center;
  align-items: center;
}
.button{
  width: 27vw;
  height: 6vh;

  color: var(--corPrimaria);
  background-color: var(--corSecundaria);
  border: 1px solid var(--corSecundaria);
  
  box-shadow: 5px 5px 4px rgb(129, 63, 206);

  transition: width 0.9s;
}
.button:hover{
  color: var(--corSecundaria);
  background-color: var(--corPrimaria);

  width: 30vw;
}

/* CSS da adm */

.administracao{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.headerAdm{
  height: 12vh;

  display: flex;
  justify-content: center;
  align-items: center;

  gap: 4vw;
}
.contentAdm{
  display: flex;
  flex-direction: column;

  gap: 2rem;

  justify-content: center;
  align-items: center;
}

/* CSS categoria e produtos */
.imgDecoracao{
  position: absolute;
  margin-left: -70vw;
  margin-top: -25vh;
}
.imgDecoracao2{
  position: absolute;
  margin-left: 26vw;
  margin-top: -20vh;
}
#categoria{
  display: flex;
  flex-direction: column;

  gap: 2rem;

  transition: all 1s;

  justify-content: center;
  align-items: center;
}
#produto{
  display: none;
  flex-direction: column;

  gap: 2rem;

  justify-content: center;
  align-items: center;
}
#editar{
  display: none;
}
#optAdmProd{
  color: var(--corSecundaria);

  cursor: pointer;

  padding: 1vh;
}
#optAdmCat{
  color: var(--corSecundaria);

  border-bottom: 3px solid var(--corSecundaria);

  cursor: pointer;

  padding: 1vh;
}

/* CSS tables */

table{
  width: 45vw;
  border: 1px solid var(--corSecundaria);
  box-shadow: 5px 5px 4px rgb(129, 63, 206);
}
table #thCat{
  width: 15vw;
  padding: 0.8rem;

  color: var(--corPrimaria);
  background-color: var(--fundo);
}
table #tdCat{
  width: 15vw;
  padding: 0.8rem;

  color: var(--corSecundaria);

  border-bottom: 1px solid var(--corSecundaria);
  border-right: 1px solid var(--corSecundaria)
}
table #thProd{
  width: 11.25vw;
  padding: 0.8rem;

  color: var(--corPrimaria);
  background-color: var(--fundo);
}
table #tdProd{
  width: 11.25vw;
  padding: 0.8rem;

  color: var(--corSecundaria);

  border-bottom: 1px solid var(--corSecundaria);
  border-right: 1px solid var(--corSecundaria)
}

/* CSS form */

.form{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

  gap: 2rem;
}
.form #titleForm{
  color: var(--corSecundaria);
}
.input{
  width: 41vw;
  height: auto;

  outline: none;
  padding: 7px;

  background-color: var(--fundo);
  border: 1px solid var(--corSecundaria);

  transition: width 0.7s;
}
.input:focus{
  background-color: var(--corSecundaria);
  width: 45vw;
}
.input::placeholder{
  color: var(--corSecundaria);
}
.input:focus::placeholder{
  color: var(--corPrimaria);
}
input::file-selector-button {
  width: 10vw;

  color: var(--corSecundaria);
  background-color: var(--fundo);
  
  padding: 0.5em;
  
  border: 1px solid var(--corSecundaria);

  transition: width 1s;
  cursor: pointer;
}
input::file-selector-button:hover{
  width: 13vw;
  color: var(--corPrimaria);
  background-color: var(--corSecundaria);
}
.form .button{
  background-color: var(--corSecundaria);
  color: var(--corPrimaria);

  width: 41vw;
  transition: width 0.7s;
}
.form .button:hover{
  width: 45vw;
  background-color: var(--corPrimaria);
  color: var(--corSecundaria);
}
.form select{
  width: 41vw;
  height: 3.5vh;

  outline: none;
  padding: 3px;

  background-color: var(--fundo);
  color: var(--corSecundaria);
  border: 1px solid var(--corSecundaria);

  transition: width 0.7s;
}
.form select:focus{
  width: 45vw;
  background-color: var(--corSecundaria);
  color: var(--corPrimaria);
}

/* CSS do footer */

.footer{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

  flex-wrap: wrap;

  width: 100vw;
  gap: 2vh;
  padding: 2rem;
}

.footer #textFooter{
  color: var(--corSecundaria);
  font-weight: 450;
}
.footer .icons{
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  width: 12rem;
}
#textFooter{
  font-family: 'Freehand', cursive;
  font-size: 30px;
  font-weight: 450;
}
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Freehand&display=swap"
      rel="stylesheet"
    />
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <!-- JavaScript Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <script>
      function categoriaOpt() {
        document.getElementById('optAdmCat').style =
          'border-bottom: 3px solid var(--corSecundaria);'
        document.getElementById('optAdmProd').style = 'border-bottom: none;'
        document.getElementById('categoria').style.display = 'flex'
        document.getElementById('produto').style.display = 'none'
      }
      function produtoOpt() {
        document.getElementById('optAdmProd').style =
          'border-bottom: 3px solid var(--corSecundaria);'
        document.getElementById('optAdmCat').style = 'border-bottom: none;'
        document.getElementById('produto').style.display = 'flex'
        document.getElementById('categoria').style.display = 'none'
      }
      function mostrarEditCat(){
        document.getElementById('editar').style.display = 'flex'
      }
      function zerandoTexts(){
        document.getElementById('removeu').innerHTML = ''
      }
    </script>
  </head>
  <body>
    <div class="header">
      <div class="textLogo">
        <h3 id="textLogo"><a href="index.php">Pedro arT</a></h3>
      </div>
    </div>
    <div class="content">
      <div class="principal">
        <div class="esquerda">
          <!--<h2 id="alertas">Aqui serão exibidos alertas !!!</h2>-->
          <h2 id="tituloDefault">Bem vindo</h2>
          <h3 id="textDefault">
            ao sistema de administração Pedro arT, administre com sabedoria.
            Quaisquer dúvidas, desentendimentos ou reclamações favor entre em
            contato com nossos desenvolvedores. Role para baixo para ver mais.
          </h3>
          <a href="zapPedro"><button class="button">Contato</button></a>
        </div>
        <div class="direita">
          <img src="img/logo.PNG" alt="Logo da marca" width="300px" />
        </div>
      </div>
      <div class="administracao">
        <div class="imgDecoracao">
          <img src="img/danger.png" alt="" width="400px" />
        </div>
        <div class="headerAdm">
          <h3 id="optAdmCat" onclick="categoriaOpt()">Categorias</h3>
          <h3 id="optAdmProd" onclick="produtoOpt()">Produtos</h3>
        </div>
        <div class="contentAdm">
          <div id="categoria">
            <form action="" method="post" class="form">
              <h3 id="titleForm">Cadastrar categoria</h3>
              <input
                type="text"
                name="nomeCat"
                id="nomeCat"
                placeholder="Digite o nome da categoria:"
                class="input"
              />
              <a href="zapPedro">
                <button type="submit" name="enviarCategoria" class="button">
                  Enviar
                </button>
              </a>
            </form>
            <div id="editar">
            <form action="" method="post" class="form">
              <h3 id="titleForm">Editar categoria</h3>
              <select name="selectCat" id="selectCat">
                <?php
                    MostrarCategoriaSelect();
                ?>
              </select>
              <input
                type="text"
                name="nomeEditCat"
                id="nomeEditCat"
                placeholder="Digite o novo nome da categoria:"
                class="input"
              />
              <a href="zapPedro">
                <button type="submit" name="enviarCategoria" class="button">
                  Enviar
                </button>
              </a>
            </form>
            </div>
            <table>
              <tr>
                <th
                  id="thCat"
                  style="border-right: 1px solid var(--corPrimaria)"
                >
                  Código
                </th>
                <th
                  id="thCat"
                  style="border-right: 1px solid var(--corPrimaria)"
                >
                  Nome
                </th>
                <th id="thCat">Opções</th>
              </tr>
              <?php
                MostrarCategoria();
              ?>
            </table>
          </div>
          <div id="produto">
            <form action="" method="post" class="form">
              <h3 id="titleForm">Cadastrar produto</h3>
              <label for="descProd" id="textDefault"
                >Categoria do produto:</label
              >
              <select name="selectCat" id="selectCat">
                <?php
                    MostrarCategoriaSelect();
                ?>
              </select>
              <input
                type="text"
                name="descProd"
                id="descProd"
                placeholder="Digite a descrição do produto:"
                class="input"
              />
              <input
                type="file"
                name="fileToUpload"
                id="fileToUpload"
                class="input"
              />
              <input
                type="url"
                name="linkProd"
                id="linkProd"
                placeholder="Coloque o link do instagram do produto:"
                class="input"
              />
              <input
                type="text"
                name="nomeProd"
                id="nomeProd"
                placeholder="Digite o nome do produto:"
                class="input"
              />
              <input
                type="text"
                name="valor"
                id="valor"
                placeholder="Digite o valor, Ex.: 40.00"
                class="input"
              />
              <a href="zapPedro">
                <button onclick="produtoOpt()" type="submit" name="enviarCategoria" class="button">
                  Enviar
                </button>
              </a>
              <h3 id="removeuProd" class="textDefault"></h3>
            </form>
            <table>
              <tr>
                <th
                  id="thProd"
                  style="border-right: 1px solid var(--corPrimaria)"
                >
                  Código
                </th>
                <th
                  id="thProd"
                  style="border-right: 1px solid var(--corPrimaria)"
                >
                  Nome
                </th>
                <th
                  id="thProd"
                  style="border-right: 1px solid var(--corPrimaria)"
                >
                  Valor
                </th>
                <th id="thProd">Opções</th>
              </tr>
              <?php
                MostrarProduto();
              ?>
            </table>
          </div>
        </div>
        <div class="footerAdm">
        <div class="imgDecoracao2">
          <img src="img/danger.png" alt="" width="400px" />
        </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <h3 id="textFooter">We are bests</h3>
      <div class="icons">
        <a href=""><img src="img/whatsapp.png" alt="" width="25px" /></a>
        <a href=""
          ><img src="img/logotipo-do-instagram.png" alt="" width="25px"
        /></a>
        <a href=""><img src="img/pincel-de-arte.png" alt="" width="25px" /></a>
      </div>
    </div>
  </body>
</html>
