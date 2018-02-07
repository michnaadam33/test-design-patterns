#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$input = new Commando\Command();
$input->option()
    ->require()
    ->describedAs('A common name');

$input->option('e')
    ->aka('env')
    ->must(function($env) {
        $envs = ['dev', 'prod'];
        return in_array($env, $envs);
    })
    ->default('prod');

$env = $input['env'];

$application = new App($env);
$application->run($input);
