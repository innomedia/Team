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
/**
 * Description
 *
 * @package silverstripe
 * @subpackage mysite
 */
class TeamPage extends Page
{
  private static $table_name = 'TeamPage';
  private static $singular_name = 'Teamseite';
  private static $plural_name = 'Teamseiten';
  private static $description ='Hiermit können Sie eine Teamseite mit einer Liste von Mitarbeitern erstellen';


  private static $many_many = [
    'TeamMember' => \Team\DataObjects\TeamMember::class,
  ];

  private static $many_many_extraFields = [
    'TeamMember' => [
      'SortOrder' => 'Int'
    ]
  ];
  public function TeamCategories()
  {
    return TeamCategory::get()->sort("Sort ASC");
  }
  public function TeamMembers(){
      return $this->TeamMember()->sort("SortOrder ASC");
  }
  /**
   * CMS Fields
   * @return FieldList
   */
  public function getCMSFields()
  {
    $fields = parent::getCMSFields();
      $fields->removeByName('WeitereLeistungen');
      $fields->removeByName('AngeboteneLeistung');
      $fields->removeByName('Icon');
      $fields->removeByName('SecondContent');
    if(Config::inst()->get("TeamModuleConfig")["CategoriesEnabled"])
    {
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
    $test = GridFieldConfig_RecordEditor::create(90)->addComponent(new GridFieldOrderableRows('SortOrder'));
    $fields->addFieldToTab(
      'Root.Mitglieder',
      GridField::create(
        'TeamMember',
        'Team Mitglied',
        $this->TeamMember()->sort("SortOrder ASC"),
        $test
      )
    );
    $this->extend('updateCMSFields', $fields);
    return $fields;
  }
}
