<?php
session_start();
include('class/url.php');
include('functions/config.php');
$url = new Url('/modules/');
if (!$url->segment(1))
$page = '';
else
$page = $url ->segment(1);

 @$query = $db->query("SELECT * FROM generated_tbl");
    while (@$row  = $query->fetch_object()) {
    $case_link    = $row->case_link;
    $require_link = $row->require_link;

    switch ($page) {
    case $case_link:
      require $require_link;
    break;

    default : //404 Page
    break;

    }
  }
  
switch ($page) {
  
  ################################## GUEST ##################################

  case '';
    require 'pages/guest/login.php';
  break;

  case 'login';
    require 'pages/guest/login.php';
  break;

  case 'qr-login';
    require 'pages/guest/qr-login.php';
  break;

  case 'create-account';
    require 'pages/guest/create-account.php';
  break;

  case 'lost-password-step-1';
    require 'pages/guest/lost-password-step-1.php';
  break;

  case 'lost-password-step-2';
    require 'pages/guest/lost-password-step-2.php';
  break;

  case 'lost-password-step-3';
    require 'pages/guest/lost-password-step-3.php';
  break;

  case 'resend-email';
    require 'pages/guest/resend-email.php';
  break;

  case 'list-of-members';
    require 'pages/guest/list-of-members.php';
  break;

  case 'process';
    require 'pages/guest/process.php';
  break;

  ################################## MEMBER ##################################

  case 'general-information';
    require 'pages/member/general-information.php';
  break;

  case 'friend-request';
    require 'pages/member/friend-request.php';
  break;

  case 'add-friend';
    require 'pages/member/add-friend.php';
  break;

  case 'change-password';
    require 'pages/member/change-password.php';
  break;

  case 'change-profile';
    require 'pages/member/change-profile.php';
  break;

  case 'docs-upload';
    require 'pages/member/docs-upload.php';
  break;

  case 'member-logout';
    require 'pages/member/member-logout.php';
  break;

  ################################## ADMIN ###################################

  case 'dashboard';
    require 'pages/admin/dashboard.php';
  break;

  case 'configure-smtp-server';
    require 'pages/admin/configure-smtp-server.php';
  break;

  case 'accounts';
    require 'pages/admin/accounts.php';
  break;

  case 'dashboard';
    require 'pages/admin/dashboard.php';
  break;

  case 'add-socket';
    require 'pages/admin/add-socket.php';
  break;

  case 'add-security';
    require 'pages/admin/add-security.php';
  break;

  case 'export-database';
    require 'pages/admin/export-database.php';
  break;

  case 'manage-smtp-account';
    require 'pages/admin/manage-smtp-account.php';
  break;

  case 'manage-accounts';
    require 'pages/admin/manage-accounts.php';
  break;

  case 'modify-smtp-account';
    require 'pages/admin/modify-smtp-account.php';
  break;

  case 'qrcode';
    require 'pages/guest/index.php';
  break;

  case 'admin-logout';
    require 'pages/admin/admin-logout.php';
  break;
  
  default:
    require 'pages/404/404.php';
  break;
}


