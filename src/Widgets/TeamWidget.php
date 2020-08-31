<?php

namespace Team\Widgets;
use Team\DataObjects\TeamMember;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Widgets\Model\Widget;
use SilverStripe\Forms\CheckboxField;

if (!class_exists(Widget::class)) {
    return;
}

/**
 * @method Blog Blog()
 *
 * @property string $ArchiveType
 * @property int $NumberToDisplay
 */
class TeamWidget extends Widget
{
    /**
     * @var string
     */
    private static $title = 'Team Member';

    /**
     * @var string
     */
    private static $cmsTitle = 'Team Member';

    /**
     * @var string
     */
    private static $description = 'Displays one Team Member';

    /**
     * @var array
     */
    private static $db = [
    ];
    /**
     * @var array
     */
    private static $has_one = [
        'TeamMember' => TeamMember::class,
    ];

    /**
     * @var string
     */
    private static $table_name = 'TeamMemberWidget';

    /**
     * {@inheritdoc}
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            /**
             * @var FieldList $fields
             */
            $fields->merge([
                DropdownField::create(
                    'TeamMemberID',
                    _t(__CLASS__ . '.TeamMember', 'TeamMember'),
                    TeamMember::get()->map()
                )
            ]);
        });

        return parent::getCMSFields();
    }
}
