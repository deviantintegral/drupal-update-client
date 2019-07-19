<?php

namespace Deviantintegral\DrupalUpdateClient\Command;

use Deviantintegral\DrupalUpdateClient\Client;
use Deviantintegral\DrupalUpdateClient\Downloader;
use Deviantintegral\DrupalUpdateClient\ProjectRepository;
use Deviantintegral\DrupalUpdateClient\Serializer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DucCommand extends Command
{
    protected function configure()
    {
        parent::configure();
        $this->setName('project:extract')
            ->setDescription('Download and extract a project from drupal.org')
            ->setHelp('')
            ->addUsage('project:extract drupal')
            ->addUsage('project:extract drupal 8.7.3')
            ->addUsage('project:extract ctools 7.x-1.x')
            ->addArgument('project')
            ->addArgument('version');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $branch = '8.x';
        $project = $input->getArgument('project');
        $version = $input->getArgument('version');
        if ($version) {
            $first = $version[0];
            $branch = "$first.x";
        }

        $update_client = new Client(new \GuzzleHttp\Client(Client::getDefaultConfiguration()));
        $downloader = new Downloader(new \GuzzleHttp\Client());
        $repository = new ProjectRepository($update_client, Serializer::create());

        $project = $repository->load($project, $branch);

        if (!$version) {
            $output->write(sprintf('Downloading the recommended release from the %s branch.', $branch), true);
            $archive = $downloader->fetchRecommendedRelease($project);
            $output->write(sprintf('Selected release %s.', $archive->getFile()->getRelease()->getName()), true);
        } else {
            $output->write(sprintf('Downloading release %s.', $version), true);
            $archive = $downloader->fetchRelease($project->getReleaseForVersion($version));
        }

        $directory = getcwd();
        $output->write('Extracting to '.$directory, true);
        $archive->extract($directory);
    }
}
