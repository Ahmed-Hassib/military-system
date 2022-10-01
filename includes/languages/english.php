<?php

/**
 * ENGLISH LANGUAGE
 */
function languageEn($phrase)
{
    static $lang = array(

        'LOGIN'                         => 'login',
        'USERNAME'                      => 'username',
        'PASSWORD'                      => 'password',
        'DASHBOARD'                     => 'dashboard',
        'SOLDIER'                       => 'soldier',
        'SOLDIER NAME'                  => 'soldier name',
        'SOLDIER PHONE1'                 => 'soldier phone 1',
        'SOLDIER PHONE2'                => 'soldier phone 2',
        'THE SOLDIER'                   => 'the soldier',
        'SOLDIERS'                      => 'soldiers',
        'THE SOLDIERS'                  => 'the soldiers',
        'UNIT'                          => 'unit',
        'UNIT NAME'                     => 'unit name',
        'UNIT NAME IN ARABIC'           => 'unit name inarabic',
        'UNIT NAME IN ENGLISH'          => 'unit name in english',
        'UNIT TYPE'                     => 'unit type',
        'THE UNIT'                      => 'the unit',
        'UNITS'                         => 'units',
        'THE UNITS'                     => 'the units',
        'BASIC UNIT'                    => 'basic unit',
        'THE BASIC UNIT'                => 'the basic unit',
        'BASIC UNITS'                   => 'basic units',
        'THE BASIC UNITS'               => 'the basic units',
        'CURRENT UNIT'                  => 'current unit',
        'THE CURRENT UNIT'              => 'the current unit',
        'CURRENT UNITS'                 => 'current units',
        'THE CURRENT UNITS'             => 'the current units',
        'ADD NEW UNIT'                  => 'add new unit',
        'EDIT UNIT'                     => 'edit unit',
        'DELETE'                        => 'delete',
        'DELETE UNIT'                   => 'delete unit',
        'CLOSE'                         => 'close',
        'ADD'                           => 'add',
        'SAVE CHANGES'                  => 'save changes',
        'CONTROL'                       => 'control',

        

        'AUTOMATED 830 CENTER'          => 'automated 830 center',
        'USERNAME IS REQUIRED'          => 'username is required',
        'PASSWORD IS REQUIRED'          => 'password is required',
        'USERNAME OR PASSWORD IS WRONG' => 'username or password is wrong',
        'DEVELOPED BY AHMED HASSIB'     => 'developed by ahmed hassib',
        'UNIT NAME IS EXIST BEFORE'     => 'unit name is exist before',
        'UNIT NAME CANNOT BE EMPTY'     => 'unit name cannot be empty',
        'UNIT ADDED SUCESSFULLY'        => 'unit added successfully',
        'UNIT UPDATED SUCESSFULLY'      => 'unit updated successfully',
        'UNIT DELETED SUCESSFULLY'      => 'unit deleted successfully',
        'ADD NEW SOLDIER'               => 'add new soldier',
        'PERSONAL INFO'                 => 'personal info',

        
        
        'ARE YOU SURE TO DELETE THIS UNIT?'                     => 'are you sure to delete this unit?',
        'THERE IS NO PAGE WITH THIS NAME'                       => 'there is no page with this name',
        'YOU CANNOT ACCESS THIS PAGE DIRECTLY'                  => 'you cannot access this page directly',
        'YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE'     => 'you don`t have the permission to access this page',
    
    );
    // return the word
    return $lang[$phrase];
}
