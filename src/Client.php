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
use Stomp\StatefulStomp;
use Stomp\Transport\Message as StompMessage;

class Client
{
    /**
     * Uri.
     *
     * @var string
     */
    private $_uri;

    /**
     * Username.
     *
     * @var string
     */
    private $_username;

    /**
     * Password.
     *
     * @var string
     */
    private $_password;

    /**
     * Options.
     *
     * @var array
     */
    private $_options;

    /**
     * Stomp client.
     *
     * @var StatefulStomp
     */
    private $_stompClient;


    /**
     * Client constructor.
     *
     * @param string $uri - Client URI.
     * @param string|null $username - Username.
     * @param string|null $password - Password.
     * @param array $options - Options.
     */
    public function __construct(string $uri, string $username = null, string $password = null, array $options = [])
    {
        $this->_uri = $uri;
        $this->_username = $username;
        $this->_password = $password;
        $this->_options = $options;

        $client = new \Stomp\Client($uri);

        $client->setLogin($username, $password);

        $this->_stompClient = new StatefulStomp($client);
    }

    /**
     * Getter method for field _uri.
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->_uri;
    }

    /**
     * Getter method for field _username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * Getter method for field _password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Returns the options of this client.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->_options;
    }

    /**
     * Returns the stomp client instance.
     *
     * @return StatefulStomp
     */
    public function getStompClient(): StatefulStomp
    {
        return $this->_stompClient;
    }

    /**
     * Sends a message.
     *
     * @param string $destination - Destination.
     * @param Message $message - Message instance.
     *
     * @return bool
     */
    public function sendMessage(string $destination, Message $message)
    {
        return $this->getStompClient()->send($destination, $message->getStompMessage());
    }

    /**
     * Subscribes to a destination.
     *
     * @param string $destination - Destination.
     * @param string|null $selector - Selector.
     * @param string $ack - ACK Mode.
     * @param array $headers - Headers.
     *
     * @return int
     */
    public function subscribe(string $destination, string $selector = null, string $ack = 'auto', array $headers = [])
    {
        return $this->getStompClient()->subscribe($destination, $selector, $ack, $headers);
    }

    /**
     * Reads a message from the broker.
     *
     * @return false|Message
     */
    public function readMessage()
    {
        $ret = $this->getStompClient()->read();

        if (!$ret) {
            return $ret;
        }

        return new Message('', [], [], $ret);
    }
}