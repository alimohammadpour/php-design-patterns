<?php

// Suppose we have some 3rd-parties with other complex classes like below.
class FirstParty {}

class SecondParty {}

class ThirdParty {}

// ...others

/* We can create a facade to wrap all implementations and class method calls 
to be directly and simply accessible without concern about the 3rd-parties, 
frameworks and etc. */
class ApplicationFacade {
    public function handleParties(...$args) {
        /* Based on the parameters passed and the way to handle them, 
        we use classes to do what is desirable.*/
        echo json_encode($args);
        return;
    }
}


(new ApplicationFacade())->handleParties('param1', 'param2');