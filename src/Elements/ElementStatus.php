<?php

namespace Dynamic\Elements\Status\Elements;

use DNADesign\Elemental\Models\BaseElement;
use Dynamic\Elements\Status\Model\Status;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;

/**
 * Class ElementStatus
 * @package Dynamic\Elements\Status\Elements
 */
class ElementStatus extends BaseElement
{
    /**
     * @var string[]
     */
    private static $has_many = [
        'Statuses' => Status::class,
    ];

    /**
     * @var string
     */
    private static $table_name = 'ElementStatus';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            if ($this->ID) {
                $statuses = $fields->dataFieldByName('Statuses');
                $fields->removeByName('Statuses');
                $config = $statuses->getConfig();
                $config
                    ->removeComponentsByType([
                        GridFieldAddExistingAutocompleter::class,
                    ])
                    ->addComponents([

                    ]);

                $fields->addFieldToTab(
                    'Root.Main',
                    $statuses
                );
            }
        });

        return parent::getCMSFields();
    }

    /**
     * @return mixed
     */
    public function getPromoList()
    {
        return $this->Statuses()->sort('SortOrder');
    }

    /**
     * @return DBHTMLText
     */
    public function getSummary()
    {
        if ($this->Statuses()->count() == 1) {
            $label = ' status';
        } else {
            $label = ' statuses';
        }
        return DBField::create_field('HTMLText', $this->Statuses()->count() . $label)->Summary(20);
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__.'.BlockType', 'Status');
    }
}
