<?php

declare(strict_types=1);

namespace DekApps\Comgate;

final class ComgateContainer
{

    private $loaders = [];
    private $items = [];

    public function getItem(string $name): IComgate
    {
        return $this->items[$name];
    }

    public function addItem(IComgate $item): void
    {
        $this->items[$item->getName()] = $item;
    }

    public function getLoader(string $name): ILoader
    {
        return $this->loaders[$name];
    }

    public function addLoader(string $name, ILoader $item): void
    {
        $this->loaders[$name] = $item;
    }

}
