<?php

$dir = dirname(__DIR__).'/src';

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('tests')
    ->in($dir)
;

$versions = GitVersionCollection::create($dir)
    ->add('master', 'master branch')
    ->add('unitTest', 'unitTest')
    ->add('filecache', 'filecache')
;

return new Sami($iterator, array(
    'theme'                => 'enhanced',
    'versions'             => $versions,
    //'versions'             => '0.2',
    'title'                => 'Erdiko API',
    'build_dir'            => __DIR__.'/build/%version%/',
    'cache_dir'            => __DIR__.'/cache/%version%/',
    //  'simulate_namespaces'  => true,
    'default_opened_level' => 1,
));

//php ../sami.phar update ./sami/sami_conf.php
