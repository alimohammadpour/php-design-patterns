<?php

abstract class EngineFactory {
    abstract public function createEngine();

    public function checkEngineStart() {
        $engine = $this->createEngine();
        return $engine->start();
    }
}

class DieselEngineFactory extends EngineFactory {
    public function createEngine()
    {
        return new DieselEngine();
    }
}


class HybridEngineFactory extends EngineFactory {
    public function createEngine()
    {
        return new HybridEngine();
    }
}

interface EngineInterface {
    public function start();
}

class DieselEngine implements EngineInterface {
    public function start() {
        return 'DIESEL ENGINE STARTED';
    }
}

class HybridEngine implements EngineInterface {
    public function start() {
        return 'HYBRID ENGINE STARTED';
    }
}

function engineHandler(EngineFactory $engineFactory) 
{
    echo $engineFactory->checkEngineStart();
}

engineHandler(new DieselEngineFactory());
engineHandler(new HybridEngineFactory());


// We have a factory that initializes and starts the passed engine regardless of it's type;