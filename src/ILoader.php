<?php

namespace DekApps\Comgate;

use DekApps\Comgate\Model\MethodItemContainer;

interface ILoader
{

    public function load(): MethodItemContainer;
}
