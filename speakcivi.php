<?php

require_once 'speakcivi.civix.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function speakcivi_civicrm_config(&$config) {
  _speakcivi_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function speakcivi_civicrm_xmlMenu(&$files) {
  _speakcivi_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function speakcivi_civicrm_install() {
  _speakcivi_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function speakcivi_civicrm_uninstall() {
  _speakcivi_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function speakcivi_civicrm_enable() {
  _speakcivi_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function speakcivi_civicrm_disable() {
  _speakcivi_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function speakcivi_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _speakcivi_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function speakcivi_civicrm_managed(&$entities) {
  _speakcivi_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function speakcivi_civicrm_caseTypes(&$caseTypes) {
  _speakcivi_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function speakcivi_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _speakcivi_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implementation of hook_civicrm_tokens
 *
 * @param $tokens
 */
function speakcivi_civicrm_tokens(&$tokens) {
  $tokens['speakcivi'] = array(
    'speakcivi.confirmation_hash' => 'Confirmation hash',
  );
}

/**
 * Implementation of hook_civicrm_tokenValues
 *
 * @param $values
 * @param $cids
 * @param null $job
 * @param array $tokens
 * @param null $context
 */
function speakcivi_civicrm_tokenValues(&$values, $cids, $job = null, $tokens = array(), $context = null) {
  foreach ($cids as $cid) {
    $values[$cid]['speakcivi.confirmation_hash'] = sha1(CIVICRM_SITE_KEY . $cid);
  }
}

function speakcivi_civicrm_apiWrappers(&$wrappers, $apiRequest) {
  if ($apiRequest['entity'] == 'MailingEventUnsubscribe' && $apiRequest['action'] == 'create') {
    $wrappers[] = new CRM_Speakcivi_APIWrapper();
  }
}

/**
 * Implements hook_civicrm_preProcess().
 */
function speakcivi_civicrm_preProcess($formName, &$form) {
  if (in_array($formName, array('CRM_Contribute_Form_Contribution_Main'))) {
    CRM_Core_Resources::singleton()->addScriptFile('eu.wemove.speakcivi', 'js/speakcivi-prefill.js');
  }
}

function speakcivi_civicrm_postProcess($formName, &$form) {
  /** Trello #264 Add the right language for new people coming in through donation pages */
  if ($formName == 'CRM_Contribute_Form_Contribution_Confirm') {
    $result = civicrm_api3('Contribution', 'get', array(
      'sequential' => 1,
      'id' => $form->_contributionID,
    ));
    $campaignId = @(int)$result['values'][0]['contribution_campaign_id'];
    CRM_Speakcivi_Logic_Contact::setMembers($form->_contactID, $campaignId);
  }
}

/**
 * Update petition metrics analytics table to indicate that 
 * aggregate recipient counts need to be re-computed for the campaign of this mailing
 */
function speakcivi_civicrm_postMailing($mailingId) {
  $mailing = civicrm_api3('Mailing', 'get', ['sequential' => 1, 'id' => $mailingId, 'return' => ['campaign_id']]);
  $campaignId = @(int)$mailing['values'][0]['campaign_id'];
  if ($campaignId) {
    $query = 
      "UPDATE speakeasy_petition_metrics SET need_refresh = 1"
      . " WHERE campaign_id = %1"
      . "   AND activity = %2"
    ;
    $params = [
      1 => [$campaignId, 'Integer'], 
      2 => ['unique_recipient', 'String']
    ];
    CRM_Core_DAO::executeQuery($query, $params);

    $campaign = civicrm_api3('Campaign', 'get', ['sequential' => 1, 'id' => $campaignId, 'return' => ['parent_id']]);
    $parentId = @(int)$campaign['values'][0]['parent_id'];
    if ($parentId) {
      $params = [
        1 => [$parentId, 'Integer'], 
        2 => ['gunique_recipient', 'String']
      ];
      CRM_Core_DAO::executeQuery($query, $params);
    }
  }
}
