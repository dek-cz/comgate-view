<?php

declare(strict_types=1);

namespace DekApps\Comgate\Common\Presenters;

use DekApps\Comgate\UI\IComgateComponentFactory;

trait TComgateView
{

    /** @var IComgateComponentFactory @inject */
    public IComgateComponentFactory $comgateViewFactory;

    protected function createComponentComgateView()
    {
        return $this->comgateViewFactory->create('default');
    }

}
