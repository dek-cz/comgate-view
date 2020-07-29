<?php
declare(strict_types=1);

namespace DekApps\Comgate\UI;

interface IComgateComponentFactory
{
    public function create(string $name): ComgateComponent;
}
