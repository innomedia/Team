<?php

namespace Team\DataObjects;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;
use \Team\Pages\TeamPage;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class TeamCategory extends DataObject
{
    private static $table_name = 'TeamCategory';
    private static $db = [
        'Title' => 'Text',
        'Sort' => 'Int',
        'TagSortTitle' => 'Text'
    ];
    private static $belongs_many_many = [
        'TeamMembers' => TeamMember::class
    ];
    private static $has_one = [
        'TeamPage' => \Team\Pages\TeamPage::class,
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName([
            'Sort',
            'TagSortTitle',
            'TeamMembers',
            'TeamPageID',
            'TeamPage'
        ]);
        $fields->addFieldToTab(
            'Root.Main',
            TextField::create(
                'Title',
                'Titel'
            )
        );
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    public function SortedTeamMembers()
    {
        $filter = array();
        foreach ($this->TeamMembers() as $teamMember) {
            array_push($filter, $teamMember->ID);
        }
        return $this->TeamPage()->TeamMember()->filter(array("ID" => $filter))->sort("SortOrder ASC");
    }

    public function onAfterWrite()
    {
        parent::onAfterWrite();
        if ($this->TagSortTitle != $this->Title) {
            $this->TagSortTitle = $this->Title;
            $this->write();
        }
    }
}
