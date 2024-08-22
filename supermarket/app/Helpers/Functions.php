<?php

use  App\Models\Groups;

function getAllGroups()
{
    $groups = new Groups();
    return $groups->getAll();
}
