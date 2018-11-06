<?php

namespace App\Classes\Config;

// Ce fichier contient l'ensemble des variables de configuration qui ne dépendent pas
// de l'environnement d'execution
// ----------------------------------------------------------------------------------

class Config
{
    /******************************************************************/
    // Paramétrages de base
    /******************************************************************/
    public const  PATH_BLOG    = 'imblog';
    /******************************************************************/
    // Fichiers de Log
    /******************************************************************/
    private const PATH_LOGS     = __DIR__ . "/../../logs/";
    public const LOG_AP         = 1;
    public const LOG_DB         = 2;
    public const LOG_ML         = 3;

    static public $filelog = [
        self::LOG_AP => self::PATH_LOGS . 'log_ap.log',
        self::LOG_DB => self::PATH_LOGS . 'log_db.log',
        self::LOG_ML => self::PATH_LOGS . 'log_ml.log'
    ];

    public const NB_ITEM_PAR_PAGE = 250;
}