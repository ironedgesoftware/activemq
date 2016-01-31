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
class Message
{
    /**
     * Field _stompMessage.
     *
     * @var \Stomp\Transport\Frame
     */
    private $_stompMessage;

    /**
     * Options.
     *
     * @var array
     */
    private $_options;


    /**
     * Message constructor.
     *
     * @param string                 $body         - Body.
     * @param array                  $headers      - Headers.
     * @param array                  $options      - Options.
     * @param \Stomp\Transport\Frame $stompMessage - Stomp Message.
     */
    public function __construct(string $body, array $headers = [], array $options = [], \Stomp\Transport\Frame $stompMessage = null)
    {
        if ($stompMessage) {
            $this->_stompMessage = $stompMessage;
        } else {
            $this->_stompMessage = new \Stomp\Transport\Message($body, $headers);
        }
    }

    /**
     * Getter method for field _stompMessage.
     *
     * @return \Stomp\Transport\Frame
     */
    public function getStompMessage(): \Stomp\Transport\Frame
    {
        return $this->_stompMessage;
    }

    /**
     * Getter method for field _options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->_options;
    }


}