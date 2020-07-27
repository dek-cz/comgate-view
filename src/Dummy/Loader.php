<?php

declare(strict_types=1);

namespace DekApps\Comgate\Dummy;

use DekApps\Comgate\ILoader;
use DekApps\Comgate\Model\MethodItemContainer;

/**
 * Fake for defaults
 */
final class Loader implements ILoader
{

    public function load(): MethodItemContainer
    {
        return new MethodItemContainer();
    }

}
