<?php

namespace Emresari\Tests\Tagging;

use Emresari\Tagging\Contracts\TaggableContract;
use Emresari\Tagging\Taggable;
use Illuminate\Database\Eloquent\Model;

class TaggableContractBaseTest extends BaseTestCase
{
    public function test_is_implemented_by_taggable_trait()
    {
        $implementation = new TraitImplementation();

        $this->assertNotNull($implementation);
    }
}

class TraitImplementation extends Model implements TaggableContract
{
    use Taggable;
}
