<?php

require __DIR__ . '/PackageVersionManager.php';

$packageVersionManager = new PackageVersionManager($argv[1]);
$packageVersionManager->updatePackageFiles();
