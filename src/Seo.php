<?php
namespace DBRisinajumi\Seo;

use Spatie\SchemaOrg\AboutPage;

class Seo
{
    private $scheme;
    
    public function about()
    {
        $this->scheme = new AboutPage();
    }
    
    public function script()
    {
        $this->scheme->toScript();
    }
    public function __set($property, $values)
    {
        $this->scheme->{$property} = $value;
    }
}
