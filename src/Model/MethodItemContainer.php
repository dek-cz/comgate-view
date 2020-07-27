<?php

declare(strict_types=1);

namespace DekApps\Comgate\Model;

final class MethodItemContainer
{

    private $items = [];

    public function getItem(string $id): IMethodItem
    {
        return $this->items[$id];
    }

    public function addItem(IMethodItem $item): void
    {
        $this->items[$item->getId()] = $item;
    }

}
