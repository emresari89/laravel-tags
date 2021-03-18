<?php

namespace Emresari\Tests\Tagging;

use Emresari\Tagging\Events\TagAdded;
use Emresari\Tagging\Events\TagRemoved;

class EventTests extends BaseTestCase
{
    function test_tag_added()
    {
        \Event::listen(TagAdded::class, function(TagAdded $event){
            $this->assertNotEmpty($event->model);
            $this->assertEquals('test', $event->tagSlug);
            $this->assertEquals('Test', $event->tagged->tag_name);
        });

        $book = $this->book();
        $book->tag('Test');
    }

    function test_tag_removed()
    {
        \Event::listen(TagRemoved::class, function(TagRemoved $event){
            $this->assertNotEmpty($event->model);
            $this->assertEquals('test', $event->tagSlug);
        });

        $book = $this->book();
        $book->tag('Test');

        $book->untag('Test');
    }
}
