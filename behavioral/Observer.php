<?php

interface Subscriber 
{
    function update();
}

class EmailSubscriber implements Subscriber
{
    function update()
    {
        echo "Email Subscriber\n";
    }
}

class TicketSubscriber implements Subscriber
{
    function update()
    {
        echo "Ticket Subscriber\n";
    }
}

class Publisher
{
    private $subscribers;

    function __construct() {}

    function addSubscriber(Subscriber $subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    function popSubscriber()
    {
        array_pop($this->subscribers);
    }

    private function notifySubscribers()
    {
        foreach($this->subscribers as $subscriber)
            $subscriber->update();
    }

    function doSomething()
    {
        echo "Something is Done!\n";
        $this->notifySubscribers();
    }
}

$publisher = new Publisher();
$publisher->addSubscriber(new EmailSubscriber());
$publisher->addSubscriber(new TicketSubscriber());
$publisher->doSomething();

$publisher->popSubscriber();
$publisher->doSomething();