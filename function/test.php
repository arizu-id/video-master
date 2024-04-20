<?php
function get_domain($host){
  $myhost = strtolower(trim($host));
  $count = substr_count($myhost, '.');
  if($count === 2){
    if(strlen(explode('.', $myhost)[1]) > 3) $myhost = explode('.', $myhost, 2)[1];
  } else if($count > 2){
    $myhost = get_domain(explode('.', $myhost, 2)[1]);
  }
  return $myhost;
}
$d = 'scontent-iad3-1.cdninstagram.com';

echo get_domain($d);
