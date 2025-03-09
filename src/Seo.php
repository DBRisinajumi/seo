<?php
namespace DBRisinajumi\Seo;

use Spatie\SchemaOrg\AboutPage;
use Spatie\SchemaOrg\BreadcrumbList;
use Spatie\SchemaOrg\ContactPage;
use Spatie\SchemaOrg\ContactPoint;
use Spatie\SchemaOrg\ListItem;
use Spatie\SchemaOrg\Schema;

class Seo
{
    private array $schemes = [];
    
    public function about(array $data)
    {
        $aboutPage = Schema::aboutPage();
        foreach ($data as $key => $value) {
            $aboutPage->setProperty($key, $value);
        }
        $this->schemes[AboutPage::class] = $aboutPage;
        return $this;
    }
    public function contact($contactPoints = [])
    {
        $contactPage = new ContactPage();
        foreach ($contactPoints as $data) {
            $contactPoint = new ContactPoint();
            $contactPoint->addProperties($data);
            $contactPage->contactPoint($contactPoint);
        }
        $this->schemes[ContactPage::class] = $contactPage;
        return $this;
    }
    public function breadcrumbs($items = [])
    {
        $breadcrumbList = Schema::breadcrumbList();
        $listItems = [];
        foreach ($items as $data) {
            $listItem = new ListItem();
            $listItem->name($data['label'] ?? '');
            if (!empty($data['url'])) {
                $listItem->url($data['url'] ?? '');
            }
            $listItems[] = $listItem;
        }
        $breadcrumbList->itemListElement($listItems);
        $this->schemes[BreadcrumbList::class] = $breadcrumbList;
        return $this;
    }
    
    public function script()
    {
        foreach($this->schemes as $scheme) {
            echo $scheme->toScript();
        }
    }
}
