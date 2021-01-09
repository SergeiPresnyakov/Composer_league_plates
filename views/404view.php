<?php
use League\Plates\Engine;
$templates = new Engine('../templates');
echo $templates->render('404template');