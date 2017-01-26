<?php

use App\User;
use App\BlogPost;
use \Codeception\Util\Locator;

class HomeAcceptanceCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function when_there_are_no_posts_we_get_feedback(AcceptanceTester $I)
    {
        // No posts yet
        $I->amOnPage('/home');

        $I->see("Hmm, looks like there aren't any posts... that's, well... boring :(");
    }

    public function when_there_is_a_post_we_see_it(AcceptanceTester $I)
    {
        $post = factory(BlogPost::class)->make([
            'content' => 'Hello World!',
            'title' => 'First blog post'
        ]);
        $user = User::where('email', 'test@test.com')->first();
        $user->posts()->save($post);
        $I->amOnPage('/home');
        $I->see($post->content, ".content");
        $I->see($post->title, ".title");
        $I->see($post->user->name);
        $I->see($post->created_at);
    }

    public function when_there_is_a_post_it_links_to_it(AcceptanceTester $I)
    {
        $post = factory(BlogPost::class)->make();
        $user = User::where('email', 'test@test.com')->first();
        $user->posts()->save($post);
        $I->amOnPage("/home");
        $I->see($post->title, Locator::href("/blog/" . $post->id));
    }
}
