<?php
/**
 * Menu Class
 * 
 * For interaction with the menu.xml file
 */

 class Menu
 {
    /**
     *  "title" | "cost"
    */
    protected $data = [];

    public function __construct($xmlfile)
    {
        $xml_file = new XMLReader();
        $xml_file->open($xmlfile);

        while($xml_file->read() && $xml_file->name !== 'food'); //skip to first <food>

        while($xml_file->name === 'food'){

            // echo $xml_file->readOuterXml()."<br>";
            $element = new SimpleXMLElement($xml_file->readOuterXml());

            $item = [
                "title" => (string)$element->title,
                "cost"  => (float)$element->cost
            ];

            $this->data[] = $item;

            $xml_file->next('food');    //Move to the next <food>
        }

    }


    public function getData(){

        return $this->data;
    }
 }