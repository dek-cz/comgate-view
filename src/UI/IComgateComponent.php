<?php

declare(strict_types = 1);

namespace DekApps\Comgate\UI;

use DekApps\Comgate\IComgate;

interface IComgateComponent
{

    public function render(): void;

    public function getComgate(): IComgate;

}
