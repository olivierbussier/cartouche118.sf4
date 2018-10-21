<?php

namespace App\Entity;

class BlogTypeChoice {

    public const CAROUSEL  = 'carousel';
    public const MARKETING = 'marketing';
    public const PORTFOLIO = 'portfolio';
    public const FEATURE   = 'feature';
    public const FAQ       = 'FAQ';

    public const CHOICES   = [
        'Carrousel' => self::CAROUSEL,
        //'Marketing' => self::MARKETING,
        'Portfolio' => self::PORTFOLIO,
        'Feature'   => self::FEATURE,
        'FAQ'       => self::FAQ
    ];

    private $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }
}