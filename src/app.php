<?php

use Controller\Admin\OrderController as AdminOrderController;
use Controller\CompanyController;
use Controller\OrderController;
use Controller\ResumeController;
use Controller\UserController;
use Repository\CompanyRepository;
use Repository\LanguageRepository;
use Repository\ExperienceRepository;
use Repository\FavoriteRepository;
use Repository\OrderRepository;
use Repository\ResumeRepository;
use Repository\SkillRepository;
use Repository\StudyRepository;
use Repository\UserRepository;
use Service\CompanyManager;
use Service\SecurityManager;
use Service\UserManager;
use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;


$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    $twig->addGlobal('user_manager', $app['user.manager']);
    $twig->addGlobal('company_manager', $app['company.manager']);    

    return $twig;
});

// ajout de Doctrine DataBase Abstraction Layer (DBAL)
// outil qui s'utilise comme PDO mais avec des fonctionnalités supplémentaires
// nécessite un import avec la commande composer require "doctrine/dbal:~2.2"

$app->register(
        new DoctrineServiceProvider(),
        [
            'db.options' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'dbname' => 'hidden_profile',
                'user' => 'root',
                'password' => '',
                'charset' => 'utf8'
            ]
        ]
        );
// gestionnaire de session symfony
$app->register(new SessionServiceProvider());


$app['user.manager'] = function () use ($app) {
    return new UserManager($app['session']);
};

$app['company.manager'] = function () use ($app) {
    return new CompanyManager($app['session']);
};

$app['security.manager'] = function () use ($app) {
    return new SecurityManager($app['session']);
};

/* Déclaration des contrôleurs en service */
$app['resume.controller'] = function () use ($app) {
    return new ResumeController($app);
};

$app['company.controller']= function () use ($app){
    return new CompanyController($app);
};

$app['user.controller']= function () use ($app){
    return new UserController($app);
};

$app['order.controller'] = function () use ($app){
    return new OrderController($app);
};

$app['admin.order.controller']= function () use ($app){
    return new AdminOrderController($app);
};

/* Déclaration des repositories en service */
$app['resume.repository'] = function () use ($app) {
    return new ResumeRepository($app['db']);
};

$app['company.repository'] = function () use ($app) {
    return new CompanyRepository($app['db']);
};

$app['user.repository'] = function () use ($app) {
    return new UserRepository($app['db']);
};

$app['experience.repository'] = function () use ($app) {
    return new ExperienceRepository($app['db']);
};

$app['study.repository'] = function () use ($app) {
    return new StudyRepository($app['db']);
};

$app['skill.repository'] = function () use ($app) {
    return new SkillRepository($app['db']);
};

$app['order.repository'] = function () use ($app){
    return new OrderRepository($app['db']);
};

$app['favorite.repository'] = function () use ($app){
    return new FavoriteRepository($app['db']);
};

$app['language.repository'] = function () use ($app) {
    return new LanguageRepository($app['db']);
};
 
$app['command.repository'] = function () use ($app){
    return new CommandRepository($app['db']);
};
return $app;

