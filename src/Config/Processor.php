<?php

/*
 * This file is part of the activemq package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\ActiveMq\Config;


/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
use IronEdge\Component\Config\ConfigInterface;
use IronEdge\Component\Kernel\Config\ProcessorInterface;
use IronEdge\Component\Kernel\Exception\InvalidConfigException;
use IronEdge\Component\Kernel\Kernel;
use IronEdge\Component\Logger\Factory;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class Processor implements ProcessorInterface
{
    public function onComponentConfigRegistration(
        Kernel $kernel,
        ConfigInterface $config,
        $sourceComponentName,
        $targetComponentName,
        array $registeredConfig
    ) {

    }

    public function onBeforeCache(Kernel $kernel, ConfigInterface $config)
    {

    }

    public function onAfterCache(Kernel $kernel, ConfigInterface $config)
    {

    }

    public function onBeforeContainerCompile(
        Kernel $kernel,
        ConfigInterface $config,
        ContainerBuilder $containerBuilder
    ) {

    }

}