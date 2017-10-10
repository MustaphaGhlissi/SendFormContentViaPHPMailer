<?php

    require 'PHPMailer.php';
    require 'Exception.php';
    require 'SMTP.php';
    require 'POP3.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
   
    
    if(isset($_POST['envoyer']))
    {
        extract($_POST);
        $to ='ghlissi.mustapha@gmail.com';
        $subject = "Nouveau Chauffeur";
        $message = "Date : $date"."\r\n".
        "Chauffeur : $chauffeur"."\r\n".
        "Véhicule : $vehicule"."\r\n".
        "Remorque : $remorque"."\r\n".
        "Kilométrage Départ : $kmdepart"."\r\n".
        "Kilométrage Arrivé : $kmarrive"."\r\n".
        "Kilométrage Effectué : $kmeffectue"."\r\n".
        "Litre GO : $litrego";

        if(empty($date) || empty($chauffeur) || empty($vehicule) || empty($remorque) 
                || empty($kmdepart) || empty($kmarrive) || empty($litrego))
        {
            $msg = "Veuillez renseigner tous les champs";
        }
        else
        {
            $mail = new PHPMailer(true);                             
            try 
            {
                //Server settings
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'ghlissi.mustapha@gmail.com';                 // SMTP username (Votre email de messagerie)
                $mail->Password = 'GHMprod50834902';                           // SMTP password (Votre mot de passe)
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('ghlissi.mustapha@gmail.com', 'MyWebAppli'); // L'expéditeur
                $mail->addAddress('contact@perifall.com');     // ajouter un recepteur
                $mail->addCC('ghlissi.mustapha14@gmail.com'); // Ajouter un autre recepteur

                //Content
                $mail->isHTML(false);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                $msg = 'Mail a été envoyé avec succès';
            } 
            catch (Exception $e) 
            {
                echo 'L\'envoi du mail a echoué.';
            }
        }
    
    }

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/datepicker.min.css">
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/i18n/datepicker.fr-FR.js"></script>

</head>
<body>

    <div class="form">
        <?php 
            if(isset($msg))
            {
                echo "<p style='color:red;'>".$msg."</p>";
            }
         ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <label>Date</label>
                <input type="text" id="datepicker" name="date" placeholder="Entrer la date" value="<?php if(isset($_POST['date'])) echo $_POST['date'];  ?>">
            </div>
            <div class="form-group">
                <label>Chauffeur</label>
                <select name="chauffeur">
                    <option value="">-- Choisir --</option>
                    <option value="chauf 1" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 1") echo "selected";  ?>>chauf 1</option>
                    <option value="chauf 2" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 2") echo "selected";  ?>>chauf 2</option>
                    <option value="chauf 3" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 3") echo "selected";  ?>>chauf 3</option>
                    <option value="chauf 4" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 4") echo "selected";  ?>>chauf 4</option>
                    <option value="chauf 5" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 5") echo "selected";  ?>>chauf 5</option>
                    <option value="chauf 6" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 6") echo "selected";  ?>>chauf 6</option>
                    <option value="chauf 7" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 7") echo "selected";  ?>>chauf 7</option>
                    <option value="chauf 8" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 8") echo "selected";  ?>>chauf 8</option>
                    <option value="chauf 9" <?php if(isset($_POST['chauffeur']) && $_POST['chauffeur']==="chauf 9") echo "selected";  ?>>chauf 9</option>
                </select>
            </div>
            <div class="form-group">
                <label>Véhicule</label>
                <input type="text" name="vehicule" placeholder="Nom de véhicule" value="<?php if(isset($_POST['vehicule'])) echo $_POST['vehicule'];  ?>">
            </div>
            <div class="form-group">
                <label>Remorque</label>
                <input type="text" name="remorque" placeholder="Remorquage" value="<?php if(isset($_POST['remorque'])) echo $_POST['remorque'];  ?>">
            </div>
            <div class="form-group">
                <label>Kilométrage Départ</label>
                <input type="number" name="kmdepart" id="kmdepart" placeholder="Kilométrage de départ" value="<?php if(isset($_POST['kmdepart'])) echo $_POST['kmdepart'];  ?>">
            </div>
            <div class="form-group">
                <label>Kilométrage Arrivé</label>
                <input type="number" name="kmarrive" id="kmarrive" placeholder="Kilométrage d'arrivé" value="<?php if(isset($_POST['kmarrive'])) echo $_POST['kmarrive'];  ?>">
            </div>
            <div class="form-group">
                <label>Kilométrage Effectué</label>
                <input type="number" name="kmeffectue" id="kmeffectue" placeholder="Kilométrage Effectué" readonly="" value="<?php if(isset($_POST['kmeffectue'])) echo $_POST['kmeffectue'];  ?>">
            </div>
            <div class="form-group">
                <label>Litre de Go</label>
                <input type="number" name="litrego" placeholder="Litre de Go" value="<?php if(isset($_POST['litrego'])) echo $_POST['litrego'];  ?>">
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn-envoyer" name="envoyer">
                    Envoyer
                </button>
            </div>
        </form>
    </div>






    <script>
        $( function() {
          $( "#datepicker" ).datepicker({
            format: 'dd-mm-YYYY',
            autoHide: true,
            language: 'fr-FR'
          });

          $('#kmarrive').on('keyup',function(){

            $('#kmeffectue').val($(this).val() - $('#kmdepart').val());

          });

          $('#kmdepart').on('keyup',function(){

            if($.trim($('#kmarrive').val()) !== "")
            {
                $('#kmeffectue').val($('#kmarrive').val() - $(this).val());
            }

          });

        } );
    </script>
</body>
</html>