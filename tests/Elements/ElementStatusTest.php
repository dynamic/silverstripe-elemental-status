<?php

namespace Dynamic\Elements\Status\Test;

use Dynamic\Elements\Status\Elements\ElementStatus;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

/**
 * Class ElementStatusTest
 * @package Dynamic\Elements\Status\Test
 */
class ElementStatusTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = '../fixtures.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture(ElementStatus::class, 'one');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
}
