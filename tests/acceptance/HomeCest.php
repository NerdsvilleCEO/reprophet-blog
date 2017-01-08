<?php


class HomeAcceptanceCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        // No posts yet
        $I->amOnPage('/home');

        $I->see("Hmm, looks like there aren't any posts... that's, well... boring :(");
        $I->wantTo('create a post');
        $I->click(['link' => 'Login']);
    }
}
