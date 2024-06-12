<?php

declare(strict_types=1);

namespace Tests\Crud\Collection;

use Entity\Collection\SeasonCollection;
use Entity\Season;
use Tests\CrudTester;

class SeasonCollectionCest
{
    public function findByTvShowId(CrudTester $I)
    {
        $expectedSeasons = [
            ['id' => 335, 'tvShowId' => 40, 'name' => 'Saison 1', 'seasonNumber' => 1, 'posterId' =>  371],
            ['id' => 336, 'tvShowId' => 40, 'name' => 'Saison 2', 'seasonNumber' => 2, 'posterId' =>  372],
            ['id' => 334, 'tvShowId' => 40, 'name' => 'Épisodes spéciaux', 'seasonNumber' => 2147483647, 'posterId' =>  null]];
        $seasons = SeasonCollection::findByTvShowId(40);
        $I->assertCount(count($expectedSeasons), $seasons);
        $I->assertContainsOnlyInstancesOf(Season::class, $seasons);
        foreach ($seasons as $index => $season) {
            $expectedSeason = $expectedSeasons[$index];
            $I->assertEquals($expectedSeason['id'], $season->getId());
            $I->assertEquals($expectedSeason['tvShowId'], $season->getTvShowId());
            $I->assertEquals($expectedSeason['name'], $season->getName());
            $I->assertEquals($expectedSeason['seasonNumber'], $season->getSeasonNumber());
            $I->assertEquals($expectedSeason['posterId'], $season->getPosterId());
        }
    }
}
