<?php

interface Notifier {
    function send($message);
}

class AppNorifier implements Notifier {
    function send($message) {
        echo $message."\n";
    }
}

class NotifierDecorator implements Notifier {
    private $wrappee;

    function __construct(Notifier $wrappee)
    {
        $this->wrappee = $wrappee;
    }

    function send($message) {
        return $this->wrappee->send($message);
    }
}

class EmailNotifierDecorator extends NotifierDecorator {
    function send($message)
    {
        parent::send($message);
        echo 'EMAIL decorator applied';
    }
}

class SMSNotifierDecorator extends NotifierDecorator {
    function send($message)
    {
        parent::send($message);
        echo 'SMS decorator applied';
    }
}

class DiscordNotifierDecorator extends NotifierDecorator {
    function send($message)
    {
        parent::send($message);
        echo 'DISCORD decorator applied';
    }
}

function sendAppNotification($type) {
    $notifier = new AppNorifier();
    switch($type) {
        case 'SMS':
            $notifier = new SMSNotifierDecorator($notifier);
            break;
        case 'DISCORD':
            $notifier = new DiscordNotifierDecorator($notifier);
            break;
        default:
            $notifier = new EmailNotifierDecorator($notifier);
    }
    return $notifier->send('NOTIFICATION');
}

sendAppNotification('SMS');