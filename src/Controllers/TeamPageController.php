<?php
namespace Team\Pages;

use PageController;
use SilverStripe\Dev\Debug;
use SilverStripe\View\ArrayData;
use Team\DataObjects\TeamMember;
use SilverStripe\ORM\PaginatedList;

class TeamPageController extends PageController
{
    private static $allowed_actions = [
        "member"
    ];

    public function member() {
        $teammember = TeamMember::get()->filter("URLSegment",Convert::raw2sql($this->request->latestParam('ID')));
        if(count($teammember) == 1) {
            $templateData = [
                "TeamMember" => $teammember->First(),
                'BackLink'		=> ((Convert::raw2sql($this->request->getHeader('Referer'))) ? Convert::raw2sql($this->request->getHeader('Referer')) : $this->Link()),
            ];
            return $this->customise(new ArrayData($templateData))->renderWith(["TeamMember","Page"]);
        } else {
            return false;
        }
	}
}