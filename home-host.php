<?php

$msg = '';
$msgClass = '';


if(filter_has_var(INPUT_POST, 'submit')){
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  
  if(!empty($email) && !empty($name) && !empty($message)){
    
    //check email
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
      
      $msg = 'Preencha com um email válido';
      $msgClass = 'alert-danger';
    }else {

        //Passed
        $toEmail = 'contato@glenleao.com.br';
        $subject = 'Contato realizado por:' .$name;
        
        $body = '<h2>Formulário de Contato<h2>
                <h4>Nome</h4><p>'.$name .'</p>
                <h4>Email</h4><p>'.$email .'</p>
                <h4>Mensagem</h4><p>'.$message .'</p>';

                //Email headers
                $headers = "MIME-Version: 1.0". "\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

                //Additional Headers
                $headers .="De: ".$name. "<".$email.">"."\r\n";

                if(mail($toEmail, $subject, $body, $headers)){
                //envio do email
                $msg = 'Seu email foi enviado com sucesso';
                $msgClass = 'alert-success';
                
                }else{
                  //Falha no envio
                  $msg = 'Seu email não foi enviado';
                  $msgClass = 'alert-danger';
                  }
        }
      } else {
        //Falha no envio
        $msg = 'Preencha todos os campos';
        $msgClass = 'alert-danger';
  }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
       <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140827110-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140827110-2');
</script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Glenuilde Leão | GLEN.DSGN&DEV">
    <meta name="generator" content="Sublime Text" />
    <meta name="theme-color" content="#ff2525">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@300;500;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/novoperfil.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">

    <title>glen .dsgn&dev</title>
  </head>
  <body>
    <div class="d-flex flex-column flex-md-row">
      <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mr-md-3">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="social collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li><a href="https://www.instagram.com/glenleao/" target="_blank"><i class="fab fa-instagram"></i></a></li>
              <li><a href="https://twitter.com/glnleao" target="_blank"><i class="fab fa-twitter"></i></a></li>
              <li><a href=""><i class="fab fa-telegram-plane"></i></a></li>
              <li><a href=""><i class="fab fa-whatsapp"></i></a></li>
          </ul>
        </div>
    </nav>
  </div>
  </div>

    <div class="container perfil py-5">
      <div class="row align-items-center">
        <div class="col-md-6 order-md-2">
          <img class="img-fluid" src="assets/perfil.jpg" data-toggle="tooltip" data-placement="left" title="Designer Gráfico, manipulação e criação de imagem, desenhos no papel, rabisco aleatório, vetorização # Comunicação Visual #">
        </div>

        <div class="col-md-6">
          <h1>GLEN .DSGN&DEV </h1>
          <h4>//Fazendo arte através de linhas de código!</h4>
            <div class="tooltips">
              <p># Comunicação Visual<br>Designer Gráfico, manipulação e criação de imagem, desenhos no papel, rabisco aleatório, vetorização</p>
              <p>#Skills<br>
              Html, CSS Bootstrap, Wordpress, PHP.</p>
              
            </div>

            <div class="formulario">
              <h4>Deixe seu recado</h4>
              <?php if($msg != ''): ?>
        <div class="alert <?php echo $_msgClass; ?>"><?php echo $msg; ?></div>
      <?php endif; ?>
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="row">
                  <div class="col">
                    <input type="text" name="name" placeholder="Seu  nome" value="<?php echo isset($_POST['name'])? $name:''; ?>">
                  </div>
                  <div class="col">
                    <input type="email" name="email" placeholder="Seu  email" value="<?php echo isset($_POST['email'])? $email:'' ;?>">
                  </div>
                </div>

                <textarea name="message" class="form-control" rows="3" placeholder="Sua mensagem"><?php echo isset($_POST['messsage'])? $message:'' ;?></textarea><br><br>
                <button type="submit" class="btn btn-outline-dark" type="button" name="submit"> Enviar </button>  
              </form>
            </div>
        </div>
      </div>
    </div>






    <!-- formulario -->
   <footer class="rodape">
     <div class="container">
      
      <i class="far fa-heart"></i>


     </div>
   </footer>
   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/all.js"></script>
  </body>
</html>