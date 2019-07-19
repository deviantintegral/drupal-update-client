<?php

namespace Deviantintegral\DrupalUpdateClient;

use Deviantintegral\DrupalUpdateClient\Element\File;

class Archive
{
    /**
     * @var File
     */
    private $file;

    /**
     * @var string
     */
    private $archive;

    public function __construct(File $file, string $archive)
    {
        $this->file = $file;
        $this->archive = $archive;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getArchive()
    {
        return $this->archive;
    }

    public function extract(string $destination): bool
    {
        return (new \Archive_Tar($this->archive))->extract($destination);
    }
}
