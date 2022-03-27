<?php

interface IMailing
{
    public function sendMessage(string $msg) : string;
}

class Mailing implements IMailing
{
    public function sendMessage(string $msg) : string
    {
        return "The message '".$msg. "' was sent";
    }
}

class Decorator implements IMailing
{
    protected $component;

    public function __construct(IMailing $component)
    {

        $this -> component = $component;
    }

    public function sendMessage(string $msg) : string
    {
        return $this -> component -> sendMessage($msg);
    }
}

class SMSMailingDecorator extends Decorator
{
    public function sendMessage(string $msg) : string
    {
        return parent::sendMessage($msg) . " by SMS";
    }
}

class EmailMailingDecorator extends Decorator
{
    public function sendMessage(string $msg) : string
    {
        return parent::sendMessage($msg) . " by Email";
    }
}

class CNMailingDecorator extends Decorator
{
    public function sendMessage(string $msg) : string
    {
        return parent::sendMessage($msg) . " by Chrome Notification";
    }
}

function clientCode(IMailing $component, string $msg)
{
    echo "RESULT: " . $component -> sendMessage($msg);
}

$message = "Your order is completed!";

$mailing = new Mailing();

$sms = new SMSMailingDecorator($mailing);
clientCode($sms, $message);

echo "<br><br>";

$email = new EmailMailingDecorator($mailing);
clientCode($email, $message);

echo "<br><br>";

$cn = new CNMailingDecorator($mailing);
clientCode($cn, $message);
