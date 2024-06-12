<?php

declare(strict_types=1);

namespace Tests\Crud\Collection;

use Entity\Collection\GenreCollection;
use Entity\Genre;
use Tests\CrudTester;

class GenreCollectionCest
{
    public function findAll(CrudTester $I)
    {
        $expectedGenre = [
            ['id' => 1, 'name' => 'Action & Adventure'],
            ['id' => 10, 'name' => 'Animation'],
            ['id' => 4, 'name' => 'Comédie'],
            ['id' => 2, 'name' => 'Crime'],
            ['id' => 3, 'name' => 'Drame'],
            ['id' => 9, 'name' => 'Familial'],
            ['id' => 6, 'name' => 'Mystère'],
            ['id' => 11, 'name' => 'Romance'],
            ['id' => 5, 'name' => 'Science-Fiction & Fantastique'],
            ['id' => 8, 'name' => 'War & Politics'],
            ['id' => 7, 'name' => 'Western']
        ];
        $genres = GenreCollection::findAll();
        $I->assertCount(count($expectedGenre), $genres);
        $I->assertContainsOnlyInstancesOf(Genre::class, $genres);
        foreach ($genres as $index => $genre) {
            $expectedTvShow = $expectedGenre[$index];
            $I->assertEquals($expectedTvShow['id'], $genre->getId());
            $I->assertEquals($expectedTvShow['name'], $genre->getName());
        }
    }

}
