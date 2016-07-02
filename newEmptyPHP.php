<?php

$array=array();
$array['prop1']='pippo';
$array['prop2']='paperino';

$oggetto=new stdClass();
$oggetto->prop1='pippo';
$oggetto->prop2='paperino';

$pippo=$array['prop1'];
$oggetto->prop1;