<?php

use App\User;
use App\BlogPost;

class BlogPostCest
{
    public function _before(AcceptanceTester $I)
    {
        $this->post = factory(BlogPost::class)->make([
            'content' => 'Hello World!',
            'title' => 'First blog post'
        ]);
        $user = User::where('email', 'test@test.com')->first();
        $user->posts()->save($this->post);
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function when_i_visit_the_post_page_i_see_the_post(AcceptanceTester $I)
    {
        $I->amOnPage("/blog/" . $this->post->id);
        $I->see($this->post->content);
    } 
  
    public function when_i_login_as_the_post_owner_i_see_the_delete_button(AcceptanceTester $I)
    {
        $I->amOnPage("/login");
        $I->fillField('email', 'test@test.com');
        $I->fillField('password', 'test');
        $I->click('#login-btn');
        $I->seeElement('.fa-trash');
    }
}
