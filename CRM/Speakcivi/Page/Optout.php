<?php

require_once 'CRM/Core/Page.php';

class CRM_Speakcivi_Page_Optout extends CRM_Speakcivi_Page_Post {

  /**
   * @return void
   * @throws \CiviCRM_API3_Exception
   */
  public function run() {
    $this->setActivityStatusIds();
    $this->setValues();

    $contactParams = array(
      'is_opt_out' => 1,
    );

    $groupId = CRM_Core_BAO_Setting::getItem('Speakcivi API Preferences', 'group_id');
    $location = '';
    if ($this->isGroupContactAdded($this->contactId, $groupId)) {
      $location = 'removed from Members after optout link';
      civicrm_api3('Gidipirus', 'cancel_consents', ['contact_id' => $this->contactId, 'date' => date('Y-m-d H:i:s'), 'method' => 'confirmation_link']);
    }

    $redirect = '';
    if ($this->campaignId) {
      $campaign = new CRM_Speakcivi_Logic_Campaign($this->campaignId);
      $locale = $campaign->getLanguage();
      $redirect = $campaign->getRedirectOptout();
      $language = substr($locale, 0, 2);
      $this->setLanguageTag($this->contactId, $language);
    }

    CRM_Speakcivi_Logic_Contact::set($this->contactId, $contactParams);
    $country = $this->getCountry($this->campaignId);
    
    // Either the contact was member and cancel_consents was called, or the contact was not: in both cases it is not a member at this stage
    $this->setConsentStatus('Rejected', FALSE);
    $aids = $this->findActivitiesIds($this->activityId, $this->campaignId, $this->contactId);
    $this->setActivitiesStatuses($this->activityId, $aids, 'optout', $location);

    $url = $this->determineRedirectUrl('post_optout', $country, $redirect);
    CRM_Utils_System::redirect($url);
  }

}
