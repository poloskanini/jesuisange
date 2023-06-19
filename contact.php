<?php

require 'vendor/autoload.php';

use Mailjet\Client;
use \Mailjet\Resources;

// Clés publique et privée de MAILJET
define('MJ_APIKEY_PUBLIC', '9643dbf3120f04b54c7c81bb32565df8');
define('MJ_APIKEY_PRIVATE', 'c38f88aa336083980bfcfd690372ba28');

// Instancier un nouveau mail
$mj = new Client(MJ_APIKEY_PUBLIC, MJ_APIKEY_PRIVATE, true,['version' => 'v3.1']);

if(!empty($_POST['Name']) && !empty($_POST['Email']) && !empty($_POST['Telephone']) && !empty($_POST['Message'])) {

      $name = htmlspecialchars(strip_tags($_POST['Name']));
      $email = htmlspecialchars(strip_tags($_POST['Email']));
      $telephone = htmlspecialchars(strip_tags($_POST['Telephone']));
      $message = htmlspecialchars(strip_tags($_POST['Message']));

      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $body = [
          'Messages' => [
              [
                  'From' => [
                      'Email' => "nicolasbarthes.lana@gmail.com",
                      'Name' => "Je suis Ange / NOUVEAU CONTACT"
                  ],
                  'To' => [
                      [
                          'Email' => $email,
                          'Name' => "You"
                      ]
                  ],
                  'Subject' => "Jesuisange.fr / Nouveau Contact",
                  'TextPart' => "Greetings from Mailjet!",
                  'HTMLPart' => "Vous avez un nouveau contact sur votre site www.jesuisange.fr : <br>
                  //       Nom/Prénom : $name <br><br>
                  //       Email : $email <br><br>
                  //       Numéro de téléphone : $telephone <br><br><br>
                  //       Voici le message qui vous est adressé : <br>
                  //       $message"
                  // 'TemplateID' => 4716740,
                  // 'TemplateLanguage' => true,
                //   'Variables' => [
                //     'name' => $name,
                //     'email' => $email,
                //     'telephone' => $telephone,
                //     'message' => $message,
                //     'content' => 
                //       "Vous avez un nouveau contact sur votre site www.jesuisange.fr : <br>
                //       Nom/Prénom : $name <br><br>
                //       Email : $email <br><br>
                //       Numéro de téléphone : $telephone <br><br><br>
                //       Voici le message qui vous est adressé : <br>
                //       $message"
                // ]
              ]
          ]
      ];

      $res = ["success" => $success, "msg" => $msg];
      echo json_encode($res);

      // Envoi de l'email
      $response = $mj->post(Resources::$Email, ['body' => $body]);
      $response->success();
      header('Location:index.html');

      } else {
        header('Location:index.html');
        die();
      }
  }

?>