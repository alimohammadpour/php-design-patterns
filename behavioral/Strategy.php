<?php

// The context class
class Navigator {
    private $navigator;

    function __construct(Strategy $navigator)
    {
        $this->navigator = $navigator;        
    }

    function findTheRoute()
    {
        return $this->navigator->{__FUNCTION__}();
    }
}

// The interface to be implemented by strategies
interface Strategy {
    function findTheRoute();
}

// Strategies
class CarNavigator implements Strategy {
    function findTheRoute()
    {
        echo "The Suitable Route for Cars\n";
    }
}

class PublicTransportNavigator implements Strategy {
    function findTheRoute()
    {
        echo "The Suitable Route for Public Transports\n";
    }
}

class PlaneNavigator implements Strategy {
    function findTheRoute()
    {
        echo "The Suitable Route for Planes\n";
    }
}

class WalkingNavigator implements Strategy {
    function findTheRoute()
    {
        echo "The Suitable Route for Walking\n";
    }
}

class Client {
    private $strategy;

    function __construct() {}
    
    function byCar() {
        $this->strategy = new CarNavigator();
        return $this;
    }

    function byPublicTransport() {
        $this->strategy = new PublicTransportNavigator();
        return $this;
    }

    function byPlane() {
        $this->strategy = new PlaneNavigator();
        return $this;
    }

    function walking() {
        $this->strategy = new WalkingNavigator();
        return $this;
    }

    function getRoute() {
        $navigator = new Navigator($this->strategy);
        return $navigator->findTheRoute();
    }
}

(new Client())->byCar()->getRoute();
(new Client())->byPublicTransport()->getRoute();
(new Client())->byPlane()->getRoute();
(new Client())->walking()->getRoute();