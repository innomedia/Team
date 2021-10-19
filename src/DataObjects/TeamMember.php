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

class TeamMember extends DataObject
{

    private static $table_name = 'TeamMember';

    private static $db = [
        'Title' => 'Text',
        'Position' => 'Text',
        'Phone' => 'Text',
        'Mobile' => 'Text',
        'Mail' => 'Text',
        'Note' => 'Text'
    ];

    private static $many_many = [
        'TeamCategories' => TeamCategory::class,
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
                TextField::create(
                    'Title',
                    'Name'
                ),
                TextField::create(
                    'Position',
                    'Position'
                ),
                TextField::create(
                    'Phone',
                    'Telefon'
                ),
                TextField::create(
                    'Mobile',
                    'Mobil'
                ),
                TextField::create(
                    'Mail',
                    'E-Mail'
                ),
                TextField::create(
                    'Note',
                    'Notiz'
                ),
                UploadField::create(
                    'Image',
                    'Bild'
                )

            ]
        );
        if (Config::inst()->get("TeamModuleConfig")["CategoriesEnabled"]) {
            $fields->addFieldToTab(
                'Root.Main',
                TagField::create(
                    'TeamCategories',
                    'Team Kategorien',
                    TeamCategory::get(),
                    $this->TeamCategories()
                )->setShouldLazyLoad(true)->setCanCreate(true)->setTitleField("TagSortTitle")
            );
        }
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    public function RenderMe($template = "Team\TeamMember")
    {
        return $this->renderWith($template);
    }
}
