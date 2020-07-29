<?php

namespace DekApps\Comgate\Model;

class MethodItem implements IMethodItem
{

    private string $id;
    private string $name;
    private string $logo;
    private string $description;

    public function __construct(string $id, string $name, string $logo, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->logo = $logo;
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setLogo(string $logo)
    {
        $this->logo = $logo;
        return $this;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

}
