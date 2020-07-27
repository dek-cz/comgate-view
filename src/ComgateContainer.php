<?php

declare(strict_types=1);

namespace DekApps\Comgate;

final class ComgateContainer
{

    private $items = [];

    public function getItem(string $name): IComgate
    {
        return $this->items[$name];
    }

    public function addItem(IComgate $item): void
    {
        $this->items[$item->getName()] = $item;
    }

}
