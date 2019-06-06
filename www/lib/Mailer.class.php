<?php

class Mailer
{
    private $mail;

    public function __construct($whom, $destination, $topic, $letter)
    {

        $this->mail = new PHPMailer();

        $this->mail -> CharSet = "UTF-8";

        $this->mail->Port = 587;

        try {

            $this->mail->setFrom(Config::get('admin_email'), 'TAXI 838');

        } catch (Exception $e) {}

        $this->mail->addAddress($whom,$destination);

        $this->mail->addReplyTo(Config::get('admin_email'), 'TAXI 838');

        $this->mail->isHTML(true);

        $this->mail->Subject = $topic;

        $this->mail->Body = $letter;
    }

    public function send()
    {
        try {

            $this->mail->send();

        } catch (Exception $e) {}
    }
}