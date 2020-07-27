<?php

declare(strict_types=1);

namespace DekApps\Comgate\UI;

use DekApps\Comgate\ComgateContainer;
use Nette\Application\UI\Control;
use Nette\Application\UI\Presenter;

class ComgateComponent extends Control
{

    private ComgateContainer $container;
    private string $name;

    public function render(): void
    {
        $comgate = $this->container->getItem($this->name);
        $this->template->setFile($comgate->getMethodTemplate());
        $this->template->comgate = $comgate;
        $this->template->render();
    }

}
