<?php

class CRM_Speakcivi_Logic_Cache {

  private static $dateFormat = 'YmdHis';

  public static function campaign($param) {
    $key = 'speakcivi-cachecampaign-' . $param->external_id;
    $cacheCampaign = Civi::cache()->get($key);
    if (!isset($cacheCampaign) || self::isOld($cacheCampaign['timestamp'])) {
      $campaignObj = new CRM_Speakcivi_Logic_Campaign();
      $campaignObj->campaign = $campaignObj->getCampaign($param->external_id);
      $campaignObj->campaign = $campaignObj->setCampaign($param->external_id, $campaignObj->campaign, $param);
      $customFields = $campaignObj->setCustomFields($campaignObj->campaign);
      $cacheCampaign = array(
        'campaign' => $campaignObj->campaign,
        'customFields' => $customFields,
        'timestamp' => date(self::$dateFormat),
      );
      // fixme move limit to settings
      $limit = 20;
      if ($campaignObj->campaign['api.Activity.getcount'] >= $limit) {
        Civi::cache()->set($key, $cacheCampaign);
      }
    }
    return $cacheCampaign;
  }

  private static function isOld($timestamp) {
    $old = DateTime::createFromFormat(self::$dateFormat, $timestamp)
      ->modify('+1 hour')
      ->format(self::$dateFormat);
    return ($old < date(self::$dateFormat));
  }
}
