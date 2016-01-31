<?php
/*
 * This file is part of the activemq package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\ActiveMq\Console\Command;

use IronEdge\Component\ActiveMq\Service;
use IronEdge\Component\Cli\Console\Command\AbstractCommand as BaseAbstractCommand;
use IronEdge\Component\Kernel\Kernel;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
abstract class AbstractCommand extends BaseAbstractCommand
{
    /**
     * Returns the ActiveMq Service instance.
     *
     * @return Service
     */
    public function getService()
    {
        return $this->getKernel()->getContainerService('ironedge_activemq.service');
    }

    /**
     * Returns the Kernel
     *
     * @return Kernel
     */
    public function getKernel()
    {
        return $this->getApplication()->getKernel();
    }
}