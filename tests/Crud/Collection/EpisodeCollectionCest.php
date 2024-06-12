<?php
declare(strict_types=1);

namespace Tests\Crud\Collection;

use Entity\Collection\EpisodeCollection;
use Entity\Episode;
use Tests\CrudTester;

class EpisodeCollectionCest
{
    public function findBySeasonId(CrudTester $I)
    {
        $expectedTvShows = [
            ['id' => 5750, 'seasonId' => 334, 'name' => 'Épisode 1','overview' => '','episodeNumber' =>1],
            ['id' => 5751,'seasonId' => 334,'name' => 'Épisode 2','overview' => '','episodeNumber' => 2],
            ['id' => 5752,'seasonId' => 334,'name' => 'Épisode 3','overview' => '','episodeNumber' => 3]
        ];
        $episodes = EpisodeCollection::findBySeasonId(334);
        $I->assertCount(count($expectedTvShows), $episodes);
        $I->assertContainsOnlyInstancesOf(Episode::class, $episodes);
        foreach ($episodes as $index => $episode) {
            $expectedTvShow = $expectedTvShows[$index];
            $I->assertEquals($expectedTvShow['id'], $episode->getId());
            $I->assertEquals($expectedTvShow['name'], $episode->getName());
            $I->assertEquals($expectedTvShow['episodeNumber'], $episode->getEpisodeNumber());
            $I->assertEquals($expectedTvShow['overview'], $episode->getOverview());
            $I->assertEquals($expectedTvShow['seasonId'], $episode->getSeasonId());
        }


    }
}