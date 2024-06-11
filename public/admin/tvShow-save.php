<?php

declare(strict_types=1);

use Entity\Exception\ParameterException;
use Html\Form\TvShowForm;

try {
    $tvShowForm = new TvShowForm();
    $tvShowForm->setEntityFromQueryString();
    $tvShowForm->getTvShow()->save();
    header('Location: /');
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
