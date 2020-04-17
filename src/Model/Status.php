<?php

namespace Dynamic\Elements\Status\Model;

use Dynamic\Elements\Status\Elements\ElementStatus;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;

/**
 * Class Status
 * @package Dynamic\Elements\Status\Model
 */
class Status extends DataObject
{
    /**
     * @var string[]
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Status' => 'Enum("Online,Degraded,Offline")',
        'Content' => 'Text',
    ];

    /**
     * @var string[]
     */
    private static $has_one = [
        'ElementStatus' => ElementStatus::class,
    ];

    /**
     * @var string[]
     */
    private static $summary_fields = [
        'Title',
        'Status',
        'Content.Summary' => 'Content',
    ];

    /**
     * @var string
     */
    private static $table_name = 'ES_Status';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName([
                'ElementStatusID',
            ]);
        });

        return parent::getCMSFields();
    }
}
