<?php

declare(strict_types=1);

namespace DekApps\Comgate\DI;

use DekApps\Comgate\Dummy\Translator as FakeTranslator;
use DekApps\Comgate\Dummy\Loader as FakeLoader;
use DekApps\Comgate\UI\ComgateComponent;
use DekApps\Comgate\UI\IComgateComponentFactory;
use DekApps\Comgate\ComgateContainer;
use Nette\DI\ContainerBuilder;
use Nette\DI\Definitions\ServiceDefinition;
use Nette\Localization\ITranslator;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

class ComgateExtension extends CompilerExtension
{

    private array $defaults = [
        'translator' => FakeTranslator::class,
        'loader' => FakeLoader::class,
        'templates' => [
            'methods' => __DIR__ . '/../UI/templates/methods.latte',
        ],
    ];

    public function getConfigSchema(): Schema
    {
        return  Expect::structure([
                    'translator' => Expect::string(),
                    'templates' => Expect::array(),
        ]);
    }

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        $config = $this->validateConfig($this->defaults, $config);

        $container = $builder->addDefinition($this->prefix('container'))
                ->setType(ComgateContainer::class);
        $builder->addDefinition($this->prefix('comgate.methods'))
                ->setClass(ComgateComponent::class)
                ->setImplement(IComgateComponentFactory::class);

        foreach ($config as $name => $comgate) {
            $container->addSetup('addItem', null);
        }
    }

}
