<?php

namespace App\Entity;

class BlogTypeChoice
{

    public const CAROUSEL  = 'carousel';
    public const SERVICES  = 'services';
    public const CLIENTS   = 'clients';
    public const PRODUITS  = 'produits';
    public const FAQ       = 'FAQ';

    public const CHOICES   = [
        'Carrousel' => self::CAROUSEL,
        'Services'  => self::SERVICES,
        'Clients'   => self::CLIENTS,
        'Produits'  => self::PRODUITS,
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
