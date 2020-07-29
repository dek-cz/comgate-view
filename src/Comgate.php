<?php

declare(strict_types=1);

namespace DekApps\Comgate;

use Nette\DI\CompilerExtension;
use Nette\Localization\ITranslator;
use DekApps\Comgate\Model\MethodItemContainer;

class Comgate implements IComgate
{
    private string $name;
    private ITranslator $translator;
    private MethodItemContainer $methods;

    private array $templates = [
        'methods' => null,
    ];

    public function __construct(string $name, ITranslator $translator, array $templates)
    {
        $this->name = $name;
        $this->translator = $translator;
        $this->templates = $templates;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMethodTemplate(): string
    {
        return $this->getTemplates()['methods'];
    }

    protected function getTranslator(): ITranslator
    {
        return $this->translator;
    }

    protected function getTemplates(): array
    {
        return $this->templates;
    }

    public function getMethods(): MethodItemContainer
    {
        return $this->methods;
    }

    public function setMethods(MethodItemContainer $methods)
    {
        $this->methods = $methods;
        return $this;
    }

}
