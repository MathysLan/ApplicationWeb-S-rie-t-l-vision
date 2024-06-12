<?php

declare(strict_types=1);

use Codeception\Stub;
use Entity\TvShow;
use Html\Form\TvShowForm;
use Tests\FormTester;

class ArtistFormCest
{
    public function correctBaseStructure(FormTester $I)
    {
        $tvShow = Stub::make(TvShow::class, ['id' => 90, 'name' => 'Noeud coulant', 'originalName' => 'Noeud coulant',
                                                    'overview' => 'Noeud coulant', 'posterId' => 126, 'homepage' => 'https://test.com/']);
        $I->amTestingPartialHtmlContent((new TvShowForm($tvShow))->getHtmlForm('go.php'));

        $I->seeElement('form[method="post"][action="go.php"]');
        $I->seeElement('form input[type="hidden"][name="id"          ]');
        $I->seeElement('form input[type="hidden"][name="posterId"    ]');
        $I->seeElement('form input[type="text"  ][name="name"        ][required]');
        $I->seeElement('form input[type="text"  ][name="originalName"][required]');
        $I->seeElement('form input[type="url"   ][name="homepage"    ][required]');
        $I->seeElement('form textarea[name="overview"][required]');
        $I->seeElement('form *[type="submit"]');
    }

    public function checkValuesOfNewTvShow(FormTester $I)
    {
        $I->amTestingPartialHtmlContent((new TvShowForm())->getHtmlForm('go.php'));
        $I->seeElement('form input[type="hidden"][name="id"          ][value=""]');
        $I->seeElement('form input[type="hidden"][name="posterId"    ][value=""]');
        $I->seeElement('form input[type="text"  ][name="name"        ][value=""][required]');
        $I->seeElement('form input[type="text"  ][name="originalName"][value=""][required]');
        $I->seeElement('form input[type="url"   ][name="homepage"    ][value=""][required]');
        $I->seeElement('form textarea[name="overview"][required]');
    }

    public function checkValuesOfExistingTvShow(FormTester $I)
    {
        $tvShow = Stub::make(TvShow::class, ['id' => 90, 'name' => 'Noeud coulant', 'originalName' => 'Noeud coulant',
            'overview' => 'Noeud coulant', 'posterId' => 126, 'homepage' => 'https://test.com/']);
        $I->amTestingPartialHtmlContent((new TvShowForm($tvShow))->getHtmlForm('go.php'));
        $I->seeElement('form input[type="hidden"][name="id"          ][value="90"]');
        $I->seeElement('form input[type="hidden"][name="posterId"    ][value="126"]');
        $I->seeElement('form input[type="text"  ][name="name"        ][value="Noeud coulant"][required]');
        $I->seeElement('form input[type="text"  ][name="originalName"][value="Noeud coulant"][required]');
        $I->seeElement('form input[type="url"   ][name="homepage"    ][value="https://test.com/"][required]');
        $I->seeElement('form textarea[name="overview"][required]');
    }

    public function escapeTvShowName(FormTester $I)
    {
        $tvShow = Stub::make(TvShow::class, ['id' => 90, 'name' => 'Noeud&coulant', 'originalName' => 'Noeud coulant',
            'overview' => 'Noeud coulant', 'posterId' => 126, 'homepage' => 'https://test.com/']);
        $I->amTestingPartialHtmlContent((new TvShowForm($tvShow))->getHtmlForm('go.php'));
        $I->seeElement('input[value="Noeud&coulant"]');
    }
}
