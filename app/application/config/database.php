<?php defined('SYSPATH') or die('No direct access allowed.');     
            return array
            (
                'default' => array
                (
                    'type'       => 'MySQL',
                    'connection' => array(
                        'hostname'   => 'wm44.wedos.net',
                        'database'   => 'd51025_dbzs',
                        'username'   => 'a51025_dbzs',   
                        'password'   => 'lucinka10',     
                        'persistent' => FALSE,
                    ),
                    'table_prefix' => 'wh_',
                    'charset'      => 'utf8',
                    'caching'      => FALSE,
                    'profiling'    => TRUE
                )
            );