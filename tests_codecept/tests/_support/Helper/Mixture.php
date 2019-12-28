<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Mixture extends \Codeception\Module
{

    /**
     * @return \Codeception\Module
     */
    public function getPublicModule($name)
    {
        return $this->getModule($name);
    }

    /**
     * @return \Codeception\Module
     */
    public function getPublicModules()
    {
        return $this->getModules();
    }

}
