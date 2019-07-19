<?php

namespace Deviantintegral\DrupalUpdateClient;

use Deviantintegral\DrupalUpdateClient\Element\Error;
use Deviantintegral\DrupalUpdateClient\Element\Project;
use Deviantintegral\DrupalUpdateClient\Exception\InvalidXmlException;
use Deviantintegral\DrupalUpdateClient\Handler\ParentReferenceSubscriber;
use Deviantintegral\DrupalUpdateClient\Handler\UriHandler;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Handler\DateHandler;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;

/**
 * Serializer for drupal.org project data.
 */
class Serializer
{
    /**
     * @var \JMS\Serializer\SerializerInterface
     */
    private $serializer;

    /**
     * Serializer constructor.
     *
     * @param \JMS\Serializer\SerializerBuilder $builder
     */
    public function __construct(SerializerBuilder $builder)
    {
        $this->serializer = $builder->build();
    }

    /**
     * Deserialize a project xml document into a Project.
     *
     * @param string $data
     *
     * @return \Deviantintegral\DrupalUpdateClient\Element\Project
     */
    public function deserializeProject(string $data): Project
    {
        $this->checkRootNode($data, 'project');

        return $this->serializer->deserialize($data, Project::class, 'xml');
    }

    /**
     * Serialize a Project into an xml document.
     *
     * @param \Deviantintegral\DrupalUpdateClient\Element\Project $project
     *
     * @return string
     */
    public function serializeProject(Project $project): string
    {
        return $this->serializer->serialize($project, 'xml');
    }

    public function deserializeError(string $data): Error
    {
        $this->checkRootNode($data, 'error');

        return $this->serializer->deserialize($data, Error::class, 'xml');
    }

    /**
     * Create a new serializer using the default configuration.
     *
     * @return \Deviantintegral\DrupalUpdateClient\Serializer
     */
    public static function create(): self
    {
        return new static(static::getBuilder());
    }

    /**
     * Return the builder used to create the serializer.
     *
     * @return \JMS\Serializer\SerializerBuilder
     */
    public static function getBuilder(): SerializerBuilder
    {
        AnnotationRegistry::registerLoader('class_exists');

        return SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistry $registry) {
                $registry->registerSubscribingHandler(new UriHandler());
                $registry->registerSubscribingHandler(new DateHandler('U', 'UTC', false));
            })
            ->configureListeners(function (\JMS\Serializer\EventDispatcher\EventDispatcher $dispatcher) {
                $dispatcher->addSubscriber(new ParentReferenceSubscriber());
            });
    }

    /**
     * @param string $data
     * @param string $rootNode
     */
    private function checkRootNode(string $data, string $rootNode): void
    {
        $doc = simplexml_load_string($data);
        if ($doc->getName() != $rootNode) {
            throw new InvalidXmlException(sprintf('The root node %s is not %s', $doc->getName(), $rootNode));
        }
    }
}
