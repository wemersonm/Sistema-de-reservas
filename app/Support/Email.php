<?php

namespace app\Support;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    private string $from;
    private string $fromName;
    private string $to;
    private string $toName;
    private string $template = '';
    private array $templateData = [];
    private string $subject;
    private string $message = 'sd';

    private PHPMailer $mail;


    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = $_ENV['EMAIL_HOST'];
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = $_ENV['EMAIL_USERNAME'];
        $this->mail->Password   = $_ENV['EMAIL_PASSWORD'];
        $this->mail->Port       = $_ENV['EMAIL_PORT'];
    }

    public function send()
    {
        $this->mail->setFrom($this->from, $this->fromName);
        $this->mail->addAddress($this->to, $this->toName);     //Add a recipient

        $this->mail->isHTML(true);
        $this->mail->CharSet = 'UTF-8';                           
        $this->mail->Subject = $this->subject;
        $this->mail->Body     = empty($this->template) ? $this->message : $this->sendWithTemplate();
        $this->mail->AltBody = $this->message;
        return $this->mail->send();
    }

    public function sendWithTemplate()
    {
        $file = '../app/views/emails/' . $this->template . '.html';
        
        if (!file_exists($file)) {
            throw new Exception("O template {$this->template} não existe");
        }
        // [nameCar => "Mustang"] ... 
        if (!empty($this->templateData)) {
            $template = file_get_contents($file);
            foreach ($this->templateData as $key => $data) {
                $dataTemplate["@{$key}\\"] = $data;
            }
            return str_replace(array_keys($dataTemplate), array_values($dataTemplate), $template);
        }
    }

    public function setFrom($from, $fromName = ''): Email
    {
        $this->from = $from;
        $this->fromName = $fromName;

        return $this;
    }

    public function setTo($to, $toName = ''): Email
    {
        $this->to = $to;
        $this->toName = $toName;
        return $this;
    }

    public function setSubject($subject): Email
    {
        $this->subject = $subject;

        return $this;
    }

    public function setMessage($message): Email
    {
        $this->message = $message;

        return $this;
    }


    public function setTemplate($template, $templateData = []): Email
    {
        $this->template = $template;
        $this->templateData = $templateData;

        return $this;
    }
    public function setTemplateData($templateData = []): Email
    {
        $this->templateData = $templateData;
        return $this;
    }

    public function sendEmailReserve($dataEmail, $dataTemplate = '')
    {

       
    }
}
