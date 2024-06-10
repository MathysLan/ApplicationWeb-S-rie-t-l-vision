<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\Poster;

try {
    if (!isset($_GET["posterId"]) || !is_numeric($_GET["posterId"])) {
        throw new ParameterException();
    }
    $artist = Poster::findById(intval($_GET["posterId"]));
    header("Content-Type: image/jpeg");
    echo $artist->getJpeg();
} catch (ParameterException) {
    http_response_code(400);
    header("Location: /");
} catch (EntityNotFoundException) {
    http_response_code(404);
    header("Content-Type: image/png");
} catch (Exception) {
    http_response_code(500);
}
