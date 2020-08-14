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
    private ?MethodItemContainer $methods = null;
    private string $design = 'vertical';
    private bool $showTitle = false;
    private bool $showDescription = false;
    private array $templates = [
        'methods' => null,
    ];

    public function __construct(string $name, ITranslator $translator, array $templates, string $design, bool $showTitle, bool $showDescription)
    {
        $this->name = $name;
        $this->translator = $translator;
        $this->templates = $templates;
        $this->design = $design;
        $this->showTitle = $showTitle;
        $this->showDescription = $showDescription;
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

    public function isMethodsSet(): bool
    {
        return $this->methods ? true : false;
    }

    public function getDesign(): string
    {
        return $this->design;
    }

    public function setDesign(string $design)
    {
        $this->design = $design;
        return $this;
    }

    public function getShowTitle(): bool
    {
        return $this->showTitle;
    }

    public function getShowDescription(): bool
    {
        return $this->showDescription;
    }

    public function setShowTitle(bool $showTitle)
    {
        $this->showTitle = $showTitle;
        return $this;
    }

    public function setShowDescription(bool $showDescription)
    {
        $this->showDescription = $showDescription;
        return $this;
    }

}
