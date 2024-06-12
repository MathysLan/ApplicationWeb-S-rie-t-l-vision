<?php

declare(strict_types=1);

namespace Tests\Crud;

use Entity\Genre;
use Entity\Exception\EntityNotFoundException;
use Tests\CrudTester;

class GenreCest
{
    public function findById(CrudTester $I)
    {
        $genre = Genre::findById(1);
        $I->assertSame(1, $genre->getId());
        $I->assertSame('Action & Adventure', $genre->getName());
    }

    public function findByIdThrowsExceptionIfSeasonDoesNotExist(CrudTester $I)
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            Genre::findById(PHP_INT_MAX);
        });
    }
}
