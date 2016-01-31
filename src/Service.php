<?php

/*
 * This file is part of the activemq package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\ActiveMq;


/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
use IronEdge\Component\ActiveMq\Exception\UnknownClientException;
use IronEdge\Component\Config\Config;

class Service
{
    /**
     * Field _config.
     *
     * @var Config
     */
    private $_config;

    /**
     * Field _clients.
     *
     * @var array
     */
    private $_clients = [];


    /**
     * Service constructor.
     *
     * @param array $config - Configuration.
     */
    public function __construct(array $config = [])
    {
        $this->_config = new Config($config);
    }

    /**
     * Returns the config instance of this service.
     *
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->_config;
    }

    /**
     * Creates a client instance.
     *
     * @param string $id - Client ID.
     *
     * @throws UnknownClientException
     *
     * @return Client
     */
    public function getClient(string $id): Client
    {
        if (!isset($this->_clients[$id])) {
            if (!$this->_config->has('clients.'.$id)) {
                throw UnknownClientException::create($id);
            }

            $this->_clients[$id] = new Client(
                $this->_config->get('clients.'.$id.'.uri'),
                $this->_config->get('clients.'.$id.'.username'),
                $this->_config->get('clients.'.$id.'.password'),
                $this->_config->get('clients.'.$id.'.options', [])
            );
        }

        return $this->_clients[$id];
    }

    /**
     * Creates a message instance.
     *
     * @param string $body    - Body.
     * @param array  $headers - Headers.
     * @param array  $options - Options.
     *
     * @return Message
     */
    public function createMessage(string $body, array $headers = [], array $options = []): Message
    {
        return new Message($body, $headers, $options);
    }

    /**
     * Creates a message instance from a file.
     *
     * @param string $file - File.
     *
     * @return Message
     */
    public function createMessageFromFile(string $file): Message
    {
        if (!is_file($file)) {
            throw new \InvalidArgumentException('File "'.$file.'" does not exist!');
        }

        $config = new Config();

        $config->load(['file' => $file]);

        if (!$config->has('body')) {
            throw new \RuntimeException('File has no "body" element.');
        }

        return $this->createMessage($config->get('body'), $config->get('headers', []), $config->get('options', []));
    }

    /**
     * Sends a message configured on a file.
     *
     * @param string $clientId    - Client ID.
     * @param string $destination - Destination.
     * @param string $file        - File.
     *
     * @throws UnknownClientException
     *
     * @return Message
     */
    public function sendMessageFromFile(string $clientId, string $destination, string $file): Message
    {
        $client = $this->getClient($clientId);
        $message = $this->createMessageFromFile($file);

        $client->sendMessage($destination, $message);

        return $message;
    }
}