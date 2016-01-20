<?php

   function createListItems($items)
    {
        $listItems = "";
        foreach($items as $item_name => $item_text){ 
            if(is_array($item_text)){
                $listItems .= createListItems($item_text);
            } else {
                $listItems .='<li><span class="label label-danger">'.$item_text.'</span></li>';
            }
        }
        return $listItems;
    }

    function showErrors(array $errors)
    {
        $error_list = "";
        if(isset($errors) && !empty($errors)){
             $error_list .= '<ul class="errors">';
             foreach($errors as $error_in => $error_text){
                if(is_array($error_text)) $error_list .= createListItems($error_text);
                else $error_list .='<li><span class="label label-danger">'.$error_text.'</span></li>';
             }
             $error_list .= '</ul>';
         }
         return $error_list;
    }
