<?php
  if (count($persons) > 1) {
    $names = array();
    foreach ($persons as $person) {
      $names[] = $person['name'];
    }
    $last = array_pop($names);
    print implode(', ', $names).' and '.$last.' found a reason to celebrate together!';
  }
  else {
    print $persons[0]['name'].' found out interesting stuff about his/her date of birth!';
  }