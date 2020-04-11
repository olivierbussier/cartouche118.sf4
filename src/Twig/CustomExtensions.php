<?php

namespace App\Twig;

use App\Entity\User;
use Symfony\Bridge\Twig\AppVariable;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CustomExtensions extends AbstractExtension
{
    static private $idCount = 1;

    public function getFunctions()
    {
        return array(
            new TwigFunction('readfile', array($this, 'readFile')),
            new TwigFunction('fileExists', array($this, 'fileExists')),
            new TwigFunction('rationalizeFilename', array($this, 'rationalizeFilename')),
            new TwigFunction('testDroit', array($this, 'testDroit')),
            new TwigFunction('genID', array($this, 'genID')),
        );
    }

    public function genID($text)
    {
        return $text . self::$idCount++;
    }

    public function readFile(string $filename)
    {
        return file_get_contents('./' . $filename);
    }

    public function fileExists(string $filename)
    {
        return file_exists($filename);
    }

    public function rationalizeFilename($file)
    {
        // Convert spaces, caracteres accentués  to '_'

        $retfile = str_replace(' ', '_', $file);
        //$retfile = str_replace('-','_',$retfile);

        return $retfile;
    }

    /**
     * @param AppVariable $app
     * @param $droit
     * @return bool
     */
    public function testDroit(AppVariable $app, $droit)
    {
        /** @var User $cx */
        $cx = $app->getUser();
        if ($cx) {
            $roles = $cx->getRoles();
            foreach ($roles as $v) {
                if ($v == 'ROLE_ADMIN') {
                    return true;
                }
                if ($v == $droit) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }
    }
}
