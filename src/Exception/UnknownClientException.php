<?php

/*
 * This file is part of the activemq package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\ActiveMq\Exception;


/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class UnknownClientException extends BaseException
{
    /**
     * Creates an instance of this exception.
     *
     * @param string $id - Client ID.
     *
     * @return UnknownClientException
     */
    public static function create(string $id)
    {
        return new self('Client "'.$id.'" is not configured!');
    }
}