<?php

class RoundHole {
    private $radius;

    function __construct($radius)
    {
        $this->radius = $radius;
    }

    function getRadius() 
    {
        return $this->radius;
    }

    function fit(RoundPeg $peg) {
        return $this->radius >= $peg->getRadius();
    }
}

class RoundPeg {
    private $radius;

    function __construct($radius)
    {
        $this->radius = $radius;
    }

    function getRadius()
    {
        return $this->radius;
    }
}

class SquarePeg {
    private $width;

    function __construct($width)
    {
        $this->width = $width;
    }

    function getWidth()
    {
        return $this->width;
    }
}

// To put a square peg in a round hole(uses a round peg). We need an adaptor.
class SquarePegAdaptor extends RoundPeg {
    private $squarePeg;

    function __construct(SquarePeg $squarePeg)
    {
        $this->squarePeg = $squarePeg;    
    }

    function getRadius()
    {
        return $this->squarePeg->getWidth() * sqrt(2) / 2;
    }
}

$roundPeg = new RoundPeg(10);
$squarePeg = new SquarePeg(2);
$squarePegAdaptor = new SquarePegAdaptor($squarePeg);
$hole = new RoundHole(20);

echo $hole->fit($roundPeg);
echo $hole->fit($squarePegAdaptor);