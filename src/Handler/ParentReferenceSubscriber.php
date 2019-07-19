<?php

namespace Deviantintegral\DrupalUpdateClient\Handler;

use Deviantintegral\DrupalUpdateClient\Element\Project;
use Deviantintegral\DrupalUpdateClient\Element\Release;
use JMS\Serializer\EventDispatcher\ObjectEvent;

class ParentReferenceSubscriber implements \JMS\Serializer\EventDispatcher\EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.post_deserialize',
                'method' => 'onPostDeserializeProject',
                'class' => 'Deviantintegral\\DrupalUpdateClient\\Element\\Project', // if no class, subscribe to every serialization
                'format' => 'xml', // optional format
                'priority' => 0, // optional priority
            ],
            [
                'event' => 'serializer.post_deserialize',
                'method' => 'onPostDeserializeRelease',
                'class' => 'Deviantintegral\\DrupalUpdateClient\\Element\\Release', // if no class, subscribe to every serialization
                'format' => 'xml', // optional format
                'priority' => 0, // optional priority
            ],
        ];
    }

    public function onPostDeserializeProject(ObjectEvent $event)
    {
        /** @var Project $project */
        $project = $event->getObject();
        foreach ($project->getReleases() as $release) {
            $release->setProject($project);
        }
    }

    public function onPostDeserializeRelease(ObjectEvent $event)
    {
        /** @var Release $release */
        $release = $event->getObject();
        foreach ($release->getFiles() as $file) {
            $file->setRelease($release);
        }
    }
}
