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
class Consume extends AbstractCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('activemq:consume')
            ->addArgument('client-id', InputArgument::REQUIRED, 'Client ID.')
            ->addArgument('destination-uri', InputArgument::REQUIRED, 'The destination URI from which messages will be consumed.');
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $clientId = $input->getArgument('client-id');
        $destination = $input->getArgument('destination-uri');

        $output->writeln('');
        $output->writeln(' <comment>Consuming Messages</comment>');
        $output->writeln('');
        $output->writeln('  <info>- Client ID: </info>'.$clientId);
        $output->writeln('  <info>- Destination: </info>'.$destination);
        $output->writeln('');

        $service = $this->getService();

        $client = $service->getClient($clientId);
        $client->subscribe($destination);

        while (true) {
            if (!$msg = $client->readMessage()) {
                $output->writeln(' <comment>- No messages arrived... Sleeping 1 second.</comment>');

                sleep(1);

                continue;
            } else {
                $output->writeln(' <comment>- Message arrived: </comment>'.print_r($msg, true));
            }
        }

        $output->writeln('');
    }

}