<?php

declare(strict_types=1);

namespace DekApps\Comgate;

interface IComgate
{
    public function getName(): string;
    public function getMethodTemplate(): string;
}


