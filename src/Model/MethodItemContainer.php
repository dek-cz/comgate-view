<?php

declare(strict_types=1);

namespace DekApps\Comgate\Model;

final class MethodItemContainer
{

    private array $items = [];

    public function getItem(string $id): IMethodItem
    {
        return $this->items[$id];
    }

    public function addItem(IMethodItem $item): void
    {
        $this->items[$item->getId()] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems(IMethodItem ...$items)
    {
        $this->items = $items;
        return $this;
    }

}
