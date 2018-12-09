<!DOCTYPE html>
<html lang="en">
<head>
<?php $shor10->loadComponent("head"); ?>
<title><?=$shor10->title?></title>
</head>
<body>
<?php $shor10->loadComponent("nav"); ?>
<main>
<?php $shor10->loadContent()?>
</main>
<?php $shor10->loadComponent("footer"); ?>
<?php $shor10->loadComponent("scripts"); ?>
</body>
</html>
