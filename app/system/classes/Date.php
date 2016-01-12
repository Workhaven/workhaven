<?php defined('SYSPATH') OR die('No direct script access.');

class Date extends Kohana_Date {
    
    public static function process($datetime, $fuzzy = TRUE){  
        
        $format = __('DateTimeFormat');
        // default datetime format if DateTimeFormat for current language is not set:
        if ($format == 'DateTimeFormat') {
            $format = 'Y-m-d H:i:s';
        }         
        if ($fuzzy) {
            return  "<span class='datetimefuzzy'>" .
                        "<span class='fuzzy'>" .
                            __(Date::fuzzy_span(strtotime($datetime))) .
                        "</span>" .
                        "<span class='datetime'>" .
                            date($format, strtotime($datetime)).
                        "</span>" .                    
                    "</span>";
        } else {                      
            $date = date_create($datetime);
            return date_format($date, $format);
        }
    }
}
