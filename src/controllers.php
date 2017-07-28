<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->match('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;

// création des groupes de routes

// Utilisateurs /////////////////////////////////////////
$user = $app['controllers_factory'];

// protection de l'accès
$user->before(function () use ($app) {
    if (!$app['user.manager']->isUser()) {
        $app->abort(403, 'Accès refusé');
    }
});

$app->match('/about_us', function () use ($app) {
    return $app['twig']->render('aboutUs.html.twig', array());
})
->bind('about_us')
;

$app->match('/share', function () use ($app) {
    return $app['twig']->render('share.html.twig', array());
})
->bind('share')
;
$app->match('/advises', function () use ($app) {
    return $app['twig']->render('resume/advises_cv.html.twig', array());
})
->bind('advises')
;


$app->match('/contact_us', function () use ($app) {
    return $app['twig']->render('contact.html.twig', array());
})
->bind('contact_us')
;


$app->mount('/user', $user);

// entreprise /////////////////////////////////////////
$company = $app['controllers_factory'];

// protection de l'accès
$company->before(function () use ($app) {
    if (!$app['company.manager']->isCompany()) {
        $app->abort(403, 'Accès refusé');
    }
});

$app->mount('/recruteur', $company);


// admin /////////////////////////////////////////
$admin = $app['controllers_factory'];

// protection de l'accès
$admin->before(function () use ($app) {
    if (!$app['user.manager']->isAdmin()) {
        $app->abort(403, 'Accès refusé');
    }
});

$app->mount('/admin', $admin);

// Route pour le dashboard du candidat
$user
    ->match('/', 'user.controller:dashboardAction')
    ->bind('user_dashboard')
;

// Route pour mettre à jour un CV
$user
    ->match('/resume/{id}', 'resume.controller:editAction')
    ->value('id', null)
    ->bind('resume_edit')
;

// Route pour supprimer un CV
$user
    ->get('/suppression', 'resume.controller:deleteAction')
    ->bind('resume_delete')
;

// route pour modifier les infos perso de l'utilisateur
$user
    ->match('/modification_utilisateur', 'user.controller:editAction')
    ->bind('user_edit_profile')
;

//route pour supprimer une experience
$user
    ->post('/supprimer_experience/{id}', 'resume.controller:deleteExperienceAction')
    ->bind('user_delete_experience')
;

//route pour supprimer une experience
$user
    ->post('/supprimer_formation/{id}', 'resume.controller:deleteStudyAction')
    ->bind('user_delete_study')
;

//route pour supprimer une experience
$user
    ->post('/supprimer_langue/{id}', 'resume.controller:deleteLanguageAction')
    ->bind('user_delete_language')
;

// ROUTE D'ENREGISTREMENT CONNEXION ET DECONNEXION UTILISATEURS ET ENTREPRISE DIMITRI ////// 

$app
    ->match('/inscription_utilisateur', 'user.controller:registerAction')
    ->bind('register_user')
;

$app
    ->match('/inscription_entreprise', 'company.controller:registerAction')
    ->bind('register_company')
;

$app
    ->match('/connexion_utilisateur', 'user.controller:loginAction')
    ->bind('login_user')
;

$app
    ->match('/connexion_entreprise', 'company.controller:loginAction')
    ->bind('login_company')
;


$app
    ->get('/deconnexion_utlisateur', 'user.controller:logoutAction')
    ->bind('logout_user')
;

$app
    ->get('/deconnexion_entreprise', 'company.controller:logoutAction')
    ->bind('logout_company')
;

///////////////////////////////////////////////////////////////////////

// route for company dashboard
$company
    ->get('/', 'company.controller:indexAction')
    ->bind('company_dashboard')
;
// route for company profile editing page
$company
    ->match('/profil', 'company.controller:editAction')
    ->bind('company_edit_profile')
;
// route for resume search
$company
    ->get('/recherche_cv', 'company.controller:searchResumeAction')
    ->bind('company_resume_search')
;
// route for tokens ordering
$company
    ->match('/commander_jetons', 'company.controller:orderTokensAction')
    ->bind('order_tokens')
;
// route for orders consulting
$company
    ->get('/historique_commandes', 'order.controller:indexAction')
    ->bind('orders_history')
;
// route for selected resume consulting
$company
    ->get('/consulter_cv/{reference}', 'company.controller:showResumeAction')
    ->bind('company_show_resume')
;
// route for favorites resumes consulting
$company
    ->get('/cv_favoris', 'company.controller:showFavoritesResumesAction')
    ->bind('company_favorites_resumes')
;
//route for adding favorite resume
$company
    ->post('ajout_favori/{reference}', 'company.controller:addFavoriteResumeAction')
    ->bind('company_add_favorite')
;

//route pour débloquer un cv
$company
    ->post('/reveler_cv/{resumeId}', 'company.controller:revealResumeAction')
    ->bind('company_reveal_resume')
;

// route to order tokens
$company
    ->post('/commande_jetons_valider', 'order.controller:orderTokensAction')
    ->bind('company_order_tokens_validate')
;

// ---------------------- Admin Dashboard ---------------------------------

$admin
    ->match('/admin' , 'admin.order.controller:indexAction')
    ->bind('admin')
;

$admin
    ->match('/commandes_modification/{id}', 'admin.order.controller:editAction')
    ->bind('admin_edit_order')
;

$app
    ->match('/connexion_admin', 'admin.admins.controller:loginAction')
    ->bind('login_admin')
;

$app
    ->match('/deconnexion_admin', 'admin.admins.controller:logoutAction')
    ->bind('logout_admin')
;


//---------------------------------------------------------------------------------
        

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});

