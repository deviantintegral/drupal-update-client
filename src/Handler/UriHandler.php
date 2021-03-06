<?php

namespace Deviantintegral\DrupalUpdateClient\Handler;

use GuzzleHttp\Psr7\Uri;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\XmlSerializationVisitor;
use Psr\Http\Message\UriInterface;

class UriHandler implements SubscribingHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'format' => 'xml',
                'type' => 'GuzzleHttp\Psr7\Uri',
                'method' => 'serializeUriToString',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => 'GuzzleHttp\Psr7\Uri',
                'method' => 'deserializeStringToUri',
            ],
        ];
    }

    public function serializeUriToString(XmlSerializationVisitor $visitor, UriInterface $data, array $type)
    {
        return $visitor->visitString((string) $data, $type);
    }

    public function deserializeStringToUri(XmlDeserializationVisitor $visitor, $data, array $type, DeserializationContext $context): ?Uri
    {
        return new Uri($data);
    }
}
