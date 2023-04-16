<?php

interface Input {
    function getType();
}

class InputContainer implements Input {
    private $inputs;

    function __construct() 
    {
        $this->inputs = [];
    }

    function addInput(Input $input) 
    {
        $this->inputs[] = $input;
    }

    function getType() 
    {
        foreach($this->inputs as $input)
            $input->getType();
    }
}

class BaseInput implements Input {
    function getType()
    {
        echo 'Base Type of Input';
    }
}

class Text extends BaseInput {
    function getType()
    {
        echo 'This is a Text Input';
    }
}

class Number extends BaseInput {
    function getType()
    {
        echo 'This is a Number Input';
    }
}

class Select extends BaseInput {
    function getType()
    {
        echo 'This is a Select Input';
    }
}

$container = new InputContainer();
$container->addInput(new Text());
$container->addInput(new Number());
$container->addInput(new Select());
$container->getType();