<?php
// Src/Helpers/StringUtil.php

declare(strict_types=1);

namespace Ntimbablog\Portfolio\Helpers;


class StringUtil
{
    public function displayFirst150Characters( string $string ) : string
    {
        $trimmedString = mb_substr( $string, 0, 150 );

        return $trimmedString;
    }

    public function removeStringsSpaces(string $string) : string
    {
        $stringWithoutSpaces = str_replace(' ', '-', $string);
        return strtolower($stringWithoutSpaces);
    }

    public function capitalLetter(string $string) : string
    {
        $capitalLetter = strtoupper(substr($string, 0, 1)) . strtolower(substr($string, 1));
        return $capitalLetter;
    }
}
