<?php

class EmailSendingErrorException extends RuntimeException
{
    public $message = 'Impossible d\'envoyer l\'email.';
}

class NotificationSendingErrorException extends RuntimeException
{
    public $message = 'Impossible d\'envoyer la notification.';
}

class ShortTextException extends RuntimeException
{
    public $message = 'Le texte fournu est trop court.';
}

/**
* @var string $text le contenu du message
* @return bool true en cas de succès
* @throw Exception on error
*/
function sendEmail(string $text): bool
{   
   /*on simule que l’envoie du message réussie*/
   if (false)
   {
       // l’exception jetée avec son message et son code d’erreur
       throw new EmailSendingErrorException();
   }   
  
   return true;
}
/**
* @var string $text le contenu du message
* @return bool true en cas de succès
* @throw Exception on error
*/
function sendNotification(string $text): bool
{
   /*on simule que l’envoie de notification échoue*/
   if (true)
   {
       throw new NotificationSendingErrorException();
   } 
  
   return true;
}


/**
* @var string $text le contenu du message
* @return bool true en cas de succès
* @throw Exception on error
*/
function sendMessage(string $text): bool
{
   if (10 > strlen($text)) {
       throw new ShortTextException();
   }


   try {
       sendNotification($text);
    } catch (NotificationSendingErrorException $e) {
        // Envoyez vous une alerte
        // pour vous prévenir que les notifications ne marche pas ;)
    } finally {
        // finally permet d'exécuter du code quoi qu'il arrive :)
        sendEmail($text);
        // Si une exception est jetée par sendEmail,
        // Le return n'est jamais exécuté.
        return true;
   }
}

/**
if (!sendMessage('Hello, ici Greg "pappy" Boyington')) {
   // Avec les Exceptions, en cas d’erreur, ce code n’est plus jamais appelé contrairement à avant, avec l’envoie de booléen.
}
*/

try {
    sendMessage('Hello, ici Greg "pappy" Boyington');
} catch (ShortTextException $e) {
    print($e->getMessage() . PHP_EOL);
} catch (EmailSendingErrorException $e) {
    print('Une erreur est survenue lors de l\'envoi du message, nos équipes ont été prévenues, veuillez réessayer plus tard' . PHP_EOL);
} catch (Exception $e) {
    print("Une erreur inattendue est survenue, nos équipes ont été prévenues, veuillez réessayer plus tard");
}
