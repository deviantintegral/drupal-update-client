<?php

namespace Deviantintegral\DrupalUpdateClient\Tests\Unit;

use Deviantintegral\DrupalUpdateClient\Project;
use Deviantintegral\DrupalUpdateClient\Release;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase {

    /**
     * @param $expected
     * @param \Deviantintegral\DrupalUpdateClient\Project $project
     * @dataProvider releaseSetDataProvider
     */
    public function testGetRecommendedRelease($expected, Project $project) {
        $this->assertEquals($expected, $project->getRecommendedRelease()->getVersion());
    }
    
    public function releaseSetDataProvider() {
        return [
            'A single release' => [
                '1.2',
                (new Project())->setReleases([
                    (new Release())->setVersion('1.2')
                        ->setVersionMajor(1)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('1.x-dev')
                    ->setVersionMajor(1),
                ]),
            ],
            'A list of non-suffixed versions' => [
                '1.2',
                (new Project())->setReleases([
                    (new Release())->setVersion('1.2')
                    ->setVersionMajor(1)
                    ->setVersionPatch(2),
                    (new Release())->setVersion('1.1')
                        ->setVersionMajor(1)
                        ->setVersionPatch(1),
                    (new Release())->setVersion('1.x-dev')
                        ->setVersionMajor(1),
                ]),
            ],
            'A beta release with a prior stable release' => [
                '1.1',
                (new Project())->setReleases([
                    (new Release())
                        ->setVersion('1.2-beta1')
                        ->setVersionMajor(1)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('1.1')
                        ->setVersionMajor(1)
                        ->setVersionPatch(1),
                    (new Release())->setVersion('1.x-dev')
                        ->setVersionMajor(1),
                ])
            ],
            'Two beta releases' => [
                '1.0-beta2',
                (new Project())->setReleases([
                    (new Release())->setVersion('1.0-beta2')
                        ->setVersionMajor(1)
                        ->setVersionPatch(0),
                    (new Release())->setVersion('1.0-beta1')
                        ->setVersionMajor(1)
                        ->setVersionPatch(0),
                    (new Release())->setVersion('1.x-dev')
                        ->setVersionMajor(1),
                ])
            ],
            'Prior beta releases' => [
                '1.0',
                (new Project())->setReleases([
                    (new Release())->setVersion('1.0')
                        ->setVersionMajor(1)
                        ->setVersionPatch(0),
                    (new Release())->setVersion('1.0-beta2')
                        ->setVersionMajor(1)
                        ->setVersionPatch(0),
                    (new Release())->setVersion('1.0-beta1')
                        ->setVersionMajor(1)
                        ->setVersionPatch(0),
                    (new Release())->setVersion('1.x-dev')
                        ->setVersionMajor(1),
                ])
            ],
            'A patch release' => [
                '1.2-bugfix',
                (new Project())->setReleases([
                    (new Release())->setVersion('1.2-bugfix')
                        ->setVersionMajor(1)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('1.2')
                        ->setVersionMajor(1)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('1.1')
                        ->setVersionMajor(1)
                        ->setVersionPatch(1),
                    (new Release())->setVersion('1.x-dev')
                        ->setVersionMajor(1),
                ])
            ],
            'A second post-stable-tag suffix' => [
                '1.2-bugfix2',
                (new Project())->setReleases([
                    (new Release())->setVersion('1.2-bugfix2')
                        ->setVersionMajor(1)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('1.2-bugfix')
                        ->setVersionMajor(1)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('1.2')
                        ->setVersionMajor(1)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('1.1')
                        ->setVersionMajor(1)
                        ->setVersionPatch(1),
                    (new Release())->setVersion('1.x-dev')
                        ->setVersionMajor(1),
                ]),
            ],
            'Two development branches' => [
                '2.x-dev',
                (new Project())->setReleases([
                    (new Release())->setVersion('2.x-dev')
                        ->setVersionMajor(2),
                    (new Release())->setVersion('1.x-dev')
                        ->setVersionMajor(1)
                ]),
            ],
            'Full semantic version' => [
               '8.7.3',
                (new Project())->setReleases([
                    (new Release())->setVersion('8.7.3')
                    ->setVersionMajor(8)
                    ->setVersionMinor(7)
                    ->setVersionPatch(3),
                (new Release())->setVersion('8.7.2')
                    ->setVersionMajor(8)
                    ->setVersionMinor(7)
                    ->setVersionPatch(2),
                (new Release())->setVersion('8.7.1')
                    ->setVersionMajor(8)
                    ->setVersionMinor(7)
                    ->setVersionPatch(1),
                (new Release())->setVersion('8.7.0')
                    ->setVersionMajor(8)
                    ->setVersionMinor(7)
                    ->setVersionPatch(0),
                (new Release())->setVersion('8.7.x')
                    ->setVersionMajor(8)
                    ->setVersionMinor(7),
                ]),
            ],
            'Semantic beta release' => [
                '8.7.3',
                (new Project())->setReleases([
                    (new Release())->setVersion('8.7.4-beta1')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(4),
                    (new Release())->setVersion('8.7.3')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(3),
                    (new Release())->setVersion('8.7.2')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('8.7.1')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(1),
                    (new Release())->setVersion('8.7.0')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(0),
                    (new Release())->setVersion('8.7.x')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7),
                ]),
            ],
            'Semantic patch release' => [
                '8.7.4-patch1',
                (new Project())->setReleases([
                    (new Release())->setVersion('8.7.4-patch1')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(4),
                    (new Release())->setVersion('8.7.4')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(4),
                    (new Release())->setVersion('8.7.3')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(3),
                    (new Release())->setVersion('8.7.2')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('8.7.1')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(2),
                    (new Release())->setVersion('8.7.0')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7)
                        ->setVersionPatch(0),
                    (new Release())->setVersion('8.7.x')
                        ->setVersionMajor(8)
                        ->setVersionMinor(7),
                ]),
            ],
        ];
    }
}
