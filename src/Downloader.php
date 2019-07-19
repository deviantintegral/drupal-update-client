<?php

namespace Deviantintegral\DrupalUpdateClient;

use Deviantintegral\DrupalUpdateClient\Element\File;
use Deviantintegral\DrupalUpdateClient\Element\Project;
use Deviantintegral\DrupalUpdateClient\Element\Release;
use GuzzleHttp\ClientInterface;

class Downloader
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetch(File $file): Archive
    {
        $destination = tempnam(sys_get_temp_dir(), 'duc-');
        $this->client->request('GET', $file->getUrl(), ['sink' => $destination]);

        // Validate the download against the release md5.
        if (md5_file($destination) != $file->getMd5()) {
            throw new \RuntimeException(sprintf('MD5 check of %s failed', $file->getUrl()));
        }

        return new Archive($file, $destination);
    }

    public function fetchRelease(Release $release): Archive
    {
        foreach ($release->getFiles() as $file) {
            if ('tar.gz' == $file->getArchiveType()) {
                return $this->fetch($file);
            }
        }

        throw new \RuntimeException(sprintf('%s does not contain a tar.gz release.', $release->getName()));
    }

    public function fetchRecommendedRelease(Project $project): Archive
    {
        return $this->fetchRelease($project->getRecommendedRelease());
    }
}
