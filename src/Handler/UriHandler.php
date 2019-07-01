<?php

namespace Deviantintegral\DrupalUpdateClient\Handler;

use GuzzleHttp\Psr7\Uri;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\XmlDeserializationVisitor;

class UriHandler implements SubscribingHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => 'GuzzleHttp\Psr7\Uri',
                'method' => 'deserializeStringToUri',
            ],
        ];
    }

    public function deserializeStringToUri(XmlDeserializationVisitor $visitor, $data, array $type): ?Uri
    {
        return new Uri($data);
    }
}
