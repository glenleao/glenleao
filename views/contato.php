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
      
      $msg = '<div class="alert alert-danger" role="alert">Preencha com um email válido</div>';
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
                $msg = '<div class="alert alert-success" role="alert">Seu email foi enviado com sucesso</div>';
                $msgClass = 'alert-success';
                
                }else{
                  //Falha no envio
                  $msg = '<div class="alert alert-danger" role="alert">Seu email não foi enviado</div>';
                  $msgClass = 'alert-danger';
                  }
        }
      } else {
        //Falha no envio
        $msg = '<div class="alert alert-danger" role="alert">Preencha todos os campos</div>';
        $msgClass = 'alert-danger';
  }
}

?>

    <div class="container py-5">
      <div class="row">

        <div class="col-md-6">
        <img class="img-fluid" src="assets/fusca2.jpg"> 
        </div>


        <div class="col-md-4 pt-5">
          <!-- formulario -->
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
          <!-- formulario -->
        </div>
      </div>
    </div>

      </div>
    </div>
  </div>
 

    
 