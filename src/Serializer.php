<?php

namespace Deviantintegral\DrupalUpdateClient;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Serializer extends \Symfony\Component\Serializer\Serializer
{
    public function __construct(array $normalizers = [], array $encoders = [])
    {
        if (empty($normalizers)) {
            $normalizers = [
                new ObjectNormalizer(null, null, null, new ReflectionExtractor()),
                new ArrayDenormalizer(),
            ];
        }

        if (empty($encoders)) {
            $encoders = [new JsonEncoder(), new XmlEncoder('project')];
        }

        parent::__construct($normalizers, $encoders);
    }

    public function deserializeProject($data): Project
    {
        return $this->deserialize($data, Project::class, 'xml');
    }

    public function serializeProject(Project $project): string
    {
        return $this->serialize($project, 'xml');
    }
}
