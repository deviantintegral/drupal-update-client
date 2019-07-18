<?php

namespace Deviantintegral\DrupalUpdateClient\Tests\Functional;

use Deviantintegral\DrupalUpdateClient\Client;
use Deviantintegral\DrupalUpdateClient\ProjectRepository;
use Deviantintegral\DrupalUpdateClient\Serializer;
use PHPUnit\Framework\TestCase;

class LoadProjectTest extends TestCase {

    /**
     * @var \Deviantintegral\DrupalUpdateClient\ProjectRepository
     */
    private $repository;

    public function setUp(): void {
        parent::setUp();
        $this->repository = new ProjectRepository(new Client(new \GuzzleHttp\Client(Client::getDefaultConfiguration())), Serializer::create());
    }

    public function testDrupalCore() {
        $project = $this->repository->load('drupal', '8.x');
        $this->assertEquals('drupal', $project->getShortName());
    }
    
    public function testContrib() {
        $project = $this->repository->load('ctools', '8.x');
        $this->assertEquals('ctools', $project->getShortName());
    }
}
