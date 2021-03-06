<?php
// @codingStandardsIgnoreFile
/**
 * @file
 * Contains database additions to drupal-8.4.0.bare.standard.php.gz for testing
 * the upgrade paths of consumers module.
 */

use Drupal\Core\Database\Database;

$connection = Database::getConnection();

// Set the schema version.
$connection->merge('key_value')
  ->fields([
    'value' => 'i:8000;',
    'name' => 'consumers',
    'collection' => 'system.schema',
  ])
  ->condition('collection', 'system.schema')
  ->condition('name', 'consumers')
  ->execute();

// Update core.extension.
$extensions = $connection->select('config')
  ->fields('config', ['data'])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute()
  ->fetchField();
$extensions = unserialize($extensions);
$extensions['module']['consumers'] = 8000;
$connection->update('config')
  ->fields([
    'data' => serialize($extensions),
    'collection' => '',
    'name' => 'core.extension',
  ])
  ->condition('collection', '')
  ->condition('name', 'core.extension')
  ->execute();

// Insert Consumers' key_value entries.
$connection->insert('key_value')
->fields(array(
  'collection',
  'name',
  'value',
))
->values(array(
  'collection' => 'entity.definitions.installed',
  'name' => 'consumer.entity_type',
  'value' => 'O:36:"Drupal\Core\Entity\ContentEntityType":38:{s:25:" * revision_metadata_keys";a:0:{}s:15:" * static_cache";b:1;s:15:" * render_cache";b:1;s:19:" * persistent_cache";b:1;s:14:" * entity_keys";a:8:{s:2:"id";s:2:"id";s:5:"label";s:5:"label";s:4:"uuid";s:4:"uuid";s:8:"revision";s:0:"";s:6:"bundle";s:0:"";s:8:"langcode";s:0:"";s:16:"default_langcode";s:16:"default_langcode";s:29:"revision_translation_affected";s:29:"revision_translation_affected";}s:5:" * id";s:8:"consumer";s:16:" * originalClass";s:32:"Drupal\consumers\Entity\Consumer";s:11:" * handlers";a:5:{s:12:"list_builder";s:36:"Drupal\consumers\ConsumerListBuilder";s:4:"form";a:4:{s:7:"default";s:41:"Drupal\consumers\Entity\Form\ConsumerForm";s:3:"add";s:41:"Drupal\consumers\Entity\Form\ConsumerForm";s:4:"edit";s:41:"Drupal\consumers\Entity\Form\ConsumerForm";s:6:"delete";s:42:"Drupal\Core\Entity\ContentEntityDeleteForm";}s:6:"access";s:37:"Drupal\consumers\AccessControlHandler";s:7:"storage";s:46:"Drupal\Core\Entity\Sql\SqlContentEntityStorage";s:12:"view_builder";s:36:"Drupal\Core\Entity\EntityViewBuilder";}s:19:" * admin_permission";s:28:"administer consumer entities";s:25:" * permission_granularity";s:11:"entity_type";s:8:" * links";a:5:{s:9:"canonical";s:42:"/admin/config/services/consumer/{consumer}";s:10:"collection";s:31:"/admin/config/services/consumer";s:8:"add-form";s:46:"/admin/config/services/consumer/{consumer}/add";s:9:"edit-form";s:47:"/admin/config/services/consumer/{consumer}/edit";s:11:"delete-form";s:49:"/admin/config/services/consumer/{consumer}/delete";}s:17:" * label_callback";N;s:21:" * bundle_entity_type";N;s:12:" * bundle_of";N;s:15:" * bundle_label";N;s:13:" * base_table";s:8:"consumer";s:22:" * revision_data_table";N;s:17:" * revision_table";N;s:13:" * data_table";N;s:15:" * translatable";b:0;s:19:" * show_revision_ui";b:0;s:8:" * label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:8:"Consumer";s:12:" * arguments";a:0:{}s:10:" * options";a:0:{}}s:19:" * label_collection";s:0:"";s:17:" * label_singular";s:0:"";s:15:" * label_plural";s:0:"";s:14:" * label_count";a:0:{}s:15:" * uri_callback";N;s:8:" * group";s:7:"content";s:14:" * group_label";O:48:"Drupal\Core\StringTranslation\TranslatableMarkup":3:{s:9:" * string";s:7:"Content";s:12:" * arguments";a:0:{}s:10:" * options";a:1:{s:7:"context";s:17:"Entity type group";}}s:22:" * field_ui_base_route";N;s:26:" * common_reference_target";b:0;s:22:" * list_cache_contexts";a:0:{}s:18:" * list_cache_tags";a:1:{i:0;s:13:"consumer_list";}s:14:" * constraints";a:0:{}s:13:" * additional";a:0:{}s:8:" * class";s:32:"Drupal\consumers\Entity\Consumer";s:11:" * provider";s:9:"consumers";s:20:" * stringTranslation";N;}',
))
->values(array(
  'collection' => 'entity.definitions.installed',
  'name' => 'consumer.field_storage_definitions',
  'value' => "a:6:{s:2:\"id\";O:37:\"Drupal\\Core\\Field\\BaseFieldDefinition\":5:{s:7:\" * type\";s:7:\"integer\";s:9:\" * schema\";a:4:{s:7:\"columns\";a:1:{s:5:\"value\";a:3:{s:4:\"type\";s:3:\"int\";s:8:\"unsigned\";b:1;s:4:\"size\";s:6:\"normal\";}}s:11:\"unique keys\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign keys\";a:0:{}}s:10:\" * indexes\";a:0:{}s:17:\" * itemDefinition\";O:51:\"Drupal\\Core\\Field\\TypedData\\FieldItemDataDefinition\":2:{s:18:\" * fieldDefinition\";r:2;s:13:\" * definition\";a:2:{s:4:\"type\";s:18:\"field_item:integer\";s:8:\"settings\";a:6:{s:8:\"unsigned\";b:1;s:4:\"size\";s:6:\"normal\";s:3:\"min\";s:0:\"\";s:3:\"max\";s:0:\"\";s:6:\"prefix\";s:0:\"\";s:6:\"suffix\";s:0:\"\";}}}s:13:\" * definition\";a:6:{s:5:\"label\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:2:\"ID\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:9:\"read-only\";b:1;s:8:\"provider\";s:9:\"consumers\";s:10:\"field_name\";s:2:\"id\";s:11:\"entity_type\";s:8:\"consumer\";s:6:\"bundle\";N;}}s:4:\"uuid\";O:37:\"Drupal\\Core\\Field\\BaseFieldDefinition\":5:{s:7:\" * type\";s:4:\"uuid\";s:9:\" * schema\";a:4:{s:7:\"columns\";a:1:{s:5:\"value\";a:3:{s:4:\"type\";s:13:\"varchar_ascii\";s:6:\"length\";i:128;s:6:\"binary\";b:0;}}s:11:\"unique keys\";a:1:{s:5:\"value\";a:1:{i:0;s:5:\"value\";}}s:7:\"indexes\";a:0:{}s:12:\"foreign keys\";a:0:{}}s:10:\" * indexes\";a:0:{}s:17:\" * itemDefinition\";O:51:\"Drupal\\Core\\Field\\TypedData\\FieldItemDataDefinition\":2:{s:18:\" * fieldDefinition\";r:35;s:13:\" * definition\";a:2:{s:4:\"type\";s:15:\"field_item:uuid\";s:8:\"settings\";a:3:{s:10:\"max_length\";i:128;s:8:\"is_ascii\";b:1;s:14:\"case_sensitive\";b:0;}}}s:13:\" * definition\";a:6:{s:5:\"label\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:4:\"UUID\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:9:\"read-only\";b:1;s:8:\"provider\";s:9:\"consumers\";s:10:\"field_name\";s:4:\"uuid\";s:11:\"entity_type\";s:8:\"consumer\";s:6:\"bundle\";N;}}s:8:\"owner_id\";O:37:\"Drupal\\Core\\Field\\BaseFieldDefinition\":5:{s:7:\" * type\";s:16:\"entity_reference\";s:9:\" * schema\";a:4:{s:7:\"columns\";a:1:{s:9:\"target_id\";a:3:{s:11:\"description\";s:28:\"The ID of the target entity.\";s:4:\"type\";s:3:\"int\";s:8:\"unsigned\";b:1;}}s:7:\"indexes\";a:1:{s:9:\"target_id\";a:1:{i:0;s:9:\"target_id\";}}s:11:\"unique keys\";a:0:{}s:12:\"foreign keys\";a:0:{}}s:10:\" * indexes\";a:0:{}s:17:\" * itemDefinition\";O:51:\"Drupal\\Core\\Field\\TypedData\\FieldItemDataDefinition\":2:{s:18:\" * fieldDefinition\";r:67;s:13:\" * definition\";a:2:{s:4:\"type\";s:27:\"field_item:entity_reference\";s:8:\"settings\";a:3:{s:11:\"target_type\";s:4:\"user\";s:7:\"handler\";s:7:\"default\";s:16:\"handler_settings\";a:0:{}}}}s:13:\" * definition\";a:10:{s:5:\"label\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:11:\"Authored by\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:11:\"description\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:36:\"The username of the consumer author.\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:12:\"revisionable\";b:1;s:22:\"default_value_callback\";s:50:\"Drupal\\consumers\\Entity\\Consumer::getCurrentUserId\";s:12:\"translatable\";b:1;s:7:\"display\";a:2:{s:4:\"view\";a:1:{s:7:\"options\";a:3:{s:5:\"label\";s:6:\"hidden\";s:4:\"type\";s:6:\"author\";s:6:\"weight\";i:0;}}s:4:\"form\";a:2:{s:7:\"options\";a:1:{s:4:\"type\";s:6:\"hidden\";}s:12:\"configurable\";b:1;}}s:8:\"provider\";s:9:\"consumers\";s:10:\"field_name\";s:8:\"owner_id\";s:11:\"entity_type\";s:8:\"consumer\";s:6:\"bundle\";N;}}s:5:\"label\";O:37:\"Drupal\\Core\\Field\\BaseFieldDefinition\":5:{s:7:\" * type\";s:6:\"string\";s:9:\" * schema\";a:4:{s:7:\"columns\";a:1:{s:5:\"value\";a:3:{s:4:\"type\";s:7:\"varchar\";s:6:\"length\";i:255;s:6:\"binary\";b:0;}}s:11:\"unique keys\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign keys\";a:0:{}}s:10:\" * indexes\";a:0:{}s:17:\" * itemDefinition\";O:51:\"Drupal\\Core\\Field\\TypedData\\FieldItemDataDefinition\":2:{s:18:\" * fieldDefinition\";r:115;s:13:\" * definition\";a:2:{s:4:\"type\";s:17:\"field_item:string\";s:8:\"settings\";a:3:{s:10:\"max_length\";i:255;s:8:\"is_ascii\";b:0;s:14:\"case_sensitive\";b:0;}}}s:13:\" * definition\";a:10:{s:5:\"label\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:5:\"Label\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:11:\"description\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:19:\"The consumer label.\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:8:\"required\";b:1;s:12:\"translatable\";b:1;s:12:\"revisionable\";b:1;s:7:\"display\";a:2:{s:4:\"view\";a:1:{s:7:\"options\";a:3:{s:5:\"label\";s:6:\"hidden\";s:4:\"type\";s:6:\"string\";s:6:\"weight\";i:-5;}}s:4:\"form\";a:2:{s:7:\"options\";a:2:{s:4:\"type\";s:16:\"string_textfield\";s:6:\"weight\";i:-5;}s:12:\"configurable\";b:1;}}s:8:\"provider\";s:9:\"consumers\";s:10:\"field_name\";s:5:\"label\";s:11:\"entity_type\";s:8:\"consumer\";s:6:\"bundle\";N;}}s:11:\"description\";O:37:\"Drupal\\Core\\Field\\BaseFieldDefinition\":5:{s:7:\" * type\";s:11:\"string_long\";s:9:\" * schema\";a:4:{s:7:\"columns\";a:1:{s:5:\"value\";a:2:{s:4:\"type\";s:4:\"text\";s:4:\"size\";s:3:\"big\";}}s:11:\"unique keys\";a:0:{}s:7:\"indexes\";a:0:{}s:12:\"foreign keys\";a:0:{}}s:10:\" * indexes\";a:0:{}s:17:\" * itemDefinition\";O:51:\"Drupal\\Core\\Field\\TypedData\\FieldItemDataDefinition\":2:{s:18:\" * fieldDefinition\";r:162;s:13:\" * definition\";a:2:{s:4:\"type\";s:22:\"field_item:string_long\";s:8:\"settings\";a:1:{s:14:\"case_sensitive\";b:0;}}}s:13:\" * definition\";a:8:{s:5:\"label\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:11:\"Description\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:11:\"description\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:126:\"A description of the consumer. This text will be shown to the users to authorize sharing their data to create an access token.\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:12:\"translatable\";b:1;s:7:\"display\";a:2:{s:4:\"view\";a:2:{s:7:\"options\";a:3:{s:5:\"label\";s:6:\"hidden\";s:4:\"type\";s:6:\"string\";s:6:\"weight\";i:0;}s:12:\"configurable\";b:1;}s:4:\"form\";a:2:{s:7:\"options\";a:2:{s:4:\"type\";s:16:\"string_textfield\";s:6:\"weight\";i:0;}s:12:\"configurable\";b:1;}}s:8:\"provider\";s:9:\"consumers\";s:10:\"field_name\";s:11:\"description\";s:11:\"entity_type\";s:8:\"consumer\";s:6:\"bundle\";N;}}s:5:\"image\";O:37:\"Drupal\\Core\\Field\\BaseFieldDefinition\":5:{s:7:\" * type\";s:5:\"image\";s:9:\" * schema\";a:4:{s:7:\"columns\";a:5:{s:9:\"target_id\";a:3:{s:11:\"description\";s:26:\"The ID of the file entity.\";s:4:\"type\";s:3:\"int\";s:8:\"unsigned\";b:1;}s:3:\"alt\";a:3:{s:11:\"description\";s:56:\"Alternative image text, for the image's 'alt' attribute.\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";i:512;}s:5:\"title\";a:3:{s:11:\"description\";s:52:\"Image title text, for the image's 'title' attribute.\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";i:1024;}s:5:\"width\";a:3:{s:11:\"description\";s:33:\"The width of the image in pixels.\";s:4:\"type\";s:3:\"int\";s:8:\"unsigned\";b:1;}s:6:\"height\";a:3:{s:11:\"description\";s:34:\"The height of the image in pixels.\";s:4:\"type\";s:3:\"int\";s:8:\"unsigned\";b:1;}}s:7:\"indexes\";a:1:{s:9:\"target_id\";a:1:{i:0;s:9:\"target_id\";}}s:12:\"foreign keys\";a:1:{s:9:\"target_id\";a:2:{s:5:\"table\";s:12:\"file_managed\";s:7:\"columns\";a:1:{s:9:\"target_id\";s:3:\"fid\";}}}s:11:\"unique keys\";a:0:{}}s:10:\" * indexes\";a:0:{}s:17:\" * itemDefinition\";O:51:\"Drupal\\Core\\Field\\TypedData\\FieldItemDataDefinition\":2:{s:18:\" * fieldDefinition\";r:205;s:13:\" * definition\";a:2:{s:4:\"type\";s:16:\"field_item:image\";s:8:\"settings\";a:16:{s:13:\"default_image\";a:5:{s:4:\"uuid\";N;s:3:\"alt\";s:0:\"\";s:5:\"title\";s:0:\"\";s:5:\"width\";N;s:6:\"height\";N;}s:11:\"target_type\";s:4:\"file\";s:13:\"display_field\";b:0;s:15:\"display_default\";b:0;s:10:\"uri_scheme\";s:6:\"public\";s:15:\"file_extensions\";s:16:\"png gif jpg jpeg\";s:9:\"alt_field\";i:1;s:18:\"alt_field_required\";i:1;s:11:\"title_field\";i:0;s:20:\"title_field_required\";i:0;s:14:\"max_resolution\";s:0:\"\";s:14:\"min_resolution\";s:0:\"\";s:14:\"file_directory\";s:31:\"[date:custom:Y]-[date:custom:m]\";s:12:\"max_filesize\";s:0:\"\";s:7:\"handler\";s:7:\"default\";s:16:\"handler_settings\";a:0:{}}}}s:13:\" * definition\";a:8:{s:5:\"label\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:4:\"Logo\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:11:\"description\";O:48:\"Drupal\\Core\\StringTranslation\\TranslatableMarkup\":3:{s:9:\" * string\";s:21:\"Logo of the consumer.\";s:12:\" * arguments\";a:0:{}s:10:\" * options\";a:0:{}}s:12:\"revisionable\";b:1;s:7:\"display\";a:2:{s:4:\"view\";a:2:{s:7:\"options\";a:3:{s:5:\"label\";s:6:\"hidden\";s:4:\"type\";s:5:\"image\";s:6:\"weight\";i:-3;}s:12:\"configurable\";b:1;}s:4:\"form\";a:2:{s:7:\"options\";a:3:{s:4:\"type\";s:5:\"image\";s:6:\"weight\";i:-3;s:8:\"settings\";a:2:{s:19:\"preview_image_style\";s:9:\"thumbnail\";s:18:\"progress_indicator\";s:8:\"throbber\";}}s:12:\"configurable\";b:1;}}s:8:\"provider\";s:9:\"consumers\";s:10:\"field_name\";s:5:\"image\";s:11:\"entity_type\";s:8:\"consumer\";s:6:\"bundle\";N;}}}",
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'consumer.entity_schema_data',
  'value' => 'a:1:{s:8:"consumer";a:1:{s:11:"primary key";a:1:{i:0;s:2:"id";}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'consumer.field_schema_data.description',
  'value' => 'a:1:{s:8:"consumer";a:1:{s:6:"fields";a:1:{s:11:"description";a:3:{s:4:"type";s:4:"text";s:4:"size";s:3:"big";s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'consumer.field_schema_data.id',
  'value' => 'a:1:{s:8:"consumer";a:1:{s:6:"fields";a:1:{s:2:"id";a:4:{s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:4:"size";s:6:"normal";s:8:"not null";b:1;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'consumer.field_schema_data.image',
  'value' => "a:1:{s:8:\"consumer\";a:3:{s:6:\"fields\";a:5:{s:16:\"image__target_id\";a:4:{s:11:\"description\";s:26:\"The ID of the file entity.\";s:4:\"type\";s:3:\"int\";s:8:\"unsigned\";b:1;s:8:\"not null\";b:0;}s:10:\"image__alt\";a:4:{s:11:\"description\";s:56:\"Alternative image text, for the image's 'alt' attribute.\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";i:512;s:8:\"not null\";b:0;}s:12:\"image__title\";a:4:{s:11:\"description\";s:52:\"Image title text, for the image's 'title' attribute.\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";i:1024;s:8:\"not null\";b:0;}s:12:\"image__width\";a:4:{s:11:\"description\";s:33:\"The width of the image in pixels.\";s:4:\"type\";s:3:\"int\";s:8:\"unsigned\";b:1;s:8:\"not null\";b:0;}s:13:\"image__height\";a:4:{s:11:\"description\";s:34:\"The height of the image in pixels.\";s:4:\"type\";s:3:\"int\";s:8:\"unsigned\";b:1;s:8:\"not null\";b:0;}}s:7:\"indexes\";a:1:{s:32:\"consumer_field__image__target_id\";a:1:{i:0;s:16:\"image__target_id\";}}s:12:\"foreign keys\";a:1:{s:32:\"consumer_field__image__target_id\";a:2:{s:5:\"table\";s:12:\"file_managed\";s:7:\"columns\";a:1:{s:16:\"image__target_id\";s:3:\"fid\";}}}}}",
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'consumer.field_schema_data.label',
  'value' => 'a:1:{s:8:"consumer";a:1:{s:6:"fields";a:1:{s:5:"label";a:4:{s:4:"type";s:7:"varchar";s:6:"length";i:255;s:6:"binary";b:0;s:8:"not null";b:0;}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'consumer.field_schema_data.owner_id',
  'value' => 'a:1:{s:8:"consumer";a:2:{s:6:"fields";a:1:{s:8:"owner_id";a:4:{s:11:"description";s:28:"The ID of the target entity.";s:4:"type";s:3:"int";s:8:"unsigned";b:1;s:8:"not null";b:0;}}s:7:"indexes";a:1:{s:35:"consumer_field__owner_id__target_id";a:1:{i:0;s:8:"owner_id";}}}}',
))
->values(array(
  'collection' => 'entity.storage_schema.sql',
  'name' => 'consumer.field_schema_data.uuid',
  'value' => 'a:1:{s:8:"consumer";a:2:{s:6:"fields";a:1:{s:4:"uuid";a:4:{s:4:"type";s:13:"varchar_ascii";s:6:"length";i:128;s:6:"binary";b:0;s:8:"not null";b:1;}}s:11:"unique keys";a:1:{s:27:"consumer_field__uuid__value";a:1:{i:0;s:4:"uuid";}}}}',
))
->execute();

$connection->schema()->createTable('consumer', array(
  'fields' => array(
    'id' => array(
      'type' => 'serial',
      'not null' => TRUE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'uuid' => array(
      'type' => 'varchar_ascii',
      'not null' => TRUE,
      'length' => '128',
    ),
    'owner_id' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'label' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '255',
    ),
    'description' => array(
      'type' => 'text',
      'not null' => FALSE,
      'size' => 'big',
    ),
    'image__target_id' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'image__alt' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '512',
    ),
    'image__title' => array(
      'type' => 'varchar',
      'not null' => FALSE,
      'length' => '1024',
    ),
    'image__width' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
    'image__height' => array(
      'type' => 'int',
      'not null' => FALSE,
      'size' => 'normal',
      'unsigned' => TRUE,
    ),
  ),
  'primary key' => array(
    'id',
  ),
  'unique keys' => array(
    'consumer_field__uuid__value' => array(
      'uuid',
    ),
  ),
  'indexes' => array(
    'consumer_field__owner_id__target_id' => array(
      'owner_id',
    ),
    'consumer_field__image__target_id' => array(
      'image__target_id',
    ),
  ),
  'mysql_character_set' => 'utf8mb4',
));
