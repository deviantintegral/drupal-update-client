<?php

namespace Deviantintegral\DrupalUpdateClient\Tests\Unit;

use Deviantintegral\DrupalUpdateClient\Project;
use Deviantintegral\DrupalUpdateClient\Serializer;
use PHPUnit\Framework\TestCase;

class SerializerTest extends TestCase {

    public function testSerializer() {
        $s = Serializer::create();
        $data = file_get_contents(__DIR__ . '/../../fixtures/drupal-8.x-2019-06-28.xml');
        /** @var Project $o */
        $o = $s->deserializeProject($data);
        $this->assertInstanceOf(Project::class, $o);
        $this->assertEquals('Drupal core', $o->getTitle());
    }
}
