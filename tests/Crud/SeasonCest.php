<?php

declare(strict_types=1);

namespace Tests\Crud;

use Entity\Season;
use Entity\Exception\EntityNotFoundException;
use Tests\CrudTester;

class SeasonCest
{
    public function findById(CrudTester $I)
    {
        $season = Season::findById(13);
        $I->assertSame(13, $season->getId());
        $I->assertSame('Épisodes spéciaux', $season->getName());
        $I->assertSame(3, $season->getTvShowId());
        $I->assertSame(2147483647, $season->getSeasonNumber());
        $I->assertSame(16, $season->getPosterId());
    }

    public function findByIdThrowsExceptionIfSeasonDoesNotExist(CrudTester $I)
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            Season::findById(PHP_INT_MAX);
        });
    }
}
