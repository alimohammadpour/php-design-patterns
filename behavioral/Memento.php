<?php

interface Originator {
    function takeSnapshot();
}

interface Memento {
    function restore();
}

class AppOriginator implements Originator 
{
    private $state;
    public function __construct($state)
    {
        $this->setState($state);                
    }

    public function setState($state) 
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function takeSnapshot()
    {
        return new AppMemento($this, $this->state);
    }
}

class AppMemento implements Memento 
{
    private $app, $state;
    public function __construct(Originator $app, $state)
    {
        $this->app   = $app;
        $this->state = $state;
    }

    private function getState() 
    {
        return $this->state;
    }

    public function restore()
    {
        $this->app->setState($this->state);
    }
}

class AppCaretaker 
{
    private $mementos;
    function __construct() {
        $this->mementos = [];
    }

    function addChangedState(Memento $memento)
    {
        $this->mementos[] = $memento;
    }

    function getMementos()
    {
        return $this->mementos;
    }

    function undo()
    {
        array_pop($this->mementos);
        $toBeRestoredMemento = end($this->mementos);
        $toBeRestoredMemento->restore(); 
    }
}

function mergeStateArrays($target, $newState) 
{
    return array_merge($target, $newState);
}

function main()
{
    $state = [
        'host'        => '127.0.0.1',
        'port'        => 4500,
        'activeUsers' => 450,
        'database'    => 'MySQL'
    ];

    $app = new AppCaretaker();

    $originator = new AppOriginator($state);

    $app->addChangedState($originator->takeSnapshot());

    $originator->setState(mergeStateArrays($state, ['activeUsers' => 1200, 'database' => 'MongoDB']));

    $app->addChangedState($originator->takeSnapshot());

    $originator->setState(mergeStateArrays($originator->getState(), ['activeUsers' => 1000000, 'port' => 3000]));

    $app->addChangedState($originator->takeSnapshot());

    // restore the last snapshot
    $app->undo();

    return $originator->getState()['activeUsers'] === 1200;
}

echo main();