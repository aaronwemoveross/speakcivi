<?php

require_once 'CRM/Core/Page.php';

class CRM_Speakcivi_Page_Optout extends CRM_Speakcivi_Page_Post {
  function run() {
    $this->setValues();

    $this->setIsOptOut($this->contactId, 1);

    $groupId = CRM_Core_BAO_Setting::getItem('Speakcivi API Preferences', 'group_id');
    $location = '';
    if ($this->isGroupContactAdded($this->contactId, $groupId)) {
      $this->setGroupContactRemoved($this->contactId, $groupId);
      $location = 'removed from Members after optout link';
    }

    if ($this->campaignId) {
      $campaign = new CRM_Speakcivi_Logic_Campaign($this->campaignId);
      $locale = $campaign->getLanguage();
      $language = substr($locale, 0, 2);
      $this->setLanguageGroup($this->contactId, $language);
      $this->setLanguageTag($this->contactId, $language);
    }

    $aids = $this->findActivitiesIds($this->activityId, $this->campaignId, $this->contactId);
    $this->setActivitiesStatuses($this->activityId, $aids, 'optout', $location);

    $country = $this->getCountry($this->campaignId);
    $url = "{$country}/post_optout";
    CRM_Utils_System::redirect($url);
  }
}
