<?php

namespace DekApps\Comgate\Model;

interface IMethodItem
{

    public function getId(): string;

    public function getName(): string;

    public function getLogo(): string;

    public function getDescription(): string;
}
