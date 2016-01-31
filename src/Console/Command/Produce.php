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

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class Produce extends AbstractCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('activemq:produce')
            ->addArgument('client-id', InputArgument::REQUIRED, 'Client ID.')
            ->addArgument('destination-uri', InputArgument::REQUIRED, 'The destination URI to which the message will be sent.')
            ->addArgument('file', InputArgument::REQUIRED, 'This is a YML file with the message data.');
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $clientId = $input->getArgument('client-id');
        $file = $input->getArgument('file');
        $destination = $input->getArgument('destination-uri');

        $output->writeln('');
        $output->writeln(' <comment>Sending Message</comment>');
        $output->writeln('');
        $output->writeln('  <info>- Client ID: </info>'.$clientId);
        $output->writeln('  <info>- Destination: </info>'.$destination);
        $output->writeln('  <info>- Message from File: </info>'.$file);
        $output->writeln('');

        $service = $this->getService();

        $msg = $service->sendMessageFromFile($clientId, $destination, $file);

        $output->writeln('');

        $output->writeln(' <comment> - Message sent: </comment>');
        $output->writeln('');
        $output->writeln(print_r($msg, true));
        $output->writeln('');
    }

}