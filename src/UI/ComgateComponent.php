<?php

declare(strict_types=1);

namespace DekApps\Comgate\UI;

use DekApps\Comgate\ComgateContainer;
use Nette\Application\UI\Control;
use Nette\Application\UI\Presenter;
use DekApps\Comgate\ILoader;

class ComgateComponent extends Control
{

    private ComgateContainer $container;
    private string $name;

    public function __construct(ComgateContainer $container, string $name)
    {
        $this->container = $container;
        $this->name = $name;
    }


    public function render(): void
    {

        $comgate = $this->container->getItem($this->name);
        $loader = $this->container->getLoader($this->name);
        $comgate->setMethods($loader->fetch());
        
//        var_dump($comgate);
//        exit;
        $this->template->setFile($comgate->getMethodTemplate());
        $this->template->comgate = $comgate;
        $this->template->render();
    }

}
