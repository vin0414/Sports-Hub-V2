<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//public pages
$routes->get('/', 'Home::index');
$routes->get('latest-videos','Home::latestVideos');
$routes->get('latest-videos/watch/(:any)','Home::watch/$1');
$routes->post('incrementViews/(:num)', 'Home::incrementViews/$1');
$routes->post('save_watch_time','Home::saveWatchTime');
$routes->get('latest-news','Home::latestNews');
$routes->get('latest-news/stories/(:any)','Home::stories/$1');
$routes->get('latest-events','Home::latestEvents');
$routes->get('latest-events/details/(:any)','Home::details/$1');
$routes->get('shop-near-me','Home::shopNearMe');
$routes->get('contact-us','Home::contactUs');
$routes->get('success/(:any)','User::successLink/$1');
$routes->get('resend/(:any)','User::resend/$1');
$routes->get('activate/(:any)','User::activateAccount/$1');
//users
$routes->group('',['filter'=>'UserLoggedIn'],function($routes)
{
    $routes->get('sign-up','User::signUp');
    $routes->get('sign-in','User::signIn');
    $routes->get('reset-password','User::resetPassword'); 
});

$routes->group('',['filter'=>'UserCheck'],function($routes)
{
    $routes->get('profile','User::profile');
    $routes->get('join','User::join');
});
$routes->post('register','User::registerUser');
$routes->post('checkUser','User::checkUser');
$routes->get('sign-out','User::signOut');
$routes->post('new-password','User::newPassword');
$routes->post('account-security','User::accountSecurity');
$routes->post('submit','User::submitForm');
//functions for admin
$routes->post('checkAuth', 'Auth::checkAuth');
$routes->get('logout', 'Auth::logout');
$routes->post('request-new-password','Auth::requestNewPassword');
$routes->post('change-password','Home::changePassword');
//news
$routes->post('save-post','Home::savePost');
$routes->post('modify-post','Home::modifyPost');
$routes->post('save-as-draft','Home::saveDraft');
$routes->get('filter-news','Home::filterNews');
//videos
$routes->post('save-video','Home::saveVideo');
$routes->post('edit-video','Home::modifyVideo');
$routes->get('filter-videos','Home::filterVideos');
$routes->post('save-code','Home::saveCode');
//shops
$routes->get('shop-location','Home::shopLocation');
$routes->post('save-shop','Home::saveShop');
$routes->get('fetch-shop','Home::fetchShop');
$routes->post('edit-shop','Home::editShop');
//recovery
$routes->post('restore','Restore::restoreFile');
$routes->get('download','Download::downloadFile');
//accounts
$routes->get('fetch-accounts','Home::fetchAccounts');
$routes->post('save-account','Home::saveAccount');
$routes->post('update','Home::updateAccount');
$routes->post('reset','Home::resetAccount');
//settings
$routes->get('fetch-sports','Home::fetchSports');
$routes->post('save-sports','Home::saveSports');
$routes->post('save-role','Home::saveRole');
$routes->get('fetch-role','Home::fetchRole');
$routes->get('fetch-achievement','Home::fetchAchievement');
$routes->post('save-achievement','Home::saveAchievement');
$routes->get('fetch-permission','Home::fetchPermission');
$routes->post('save-permission','Home::savePermission');
$routes->get('fetch-specific-permission','Home::fetchSpecificPermission');
$routes->post('edit-permission','Home::editPermission');

$routes->group('',['filter'=>'AlreadyLoggedIn'],function($routes)
{
    $routes->get('auth','Home::auth');
    $routes->get('forgot-password','Home::forgotPassword');
});

$routes->group('',['filter'=>'AuthCheck'],function($routes)
{
    $routes->get('dashboard','Home::dashboard');
    //events
    $routes->get('events','Home::events');
    $routes->get('events/create','Home::createEvent');
    $routes->get('events/edit/(:num)','Home::editEvent/$1');
    $routes->get('events/manage','Home::manageEvent');
    //matches
    $routes->get('matches','Home::matches');
    $routes->get('matches/create','Home::createMatch');
    $routes->get('matches/edit/(:num)','Home::editMatch/$1');
    //teams
    $routes->get('roster/teams','Home::teams');
    $routes->get('roster/teams/create','Home::createTeam');
    $routes->get('roster/teams/edit/(:num)','Home::editTeam/$1');
    //players
    $routes->get('roster/players','Home::players');
    $routes->get('roster/players/create','Home::createPlayer');
    $routes->get('roster/players/edit/(:num)','Home::editPlayer/$1');
    $routes->get('roster/players/profile/(:num)','Home::playersProfile/$1');
    //registration
    $routes->get('roster/registration','Home::rosterRegistration');
    //api
    $routes->get('roster/pending','Roster::getPendingList');
    //videos
    $routes->get('videos','Home::videos');
    $routes->get('videos/upload','Home::uploadVideo');
    $routes->get('videos/edit/(:any)','Home::editVideo/$1');
    $routes->get('videos/live-stream','Home::liveStream');
    //news
    $routes->get('news','Home::news');
    $routes->get('news/create','Home::createNews');
    $routes->get('news/edit/(:any)','Home::editNews/$1');
    //shops
    $routes->get('shops','Home::shops');
    //maintenance
    $routes->get('recovery','Home::recovery');
    $routes->get('settings','Home::settings');
    $routes->get('accounts','Home::accounts');
    $routes->get('accounts/create','Home::createAccount');
    $routes->get('accounts/edit/(:any)','Home::editAccount/$1');
    //my account
    $routes->get('my-account','Home::myAccount');
});