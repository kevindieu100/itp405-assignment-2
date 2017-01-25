<?php
// Query 1 (with orderByTitle)
require 'DvdQuery.php';
use Database\Query\DvdQuery;

$dvdQuery = new DvdQuery();
$dvdQuery->titleContains('Die');
$dvdQuery->orderByTitle();
$dvds = $dvdQuery->find();
var_dump($dvds);

// Query 2 (without orderByTitle)
$dvdQuery = new DvdQuery();
$dvdQuery->titleContains('Die');
// $dvdQuery->orderByTitle();
// Because orderByTitle is not called here, the sorting should be the default insertion order
$dvds = $dvdQuery->find();
var_dump($dvds);