<?php

if ($vars['full_view']) {
  echo elgg_view('product/full', $vars);
}
else {
  echo elgg_view('product/list', $vars);
}