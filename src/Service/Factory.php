<?php

/*
 * This file is part of the activemq package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\ActiveMq\Service;


/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
use IronEdge\Component\ActiveMq\Service;
use IronEdge\Component\Config\Config;

class Factory
{
    /**
     * Configuration instance.
     *
     * @var Config
     */
    private $_config;


    /**
     * Factory constructor.
     *
     * @param Config $config - Configuration instance.
     */
    public function __construct(Config $config)
    {
        $this->_config = $config;
    }

    /**
     * Instantiates a service.
     *
     * @return Service
     */
    public function createService()
    {
        return new Service($this->_config->get('components.ironedge/activemq'));
    }
}