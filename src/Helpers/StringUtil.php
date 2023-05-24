<?php
// Src/Helpers/StringUtil.php

declare(strict_types=1);

namespace App\Helpers;

class StringUtil
{
    public function displayFirst150Characters( string $text ) : string
    {
        $trimmedText = mb_substr( $text, 0, 150 );

        return $trimmedText;
    }

}