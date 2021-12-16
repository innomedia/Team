<?php

namespace Team\Pages;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

use Page;
use Controllers;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use \Team\DataObjects\TeamCategory;
use \Team\DataObjects\TeamMember;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use SilverStripe\Core\Config\Config;


class TeamPage extends Page
{
    private static $table_name = 'TeamPage';
    private static $description = 'Hiermit können Sie eine Teamseite erstellen - Mitarbeiter werden direkt im Module gepflegt';

    private static $has_many = [
        'TeamMembers' => \Team\DataObjects\TeamMember::class
    ];

    public function TeamCategories()
    {
        return TeamCategory::get()->sort("Sort ASC");
    }

    public function SortedTeamMembers()
    {
        return $this->TeamMember()->sort("Sort ASC");
    }

    public function Teammember()
    {
        return \Team\DataObjects\TeamMember::get()->filter("TeamPageID",$this->ID);   
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Team');
        $fields->removeByName('Galerie');
        if (Config::inst()->get("TeamModuleConfig")["CategoriesEnabled"]) {
            $fields->addFieldToTab(
                'Root.Kategorien',
                GridField::create(
                    'TeamCategories',
                    'TeamCategories',
                    TeamCategory::get()->sort("Sort ASC"),
                    GridFieldConfig_RecordEditor::create(20)->addComponent(new GridFieldOrderableRows("Sort"))
                )
            );
        }
        $fields->addFieldToTab(
            'Root.Mitglieder',
            GridField::create(
                'TeamMembers',
                'Team Mitglied',
                $this->TeamMembers()->sort("Sort ASC"),
                GridFieldConfig_RecordEditor::create(90)->addComponent(new GridFieldOrderableRows('Sort'))
            )
        );
        $fields->removeByName([
            "CopyToSubsiteID",
            "CopyToSubsiteWithChildren",
            "action_copytosubsite"
         ]);
        $this->extend('updateTeamCMSFields', $fields);
        
        return $fields;
    }
}
