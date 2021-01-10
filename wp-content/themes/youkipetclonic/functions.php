<?php
/**
 * functions.php
 */

error_reporting(E_ALL);
ini_set("display_errors", 0);


$templatepath = get_template_directory();

/* パス */
define('T_FUNCTIONS', $templatepath . '/_functions/');
define('T_THEME', get_template_directory_uri());

/* 管理画面設定 */
if (is_admin()){
	include_once(T_FUNCTIONS . '/_admin.php');
}

/* 拡張 */
include_once(T_FUNCTIONS . '/_expansion.php');
/* カスタム投稿 */
include_once(T_FUNCTIONS . '/_customposttype.php');
/* ショートコード */
include_once(T_FUNCTIONS . '/_shortcodes.php');