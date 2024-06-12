<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /**
     * Méthode permettant de protéger une chaine de caractère passé en paramètre en formatant les caractères spéciaux.
     *
     * @param string|null $string Chaine de caractère à protéger
     * @return string|null La chaine de caractère protégée
     */
    public static function escapeString(?string $string = ""): ?string
    {
        if (($string)) {
            return htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
        } else {
            return "";
        }

    }

    /**
     * Méthode permettant de retirer toutes les balises et les espaces au début et à la fin de la chaine caractère.
     * @param string|null $text
     * @return string
     */
    public function stripTagsAndTrim(?string $text): string
    {
        if (!empty($text)) {
            $texteSansBalise = strip_tags($text);
            return trim($texteSansBalise);
        }
        return "";

    }
}
