<?php
// $Id$

$config['debug_mode'] = 0;
$config['show_exec_time'] = 0;
$error = 0;

$check = $setup->configCheck();
$setup->tpl->assign('check', $check);
if (!$check) { // Dump file to db
    $result = $setup->configDump();
    $base_url = explode('setup/', $_SERVER['PHP_SELF']);
    $query = sprintf("UPDATE `magirc_config` SET `value` = '%s' WHERE `parameter` = 'base_url'", $base_url[0]);
    $setup->db->query($query, SQL_NONE);
    $setup->tpl->assign('result', $result);
    if ($result != 0) {
        $error = 1;
    }
} else {
    $setup->tpl->assign('version', $setup->getDbVersion());
}


$setup->tpl->display('step2.tpl');
?>