<?php
    include('funcoes.php');
?>
<?php
  if(isset($_POST['descProd'])){
    EditarProduto($_POST['descProd'], $_POST['linkImagem'], $_POST['linkProd'], $_POST['nomeProdEdit'], $_POST['valor'], $_GET['codigo']);
  }
  if(isset($_POST['editCatProd'])){
    EditarCategoriaProduto($_POST['selectCat'], $_GET['codigo']);
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
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

/* CARD */

.content{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
    padding: 2rem;
}
.card{
    display: flex;
    width: 55vw;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem;
    gap: 2rem;
    border: 1px solid var(--corSecundaria);
    box-shadow: 5px 5px 4px rgb(129, 63, 206);
}
p{
  color: var(--corSecundaria);
  font-size: 22px;
  font-weight: 450;
  text-align: justify;
  word-wrap: wrap;
}
.text{
    display: flex;
    flex-direction: column;
    justify-content: center;
    
    align-items: flex-start;
    
    text-align: justify;
    word-wrap: wrap;
}

/* FORM */
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
  width: 45vw;
  height: auto;

  outline: none;
  padding: 7px;

  background-color: var(--fundo);
  border: 1px solid var(--corSecundaria);

  transition: width 0.7s;
}
.input:focus{
  background-color: var(--corSecundaria);
  width: 50vw;
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

  width: 45vw;
  transition: width 0.7s;
  padding: 1rem;
  border: 1px solid var(--corSecundaria);
}
.form .button:hover{
  width: 50vw;
  background-color: var(--corPrimaria);
  color: var(--corSecundaria);
}
.form select{
  width: 45vw;
  height: 3.5vh;

  outline: none;
  padding: 3px;

  background-color: var(--fundo);
  color: var(--corSecundaria);
  border: 1px solid var(--corSecundaria);

  transition: width 0.7s;
}
.form select:focus{
  width: 50vw;
  background-color: var(--corSecundaria);
  color: var(--corPrimaria);
} 
</style>
</head>
<body>
<div class="header">
      <div class="textLogo">
        <h3 id="textLogo"><a href="index.php">Pedro arT</a></h3>
      </div>
    </div>
    <div class="content">
        <?php
            MostrarProdutoEspecifico($_GET['codigo']);
        ?>
        <?php
          echo '
          <a href="index.php?editProd=1">
            <button type="submit" class="button">
              Enviar
            </button>
          </a>
          </form>
          ';
        ?>
        <form action="" method="post" class="form">
        <h3 id="titleForm">Editar categoria do produto(opcional):</h3>
        <select name="selectCat" id="selectCat">
                <?php
                    MostrarCategoriaSelect();
                ?>
              </select>
              <a href="">
                <button onclick="" type="submit" name="editCatProd" class="button">
                  Enviar
                </button>
              </a>
        </form>
    </div>
</body>
</html>