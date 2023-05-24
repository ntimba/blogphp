<?php
// Src/Lib/EmailService.php

namespace App\Lib;


class EmailService {

    public function sendEmail($to, $subject, $message, $headers) {
        if(mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }

    public function prepareConfirmationEmail($username, $email, $confirmationLink) {
        $subject = "Confirmation d'inscription au blog de ntimba.com.";
        $message = $this->getConfirmationEmailBody($username, $confirmationLink);
        $headers = 'From: webmaster@' . $_SERVER['HTTP_HOST'] . "\r\n" .
                   'Reply-To: webmaster@' . $_SERVER['HTTP_HOST'] . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        return $this->sendEmail($email, $subject, $message, $headers);
    }

    private function getConfirmationEmailBody($username, $confirmationLink) {
        // Start output buffering
        ob_start();

        // Include the email template
        require('Views/emails/registrationConfirmation.php');

        // Get the contents of the buffer
        $message = ob_get_contents();

        // End output buffering and clean the buffer
        ob_end_clean();

        return $message;
    }
}
