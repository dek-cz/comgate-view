<?php

declare(strict_types=1);

namespace DekApps\Comgate;

use DekApps\Comgate\Model\MethodItemContainer;

interface IComgate
{
    public function getName(): string;
    public function isMethodsSet(): bool;
    public function getMethodTemplate(): string;
    public function getMethods(): MethodItemContainer;
    public function setMethods(MethodItemContainer $methods);
    public function getDesign(): string;
    public function setDesign(string $design);
    public function getShowTitle(): bool;
    public function getShowDescription(): bool;
    public function setShowTitle(bool $showTitle);
    public function setShowDescription(bool $showDescription);
}


