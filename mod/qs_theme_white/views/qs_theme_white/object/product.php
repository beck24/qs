<?php

if ($vars['full_view']) {
  echo elgg_view('object/product/full', $vars);
}
else {
  echo elgg_view('object/product/list', $vars);
}