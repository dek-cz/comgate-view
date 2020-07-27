<?php

namespace DekApps\Comgate;

use Nette\DI\CompilerExtension;
use Nette\Localization\ITranslator;

class Comgate implements IComgate
{

    private ITranslator $translator;

    /**
     * @var string[]
     */
    private array $templates = [
        'methods' => null,
    ];
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }
    
    

}
