<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\TvShow;

try {
    if (!isset($_GET["tvShowId"]) || !is_numeric($_GET["tvShowId"])) {
        throw new ParameterException();
    }
    $tvShow = TvShow::findById((int) $_GET["tvShowId"]);
    $tvShow->delete();
    header('Location: /');

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
