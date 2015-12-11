<?php
/*
 * Settings metadata file
 */

return array(
  'opt_in' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'opt_in',
    'type' => 'Boolean',
    'quick_form_type' => 'YesNo',
    'default' => 1,
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Opt-in',
    'description' => "Opt-in",
    'help_text' => "Opt-in",
  ),
  'group_id' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'group_id',
    'type' => 'Integer',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 42,
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Default group Id',
    'description' => 'Default group Id',
    'help_text' => 'Default group Id',
  ),
  'default_language_group_id' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'default_language_group_id',
    'type' => 'Integer',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 47,
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Default language group Id',
    'description' => 'Default language group Id',
    'help_text' => 'Default language group Id',
  ),
  'language_group_name_suffix' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'language_group_name_suffix',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => '-language-activists',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Suffix of language group name',
    'description' => "Suffix of language group name",
    'help_text' => "Suffix of language group name",
  ),
  'language_tag_name_prefix' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'language_tag_name_prefix',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 'can speak ',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Prefix of language tag name',
    'description' => "Prefix of language tag name",
    'help_text' => "Prefix of language tag name",
  ),
  'default_template_id' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'default_template_id',
    'type' => 'Integer',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 69,
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Default message template id',
    'description' => "Default message template id",
    'help_text' => "Default message template id",
  ),
  'default_language' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'default_language',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 'en_GB',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Default language',
    'description' => "Default language",
    'help_text' => "Default language",
  ),
  'field_template_id' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'field_template_id',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 'custom_3',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Custom field for campaign\'s message template',
    'description' => "Custom field for campaign's message template",
    'help_text' => "Custom field for campaign's message template",
  ),
  'field_language' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'field_language',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 'custom_4',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Custom field for campaign\'s language',
    'description' => "Custom field for campaign's language",
    'help_text' => "Custom field for campaign's language",
  ),
  'field_sender_mail' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'field_sender_mail',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 'custom_5',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Custom field for campaign\'s sender mail',
    'description' => "Custom field for campaign's sender mail",
    'help_text' => "Custom field for campaign's sender mail",
  ),
  'from' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'from',
    'type' => 'String',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => '"Xavier - WeMove.EU" <info@wemove.eu>',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'From',
    'description' => "From",
    'help_text' => "From",
  ),
  'country_lang_mapping' => array(
    'group_name' => 'Speakcivi API Preferences',
    'group' => 'speakcivi',
    'name' => 'country_lang_mapping',
    'type' => 'Array',
    'quick_form_type' => 'Element',
    'html_type' => 'textarea',
    'default' => array(
      'DE' => 'de_DE',
      'EN' => 'en_GB',
      'ES' => 'es_ES',
      'FR' => 'fr_FR',
      'IT' => 'it_IT',
      'PL' => 'pl_PL',
    ),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'title' => 'Mapping between country code and language',
    'description' => "Mapping between country code and language",
    'help_text' => "Mapping between country code and language",
  ),
);
