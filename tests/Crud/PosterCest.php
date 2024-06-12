<?php

declare(strict_types=1);

namespace Tests\Crud;

use Entity\Exception\EntityNotFoundException;
use Entity\Poster;
use Tests\CrudTester;

class PosterCest
{
    public function findById(CrudTester $I)
    {
        $poster = Poster::findById(231);
        $I->assertSame(231, $poster->getId());
        $I->assertSame(file_get_contents(codecept_data_dir() . '/poster/poster231.jpeg'), $poster->getJpeg());
    }

    public function findByIdThrowsExceptionIfCoverDoesNotExist(CrudTester $I)
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            Poster::findById(PHP_INT_MAX);
        });
    }
}
