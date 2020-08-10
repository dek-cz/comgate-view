<?php

declare(strict_types=1);

namespace DekApps\Comgate\DI;

use DekApps\Comgate\Dummy\Translator as FakeTranslator;
use DekApps\Comgate\Loader\HttpLoader;
use DekApps\Comgate\UI\ComgateComponent;
use DekApps\Comgate\UI\IComgateComponentFactory;
use DekApps\Comgate\ComgateContainer;
use DekApps\Comgate\Comgate;
use GuzzleHttp\Client;
use Nette\DI\Statement;
use Nette\DI\CompilerExtension;
use Nette\Localization\ITranslator;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Nette\Utils\Strings;

class ComgateExtension extends CompilerExtension
{

    private array $defaults = [
        'translator' => '',
        'loader' => '',
        'gateway' => '',
        'merchant' => '',
        'secret' => '',
        'lang' => '',
        'design' => '',
        'templates' => [],
    ];

    public function getConfigSchema(): Schema
    {
//        return Expect::structure([
//                    'default' => Expect::array(),
//        ]);
        return Expect::arrayOf(Expect::structure([
                            'translator' => Expect::string()->required()->default(FakeTranslator::class),
                            'loader' => Expect::string()->default(HttpLoader::class),
                            'gateway' => Expect::string()->required()->default('https://payments.comgate.cz/v1.0/methods'),
                            'merchant' => Expect::string()->required(),
                            'secret' => Expect::string()->required(),
                            'lang' => Expect::string()->required()->default('cz'),
                            'design' => Expect::string()->default('vertical'),
                            'templates' => Expect::array()->default(['methods' => __DIR__ . '/../UI/templates/methods.latte']),
                ]))->before(function ($val)
                {
                    return is_array(reset($val)) || reset($val) === null ? $val : ['default' => $val];
                });
    }

    public function loadConfiguration(): void
    {
        $config = $this->config;
        $builder = $this->getContainerBuilder();

        $container = $builder->addDefinition($this->prefix('container'))
                ->setType(ComgateContainer::class);
        $builder->addFactoryDefinition($this->prefix('comgateview.methods'))
                ->setImplement(IComgateComponentFactory::class)
                ->getResultDefinition()
                ->setFactory(ComgateComponent::class);


        foreach ($config as $name => $comgate) {
            $ccomgate = $this->validateConfig($this->defaults, (array) $comgate);

            $translator = $ccomgate['translator'];
            $translator = $builder->getDefinitionByType(ITranslator::class);
            if (!Strings::startsWith($ccomgate['translator'], '@')) {
                $translator = $builder->addDefinition($this->prefix($name . '.translator'))
                        ->setType($ccomgate['translator'])
                        ->setAutowired(false);
            }
            $loader = $ccomgate['loader'];
            if (!Strings::startsWith($ccomgate['loader'], '@')) {
                $loader = $builder->addDefinition($this->prefix($name . '.loader'))
                        ->setFactory($ccomgate['loader'], [new Statement(Client::class, [[
                    'base_uri' => $ccomgate['gateway'],
                ]])]);
            }
            $loader->addSetup('setMerchant', [$ccomgate['merchant']])
                    ->addSetup('setSecret', [$ccomgate['secret']])
                    ->addSetup('setUri', [$ccomgate['gateway']])
                    ->addSetup('setLang', [$ccomgate['lang']]);


            $container->addSetup('addLoader', [$name, $loader]);
            $container->addSetup('addItem', [
                        $builder->addDefinition($this->prefix($name))
                        ->setType(Comgate::class)
                        ->setArguments([$name, $translator, $ccomgate['templates'], $ccomgate['design']])
            ]);
        }
//        var_dump($container);exit;
    }

}
