<?php

namespace Deviantintegral\DrupalUpdateClient;

/**
 * Represents an array of terms.
 */
class Terms
{
    /**
     * @var \Deviantintegral\DrupalUpdateClient\Term[]
     */
    protected $terms = [];

    /**
     * @return \Deviantintegral\DrupalUpdateClient\Term[]
     */
    public function getTerms(): array
    {
        return $this->terms;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\Term[] $terms
     */
    public function setTerm(array $terms): void
    {
        $this->terms = $terms;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\Term $term
     */
    public function addTerm(Term $term): void
    {
        $this->terms[] = $term;
    }
}
