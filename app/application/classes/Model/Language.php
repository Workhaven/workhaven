<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Language extends ORM {
     
    public function get_languages(){
        $languages = array();
        $languages['0'] = __('obtain automatically (default)');
        $dblanguages = ORM::factory('Language')->find_all();  
        foreach ($dblanguages as $language) {
            $languages[$language->code] = $language->name;
        }   
        return $languages;
    }    
}