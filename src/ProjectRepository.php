<?php

namespace Deviantintegral\DrupalUpdateClient;

use Deviantintegral\DrupalUpdateClient\Element\Project;
use GuzzleHttp\ClientInterface;

class ProjectRepository
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * @var \Deviantintegral\DrupalUpdateClient\Serializer
     */
    private $serializer;

    public function __construct(ClientInterface $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function load(string $project, string $branch): Project
    {
        $data = $this->client->request('GET', "$project/$branch")->getBody();

        return $this->serializer->deserializeProject($data);
    }
}
