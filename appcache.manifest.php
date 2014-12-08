<?php
include('../../../wp-load.php');
header('Content-Type: text/cache-manifest');
// cache these files!
$filesToCache = array(
    get_template_directory_uri() . '/images/splash-bg.png'
);
?>
CACHE MANIFEST

CACHE:
<?php
// Print files that we need to cache and store hash data
$hashes = '';
foreach( $filesToCache as $file ) {
    echo $file . "\n";
    $hashes .= md5_file( $file );
}
?>

NETWORK:
*

# Hash Version: <?=md5($hashes)?>
