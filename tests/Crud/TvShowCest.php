<?php

declare(strict_types=1);

namespace Tests\Crud;

use Entity\Exception\EntityNotFoundException;
use Entity\TvShow;
use Tests\CrudTester;

class TvShowCest
{
    public function findById(CrudTester $I)
    {
        $artist = TvShow::findById(57);
        $I->assertSame(57, $artist->getId());
        $I->assertSame('Good Omens', $artist->getName());
        $I->assertSame('Good Omens', $artist->getOriginalName());
        $I->assertSame('https://www.amazon.com/dp/B07FMHTRFF', $artist->getHomepage());
        $I->assertSame('Suit les aventures de Crowley et Aziraphale, un démon et un ange, qui décident de saborder l’Apocalypse car ils se sont trop habitués à la vie sur Terre.', $artist->getOverview());
        $I->assertSame(466, $artist->getPosterId());
    }

    public function findByIdThrowsExceptionIfArtistDoesNotExist(CrudTester $I)
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            TvShow::findById(PHP_INT_MAX);
        });
    }

    public function delete(CrudTester $I)
    {
        $artist = TvShow::findById(57);
        $artist->delete();
        $I->cantSeeInDatabase('tvshow', ['id' => 57]);
        $I->cantSeeInDatabase('tvshow', ['name' => 'Good Omens']);
        $I->cantSeeInDatabase('tvshow', ['originalName' => 'Good Omens']);
        $I->cantSeeInDatabase('tvshow', ['homepage' => 'https://www.amazon.com/dp/B07FMHTRFF']);
        $I->cantSeeInDatabase('tvshow', ['overview' => 'Suit les aventures de Crowley et Aziraphale, un démon et un ange, qui décident de saborder l’Apocalypse car ils se sont trop habitués à la vie sur Terre.']);
        $I->cantSeeInDatabase('tvshow', ['posterId' => 466]);
        $I->assertNull($artist->getId());
        $I->assertSame('Good Omens', $artist->getName());
        $I->assertSame('Good Omens', $artist->getOriginalName());
        $I->assertSame('https://www.amazon.com/dp/B07FMHTRFF', $artist->getHomepage());
        $I->assertSame('Suit les aventures de Crowley et Aziraphale, un démon et un ange, qui décident de saborder l’Apocalypse car ils se sont trop habitués à la vie sur Terre.', $artist->getOverview());
        $I->assertSame(466, $artist->getPosterId());
    }
}
