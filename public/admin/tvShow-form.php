<?php
declare(strict_types=1);

use Entity\TvShow;
use Html\Form\TvShowForm;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {

    if (!isset($_GET['tvShowId'])) {
        $tvShow = null;
    } else {
        if (!(is_numeric($_GET['tvShowId']))) {
            throw new ParameterException();
        }
        $tvShowId = (int)$_GET['tvShowId'];
        $tvShow = TvShow::findById($tvShowId);
    }

    if (!isset($_GET['posterId'])) {
        $posterId = null;
    } else {
        if (!(ctype_digit($_GET['posterId']))) {
            throw new ParameterException();
        }
        $posterId = (int)$_GET['posterId'];
    }

    $tvShow?->setPosterId($posterId);
    $tvShowForm = new TvShowForm($tvShow);
    echo $tvShowForm->getHtmlForm('tvShow-save.php');
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
