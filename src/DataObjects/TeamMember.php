<?php

namespace Team\DataObjects;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use \Team\Pages\TeamPage;
use \Team\DataObjects\TeamCategory;
use SilverStripe\TagField\TagField;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\ListboxField;

class TeamMember extends DataObject
{
    private static $table_name = 'TeamMember';

    private static $db = [
        'Title' => 'Text',
        'Position' => 'Text',
        'Phone' => 'Text',
        'Mobile' => 'Text',
        'Mail' => 'Text',
        'Fax' => 'Text',
        'Sort'  =>  'Int',
        'URLSegment' => 'Varchar(255)'
    ];

    private static $many_many = [
        'TeamCategories' => TeamCategory::class
    ];

    private static $has_one = [
        'TeamPage' => TeamPage::class,
        'Image' => Image::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName([
            'TeamPageID',
            'TeamCategories',
            'Sort'
        ]);

        $fields->addFieldsToTab(
            'Root.Main',
            [
                TextField::create('Title', 'Name'),
                TextField::create('Position', 'Position'),
                TextField::create('Phone', 'Telefon'),
                TextField::create('Mobile', 'Mobil'),
                TextField::create('Mail', 'E-Mail'),
                TextField::create('Fax', 'Fax'),
                UploadField::create('Image', 'Bild')
            ]
        );

        if (Config::inst()->get("TeamModuleConfig")["CategoriesEnabled"]) {
            $fields->addFieldToTab('Root.Main',  ListboxField::create(
                'TeamCategories',
                'Kategorien',
                TeamCategory::get()/*->filter('TeamPageID', $this->TeamPageID)*/,
                $this->TeamCategories()
            ));
        }
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    public function RenderMe($template = "Team\TeamMember")
    {
        return $this->renderWith($template);
    }

    public function Link($action_ = null)
    {
        return $this->TeamPage()->Link() . "member/" . $this->URLSegment;
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->URLSegment = $this->constructURLSegment();
    }
    public function onAfterWrite()
    {
        parent::onAfterWrite();
    }

    private function constructURLSegment()
    {
        $URLSegment = $this->cleanLink(strtolower(str_replace(" ", "-", $this->Title)));
        $count = count($this->ClassName::get()->filter("URLSegment",$URLSegment));
        if($count != 0)
        {
            $URLSegment.= $count;
        }
        return $URLSegment;
    }

    private function cleanLink($string)
    {
        $string = str_replace("ä", "ae", $string);
        $string = str_replace("ü", "ue", $string);
        $string = str_replace("ö", "oe", $string);
        $string = str_replace("Ä", "Ae", $string);
        $string = str_replace("Ü", "Ue", $string);
        $string = str_replace("Ö", "Oe", $string);
        $string = str_replace("ß", "ss", $string);
        $string = str_replace(["´", ",", ":", ";"], "", $string);
        return $string;
    }
}
