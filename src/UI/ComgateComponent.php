<?php

declare(strict_types=1);

namespace DekApps\Comgate\UI;

use DekApps\Comgate\ComgateContainer;
use Nette\Application\UI\Control;
use Nette\Application\UI\Presenter;
use DekApps\Comgate\ILoader;
use DekApps\Comgate\IComgate;

class ComgateComponent extends Control implements IComgateComponent
{

    private ComgateContainer $container;
    private string $name;

    public function __construct(ComgateContainer $container, string $name)
    {
        $this->container = $container;
        $this->name = $name;
    }

    public function getComgate(): IComgate
    {
        $comgate = $this->container->getItem($this->name);
        $loader = $this->container->getLoader($this->name);
        if (! $comgate->isMethodsSet()) {
            $comgate->setMethods($loader->fetch());
        }
        return $comgate;
    }

    public function render(): void
    {

        $comgate = $this->getComgate();

        $this->template->setFile($comgate->getMethodTemplate());
        $this->template->comgate = $comgate;
        $this->template->render();
    }

}
