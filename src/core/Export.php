<?php
declare(strict_types=1);

namespace core;

class Export {

    public function runAction(){
        if(method_exists($this, 'runBeforeAction')){

            $this->runBeforeAction();

        }

    }
}
