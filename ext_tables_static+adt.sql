# TYPO3 Extension Manager dump 1.1
#
# Host: localhost    Database: t3local
#--------------------------------------------------------


#
# Table structure for table "tx_ecomconfigcodegenerator_domain_model_configuration"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_domain_model_configuration;
CREATE TABLE tx_ecomconfigcodegenerator_domain_model_configuration (
  uid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  content_object int(11) unsigned NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  prefix varchar(255) NOT NULL default '',
  suffix varchar(255) NOT NULL default '',
  part_groups int(11) unsigned NOT NULL default '0',
  pricing_enabled tinyint(1) unsigned NOT NULL default '0',
  pricing int(11) unsigned NOT NULL default '0',
  tstamp int(11) unsigned NOT NULL default '0',
  crdate int(11) unsigned NOT NULL default '0',
  cruser_id int(11) unsigned NOT NULL default '0',
  deleted tinyint(4) unsigned NOT NULL default '0',
  hidden tinyint(4) unsigned NOT NULL default '0',
  starttime int(11) unsigned NOT NULL default '0',
  endtime int(11) unsigned NOT NULL default '0',
  t3ver_oid int(11) NOT NULL default '0',
  t3ver_id int(11) NOT NULL default '0',
  t3ver_wsid int(11) NOT NULL default '0',
  t3ver_label varchar(255) NOT NULL default '',
  t3ver_state tinyint(4) NOT NULL default '0',
  t3ver_stage int(11) NOT NULL default '0',
  t3ver_count int(11) NOT NULL default '0',
  t3ver_tstamp int(11) NOT NULL default '0',
  t3ver_move_id int(11) NOT NULL default '0',
  sorting int(11) NOT NULL default '0',
  sys_language_uid int(11) NOT NULL default '0',
  l10n_parent int(11) NOT NULL default '0',
  l10n_diffsource mediumblob,
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid),
  KEY language (l10n_parent,sys_language_uid)
);


INSERT INTO tx_ecomconfigcodegenerator_domain_model_configuration VALUES ('1', '1', '1', 'Tab-Ex® 01', 'SM-T36', '', '10', '1', '0', '1441281159', '1441203634', '6', '0', '0', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:9:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:6:"prefix";N;s:6:"suffix";N;s:11:"part_groups";N;s:14:"enable_pricing";N;s:9:"starttime";N;s:7:"endtime";N;}');


#
# Table structure for table "tx_ecomconfigcodegenerator_domain_model_partgroup"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_domain_model_partgroup;
CREATE TABLE tx_ecomconfigcodegenerator_domain_model_partgroup (
  uid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  configuration int(11) unsigned NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  icon int(11) unsigned NOT NULL default '0',
  place_in_code int(11) NOT NULL default '0',
  prompt text NOT NULL,
  prompt_wrap int(11) NOT NULL default '0',
  settings int(11) NOT NULL default '0',
  parts int(11) unsigned NOT NULL default '0',
  default_part int(11) unsigned default '0',
  dependent_notes int(11) unsigned NOT NULL default '0',
  tstamp int(11) unsigned NOT NULL default '0',
  crdate int(11) unsigned NOT NULL default '0',
  cruser_id int(11) unsigned NOT NULL default '0',
  deleted tinyint(4) unsigned NOT NULL default '0',
  hidden tinyint(4) unsigned NOT NULL default '0',
  starttime int(11) unsigned NOT NULL default '0',
  endtime int(11) unsigned NOT NULL default '0',
  fe_group varchar(100) NOT NULL default '0',
  t3ver_oid int(11) NOT NULL default '0',
  t3ver_id int(11) NOT NULL default '0',
  t3ver_wsid int(11) NOT NULL default '0',
  t3ver_label varchar(255) NOT NULL default '',
  t3ver_state tinyint(4) NOT NULL default '0',
  t3ver_stage int(11) NOT NULL default '0',
  t3ver_count int(11) NOT NULL default '0',
  t3ver_tstamp int(11) NOT NULL default '0',
  t3ver_move_id int(11) NOT NULL default '0',
  sorting int(11) NOT NULL default '0',
  sys_language_uid int(11) NOT NULL default '0',
  l10n_parent int(11) NOT NULL default '0',
  l10n_diffsource mediumblob,
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid),
  KEY language (l10n_parent,sys_language_uid)
);


INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('1', '1', '1', 'Continent of usage', '0', '0', 'Please choose continent where device will be in use', '2', '7', '5', '0', '0', '1441284091', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('2', '1', '1', 'Country of Usage', '0', '30', 'Please choose country where device will be in use', '2', '7', '73', '0', '0', '1441284091', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '2', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('3', '1', '1', 'Fixed', '0', '20', '', '0', '6', '1', '79', '0', '1441806301', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '3', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('4', '1', '1', 'Certification', '0', '40', '', '0', '7', '4', '0', '0', '1441284091', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '4', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('5', '1', '1', 'Radio Module', '0', '10', '', '0', '7', '2', '0', '0', '1441284091', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '5', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('6', '1', '1', 'SIM Installation', '0', '50', '', '0', '7', '2', '0', '1', '1441284380', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '6', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('7', '1', '1', 'Camera', '0', '60', '', '0', '7', '2', '88', '0', '1441284091', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '7', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('8', '1', '1', 'microSD-Card', '0', '70', '', '0', '7', '2', '0', '1', '1441285060', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '8', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('9', '1', '1', 'Customization', '0', '80', 'Customization depends on certain MOQ.', '0', '7', '2', '0', '0', '1441284091', '1441203634', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '9', '0', '0', 'a:1:{s:14:"dependent_note";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_partgroup VALUES ('10', '1', '1', 'SLA', '0', '90', 'ecomprehensive is a worldwide service level agreement. We aim to partner with our customers in every sector of industry: not only before and during but also after the sale and when our products are in daily use.\r\nOur focus is that you consistently benefit from all our mobile devices each and every day. To ensure this, ecom‘s support and services are at your disposal with professional assistance and outstanding customer care throughout the world.', '0', '23', '2', '0', '0', '1441361724', '1441259376', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '265', '0', '0', 'a:1:{s:14:"dependent_note";N;}');


#
# Table structure for table "tx_ecomconfigcodegenerator_domain_model_part"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_domain_model_part;
CREATE TABLE tx_ecomconfigcodegenerator_domain_model_part (
  uid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  part_group int(11) unsigned NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  code_segment varchar(255) NOT NULL default '',
  image int(11) unsigned NOT NULL default '0',
  hint text NOT NULL,
  dependency int(11) unsigned default '0',
  pricing int(11) unsigned NOT NULL default '0',
  tstamp int(11) unsigned NOT NULL default '0',
  crdate int(11) unsigned NOT NULL default '0',
  cruser_id int(11) unsigned NOT NULL default '0',
  deleted tinyint(4) unsigned NOT NULL default '0',
  hidden tinyint(4) unsigned NOT NULL default '0',
  starttime int(11) unsigned NOT NULL default '0',
  endtime int(11) unsigned NOT NULL default '0',
  fe_group varchar(100) NOT NULL default '0',
  t3ver_oid int(11) NOT NULL default '0',
  t3ver_id int(11) NOT NULL default '0',
  t3ver_wsid int(11) NOT NULL default '0',
  t3ver_label varchar(255) NOT NULL default '',
  t3ver_state tinyint(4) NOT NULL default '0',
  t3ver_stage int(11) NOT NULL default '0',
  t3ver_count int(11) NOT NULL default '0',
  t3ver_tstamp int(11) NOT NULL default '0',
  t3ver_move_id int(11) NOT NULL default '0',
  sorting int(11) NOT NULL default '0',
  sys_language_uid int(11) NOT NULL default '0',
  l10n_parent int(11) NOT NULL default '0',
  l10n_diffsource mediumblob,
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid),
  KEY language (l10n_parent,sys_language_uid)
);


INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('1', '1', '1', 'Americas', '', '0', '', '0', '0', '1441282055', '1441203764', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('2', '1', '1', 'Europe', '', '0', '', '0', '0', '1441282055', '1441203764', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '2', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('3', '1', '1', 'Australia', '', '0', '', '0', '0', '1441282055', '1441203764', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '3', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('4', '1', '1', 'Asia', '', '0', '', '0', '0', '1441282055', '1441203764', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '4', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('5', '1', '1', 'Africa', '', '0', '', '0', '0', '1441282055', '1441203764', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '5', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('6', '1', '2', 'Argentina', 'ARG', '0', '', '1', '0', '1441257492', '1441203893', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '4352', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('7', '1', '2', 'Bolivia', 'BOL', '0', '', '1', '0', '1441257492', '1441203893', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '4608', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('8', '1', '2', 'Brazil', 'BRA', '0', '', '1', '0', '1441257492', '1441203893', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '4864', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('9', '1', '2', 'Canada', 'CAN', '0', '', '1', '0', '1441257492', '1441204088', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '5120', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('10', '1', '2', 'Columbia', 'COO', '0', '', '1', '0', '1441257492', '1441204088', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '5376', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('11', '1', '2', 'Mexico', 'TCE', '0', '', '1', '0', '1441257492', '1441204088', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '5632', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('12', '1', '2', 'Panama', 'TPA', '0', '', '1', '0', '1441257492', '1441204248', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '5888', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('13', '1', '2', 'Peru', 'PEO', '0', '', '1', '0', '1441257492', '1441204248', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '6144', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('14', '1', '2', 'USA', 'XAR', '0', '', '1', '0', '1441257492', '1441204248', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '6400', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('15', '1', '2', 'Venezuela', 'VEN', '0', '', '1', '0', '1441257492', '1441204248', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '6656', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('16', '1', '2', 'Austria', 'ATO', '0', '', '1', '0', '1441257492', '1441204248', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '6912', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('17', '1', '2', 'Belgium', 'BEL', '0', '', '1', '0', '1441258673', '1441257492', '0', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '7168', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('18', '1', '2', 'Bulgaria', 'BGR', '0', '', '1', '0', '1441258673', '1441257492', '0', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '7424', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('19', '1', '2', 'Croatia', 'HRV', '0', '', '1', '0', '1441258673', '1441257492', '0', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '7680', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('20', '1', '2', 'Cyprus', 'CYO', '0', '', '1', '0', '1441258673', '1441257492', '0', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '7936', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('21', '1', '2', 'Czech Republic', 'CZE', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '8192', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('22', '1', '2', 'Denmark', 'DNK', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '8448', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('23', '1', '2', 'Finland', 'FIN', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '8704', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('24', '1', '2', 'France', 'XEF', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '8960', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('25', '1', '2', 'Georgia', 'CAU', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '9216', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('26', '1', '2', 'Germany', 'DBT', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '9472', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('27', '1', '2', 'Greece', 'COS', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '9728', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('28', '1', '2', 'Hungary', 'HUN', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '9984', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('29', '1', '2', 'Italy', 'ITV', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '10240', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('30', '1', '2', 'Lativa', 'SEB', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '10496', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('31', '1', '2', 'Luxembourg', 'LUX', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '10752', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('32', '1', '2', 'Netherlands', 'PHN', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '11008', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('33', '1', '2', 'Norway', 'NOR', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '11264', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('34', '1', '2', 'Poland', 'XEO', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '11520', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('35', '1', '2', 'Portugal', 'TPH', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '11776', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('36', '1', '2', 'Romania', 'ROU', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '12032', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('37', '1', '2', 'Serbia', 'SEE', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '12288', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('38', '1', '2', 'Slovakia', 'XSK', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '12544', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('39', '1', '2', 'Slovenia', 'SIO', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '12800', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('40', '1', '2', 'Spain', 'PHE', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '13056', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('41', '1', '2', 'Sweden', 'NEE', '0', '', '1', '0', '1441258673', '1441257492', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '13312', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('42', '1', '2', 'Switzerland', 'AUT', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '13568', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('43', '1', '2', 'Turkey', 'TUR', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '13824', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('44', '1', '2', 'United Kingdom', 'BTU', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '14080', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('45', '1', '2', 'Australia', 'AUS', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '14336', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('46', '1', '2', 'New Zealand', 'NZL', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '14592', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('47', '1', '2', 'Azerbaijan', 'AZE', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '14848', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('48', '1', '2', 'Bahrain', 'BHR', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '15104', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('49', '1', '2', 'China', 'CHN', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '15360', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('50', '1', '2', 'India', 'IND', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '15616', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('51', '1', '2', 'Indonesia', 'XSE', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '15872', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('52', '1', '2', 'Israel', 'ILO', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '16128', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('53', '1', '2', 'Japan', 'JPN', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '16384', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('54', '1', '2', 'Kazakhstan', 'SKZ', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '16640', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('55', '1', '2', 'Kuwait', 'KWT', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '16896', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('56', '1', '2', 'Malaysia', 'XME', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '17152', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('57', '1', '2', 'Oman', 'OMN', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '17408', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('58', '1', '2', 'Pakistan', 'PAK', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '17664', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('59', '1', '2', 'Philippines', 'PHL', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '17920', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('60', '1', '2', 'Qatar', 'QAT', '0', '', '1', '0', '1441259204', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '18176', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('61', '1', '2', 'Russia', 'SER', '0', '', '1', '0', '1441260452', '1441258673', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '18432', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('62', '1', '2', 'Saudi Arabia', 'SAU', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '18688', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('63', '1', '2', 'Singapore', 'XSP', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '18944', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('64', '1', '2', 'South Korea', 'KOR', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '19200', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('65', '1', '2', 'Thailand', 'THL', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '19456', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('66', '1', '2', 'UAE', 'ARE', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '19712', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('67', '1', '2', 'Ukraine', 'SEK', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '19968', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('68', '1', '2', 'Uzbekistan', 'CAC', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '20224', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('69', '1', '2', 'Vietnam', 'VNM', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '20480', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('70', '1', '2', 'Yemen', 'YEM', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '20736', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('71', '1', '2', 'Algeria', 'DZA', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '20992', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('72', '1', '2', 'Egypt', 'EGY', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '21248', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('73', '1', '2', 'Kenia', 'KEN', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '21504', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('74', '1', '2', 'Libya', 'LBY', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '21760', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('75', '1', '2', 'Morocco', 'MAR', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '22016', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('76', '1', '2', 'Nigeria', 'NGA', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '22272', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('77', '1', '2', 'South Africa', 'XFA', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '22528', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('78', '1', '2', 'Tunisia', 'TUN', '0', '', '1', '0', '1441259204', '1441259204', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '22784', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('79', '1', '3', '-', 'NNGA', '0', '', '0', '0', '1441261240', '1441261230', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('80', '1', '4', 'Division 1 + Zone 1', 'DZ1', '0', '', '0', '0', '1441261350', '1441261350', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('81', '1', '4', 'Division 2 + Zone 2', 'DZ2', '0', '', '0', '0', '1441270534', '1441261350', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '2', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('95', '1', '4', 'Division 1', 'D01', '0', '', '0', '0', '1441270534', '1441270534', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '3', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('82', '1', '4', 'Division 2', 'D02', '0', '', '0', '0', '1441270534', '1441261350', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '4', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('83', '1', '5', 'WLAN only', '0', '0', '', '0', '0', '1441261421', '1441261421', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '2816', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('84', '1', '5', 'WWAN & WLAN', '5', '0', '', '0', '0', '1441261421', '1441261421', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '3072', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('85', '1', '6', 'No SIM installed', '0', '0', '', '1', '0', '1441284165', '1441261501', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('86', '1', '6', 'SIM installed', '1', '0', '', '1', '0', '1441284165', '1441261501', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '2', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('87', '1', '7', 'No camera', '0', '0', '', '1', '0', '1441271003', '1441261742', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('88', '1', '7', 'With camera', '1', '0', '', '0', '0', '1441270961', '1441261742', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '2', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('89', '1', '8', '16GB internal storage only', '0', '0', '', '0', '0', '1441285060', '1441261806', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('90', '1', '8', '16GB internal storage + additional 64 GB microSD-Card to be preinstalled', '1', '0', '', '0', '0', '1441285060', '1441261806', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '2', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('91', '1', '9', 'No customization', '00', '0', '', '0', '0', '1441261864', '1441261864', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '768', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('92', '1', '9', 'Interested in customization', '01', '0', '', '0', '0', '1441261864', '1441261864', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1024', '0', '0', 'a:11:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:5:"title";N;s:12:"code_segment";N;s:5:"image";N;s:10:"dependency";N;s:7:"pricing";N;s:4:"hint";N;s:9:"starttime";N;s:7:"endtime";N;s:8:"fe_group";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('93', '1', '10', 'No contract', '-SLA0', '0', '', '0', '0', '1441361724', '1441261908', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '1', '0', '0', 'a:1:{s:6:"hidden";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_part VALUES ('94', '1', '10', 'ecomprehensive 3 years', '-SLA3', '0', '', '0', '0', '1441361724', '1441261908', '6', '0', '0', '0', '0', '', '0', '0', '0', '', '0', '0', '0', '0', '0', '2', '0', '0', 'a:1:{s:6:"hidden";N;}');


#
# Table structure for table "tx_ecomconfigcodegenerator_domain_model_dependentnote"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_domain_model_dependentnote;
CREATE TABLE tx_ecomconfigcodegenerator_domain_model_dependentnote (
  uid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  part_group int(11) unsigned NOT NULL default '0',
  note text NOT NULL,
  note_wrap int(11) NOT NULL default '0',
  use_logical_and tinyint(1) unsigned NOT NULL default '0',
  dependent_parts int(11) unsigned NOT NULL default '0',
  tstamp int(11) unsigned NOT NULL default '0',
  crdate int(11) unsigned NOT NULL default '0',
  cruser_id int(11) unsigned NOT NULL default '0',
  deleted tinyint(4) unsigned NOT NULL default '0',
  hidden tinyint(4) unsigned NOT NULL default '0',
  t3ver_oid int(11) NOT NULL default '0',
  t3ver_id int(11) NOT NULL default '0',
  t3ver_wsid int(11) NOT NULL default '0',
  t3ver_label varchar(255) NOT NULL default '',
  t3ver_state tinyint(4) NOT NULL default '0',
  t3ver_stage int(11) NOT NULL default '0',
  t3ver_count int(11) NOT NULL default '0',
  t3ver_tstamp int(11) NOT NULL default '0',
  t3ver_move_id int(11) NOT NULL default '0',
  sys_language_uid int(11) NOT NULL default '0',
  l10n_parent int(11) NOT NULL default '0',
  l10n_diffsource mediumblob,
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid),
  KEY language (l10n_parent,sys_language_uid)
);


INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependentnote VALUES ('1', '1', '6', 'Please consider that the SIM-Card is only accessible by ecom service center.<br />To activate and use WWAN functionality you need to provide ecom with the SIM-Card(s) beforehand. For shipping process and supply note see here.', '3', '0', '3', '1441284696', '1441284696', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '0', '0', 'a:6:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:4:"note";N;s:9:"note_wrap";N;s:15:"dependent_parts";N;s:15:"use_logical_and";N;}');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependentnote VALUES ('2', '1', '8', 'Please notice that the installation is part of the manufacturing process and the SD-Card is not accessible after the assembly of the tablet.', '2', '0', '2', '1441285060', '1441285060', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '0', '0', 'a:6:{s:16:"sys_language_uid";N;s:6:"hidden";N;s:4:"note";N;s:9:"note_wrap";N;s:15:"dependent_parts";N;s:15:"use_logical_and";N;}');


#
# Table structure for table "tx_ecomconfigcodegenerator_domain_model_currency"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_domain_model_currency;
CREATE TABLE tx_ecomconfigcodegenerator_domain_model_currency (
  uid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  iso_code varchar(255) NOT NULL default '',
  exchange double(11,2) NOT NULL default '0.00',
  symbol varchar(255) NOT NULL default '',
  region varchar(255) NOT NULL default '',
  ll_reference varchar(255) NOT NULL default '',
  flag int(11) unsigned NOT NULL default '0',
  settings int(11) NOT NULL default '0',
  tstamp int(11) unsigned NOT NULL default '0',
  crdate int(11) unsigned NOT NULL default '0',
  cruser_id int(11) unsigned NOT NULL default '0',
  deleted tinyint(4) unsigned NOT NULL default '0',
  hidden tinyint(4) unsigned NOT NULL default '0',
  t3ver_oid int(11) NOT NULL default '0',
  t3ver_id int(11) NOT NULL default '0',
  t3ver_wsid int(11) NOT NULL default '0',
  t3ver_label varchar(255) NOT NULL default '',
  t3ver_state tinyint(4) NOT NULL default '0',
  t3ver_stage int(11) NOT NULL default '0',
  t3ver_count int(11) NOT NULL default '0',
  t3ver_tstamp int(11) NOT NULL default '0',
  t3ver_move_id int(11) NOT NULL default '0',
  sorting int(11) NOT NULL default '0',
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);


INSERT INTO tx_ecomconfigcodegenerator_domain_model_currency VALUES ('1', '0', 'Euro', 'EUR', '1.00', '€', 'Europe', '', '0', '5', '1441289302', '1441288043', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '256');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_currency VALUES ('2', '0', 'Schweizerfranken / franc suisse / franco svizzero', 'CHF', '1.08', 'SFr.', 'Switzerland', '', '0', '4', '1441289379', '1441289379', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '512');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_currency VALUES ('3', '0', 'Pound Sterling', 'GBP', '0.73', '£', 'United Kingdom', '', '0', '4', '1441289433', '1441289433', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '768');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_currency VALUES ('4', '0', 'United States Dollar', 'USD', '1.11', '$', 'United States', '', '0', '12', '1441289488', '1441289488', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '1024');


#
# Table structure for table "tx_ecomconfigcodegenerator_domain_model_dependency"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_domain_model_dependency;
CREATE TABLE tx_ecomconfigcodegenerator_domain_model_dependency (
  uid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  part int(11) unsigned NOT NULL default '0',
  mode int(11) NOT NULL default '0',
  part_groups int(11) unsigned NOT NULL default '0',
  parts int(11) unsigned NOT NULL default '0',
  tstamp int(11) unsigned NOT NULL default '0',
  crdate int(11) unsigned NOT NULL default '0',
  cruser_id int(11) unsigned NOT NULL default '0',
  deleted tinyint(4) unsigned NOT NULL default '0',
  hidden tinyint(4) unsigned NOT NULL default '0',
  t3ver_oid int(11) NOT NULL default '0',
  t3ver_id int(11) NOT NULL default '0',
  t3ver_wsid int(11) NOT NULL default '0',
  t3ver_label varchar(255) NOT NULL default '',
  t3ver_state tinyint(4) NOT NULL default '0',
  t3ver_stage int(11) NOT NULL default '0',
  t3ver_count int(11) NOT NULL default '0',
  t3ver_tstamp int(11) NOT NULL default '0',
  t3ver_move_id int(11) NOT NULL default '0',
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);


INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('1', '1', '6', '1', '1', '1', '1441257983', '1441203893', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('2', '1', '7', '1', '1', '1', '1441257983', '1441203893', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('3', '1', '8', '1', '1', '1', '1441257983', '1441203893', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('4', '1', '9', '1', '1', '1', '1441257983', '1441204088', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('5', '1', '10', '1', '1', '1', '1441257983', '1441204088', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('6', '1', '11', '1', '1', '1', '1441257983', '1441204088', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('7', '1', '12', '1', '1', '1', '1441257983', '1441204248', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('8', '1', '13', '1', '1', '1', '1441257983', '1441204248', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('9', '1', '14', '1', '1', '1', '1441257983', '1441204248', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('10', '1', '15', '1', '1', '1', '1441257983', '1441204248', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('11', '1', '16', '1', '1', '1', '1441257983', '1441204248', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('12', '1', '17', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('13', '1', '18', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('14', '1', '19', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('15', '1', '20', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('16', '1', '21', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('17', '1', '22', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('18', '1', '23', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('19', '1', '24', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('20', '1', '25', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('21', '1', '26', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('22', '1', '27', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('23', '1', '28', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('24', '1', '29', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('25', '1', '30', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('26', '1', '31', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('27', '1', '32', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('28', '1', '33', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('29', '1', '34', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('30', '1', '35', '1', '1', '1', '1441257983', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('31', '1', '36', '1', '1', '1', '1441260952', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('32', '1', '37', '1', '1', '1', '1441260952', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('33', '1', '38', '1', '1', '1', '1441260952', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('34', '1', '39', '1', '1', '1', '1441260952', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('35', '1', '40', '1', '1', '1', '1441260952', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('36', '1', '41', '1', '1', '1', '1441260952', '1441257492', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('37', '1', '42', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('38', '1', '43', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('39', '1', '44', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('40', '1', '45', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('41', '1', '46', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('42', '1', '47', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('43', '1', '48', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('44', '1', '49', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('45', '1', '50', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('46', '1', '51', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('47', '1', '52', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('48', '1', '53', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('49', '1', '54', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('50', '1', '55', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('51', '1', '56', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('52', '1', '57', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('53', '1', '58', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('54', '1', '59', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('55', '1', '60', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('56', '1', '61', '1', '1', '1', '1441260952', '1441258673', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('57', '1', '62', '1', '1', '1', '1441260952', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('58', '1', '63', '1', '1', '1', '1441260952', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('59', '1', '64', '1', '1', '1', '1441260952', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('60', '1', '65', '1', '1', '1', '1441260952', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('61', '1', '66', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('62', '1', '67', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('63', '1', '68', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('64', '1', '69', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('65', '1', '70', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('66', '1', '71', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('67', '1', '72', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('68', '1', '73', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('69', '1', '74', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('70', '1', '75', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('71', '1', '76', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('72', '1', '77', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('73', '1', '78', '1', '1', '1', '1441261086', '1441260452', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('74', '1', '85', '0', '2', '3', '1441270624', '1441261501', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('75', '1', '86', '1', '2', '3', '1441270571', '1441261501', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');
INSERT INTO tx_ecomconfigcodegenerator_domain_model_dependency VALUES ('76', '1', '87', '1', '1', '2', '1441270985', '1441270949', '6', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0');


#
# Table structure for table "tx_ecomconfigcodegenerator_dependentnote_part_mm"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_dependentnote_part_mm;
CREATE TABLE tx_ecomconfigcodegenerator_dependentnote_part_mm (
  uid_local int(11) unsigned NOT NULL default '0',
  uid_foreign int(11) unsigned NOT NULL default '0',
  sorting int(11) unsigned NOT NULL default '0',
  sorting_foreign int(11) unsigned NOT NULL default '0',
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


INSERT INTO tx_ecomconfigcodegenerator_dependentnote_part_mm VALUES ('1', '95', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependentnote_part_mm VALUES ('1', '80', '2', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependentnote_part_mm VALUES ('1', '84', '3', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependentnote_part_mm VALUES ('2', '95', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependentnote_part_mm VALUES ('2', '80', '2', '0');


#
# Table structure for table "tx_ecomconfigcodegenerator_dependency_partgroup_mm"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_dependency_partgroup_mm;
CREATE TABLE tx_ecomconfigcodegenerator_dependency_partgroup_mm (
  uid_local int(11) unsigned NOT NULL default '0',
  uid_foreign int(11) unsigned NOT NULL default '0',
  sorting int(11) unsigned NOT NULL default '0',
  sorting_foreign int(11) unsigned NOT NULL default '0',
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('1', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('2', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('3', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('4', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('5', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('6', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('7', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('8', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('9', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('10', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('11', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('12', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('13', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('14', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('15', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('16', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('17', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('18', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('19', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('20', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('21', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('22', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('23', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('24', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('25', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('26', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('27', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('28', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('29', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('30', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('31', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('32', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('33', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('34', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('35', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('36', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('37', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('38', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('39', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('40', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('41', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('42', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('43', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('44', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('45', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('46', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('47', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('48', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('49', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('50', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('51', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('52', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('53', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('54', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('55', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('56', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('57', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('58', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('59', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('60', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('61', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('62', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('63', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('64', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('65', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('66', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('67', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('68', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('69', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('70', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('71', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('72', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('73', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('74', '5', '2', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('75', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('75', '5', '2', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('74', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_partgroup_mm VALUES ('76', '4', '1', '0');


#
# Table structure for table "tx_ecomconfigcodegenerator_dependency_part_mm"
#
DROP TABLE IF EXISTS tx_ecomconfigcodegenerator_dependency_part_mm;
CREATE TABLE tx_ecomconfigcodegenerator_dependency_part_mm (
  uid_local int(11) unsigned NOT NULL default '0',
  uid_foreign int(11) unsigned NOT NULL default '0',
  sorting int(11) unsigned NOT NULL default '0',
  sorting_foreign int(11) unsigned NOT NULL default '0',
  KEY uid_local (uid_local),
  KEY uid_foreign (uid_foreign)
);


INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('1', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('2', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('3', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('4', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('5', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('6', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('7', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('8', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('9', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('10', '1', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('11', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('12', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('13', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('14', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('15', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('16', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('17', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('18', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('19', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('20', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('21', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('22', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('23', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('24', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('25', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('26', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('27', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('28', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('29', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('30', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('31', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('32', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('33', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('34', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('35', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('36', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('37', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('38', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('39', '2', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('40', '3', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('41', '3', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('42', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('43', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('44', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('45', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('46', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('47', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('48', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('49', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('50', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('51', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('52', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('53', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('54', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('55', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('56', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('57', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('58', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('59', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('60', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('61', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('62', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('63', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('64', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('65', '4', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('66', '5', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('67', '5', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('68', '5', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('69', '5', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('70', '5', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('71', '5', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('72', '5', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('73', '5', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('74', '84', '3', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('75', '80', '2', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('74', '80', '2', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('75', '95', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('75', '84', '3', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('74', '95', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('76', '95', '1', '0');
INSERT INTO tx_ecomconfigcodegenerator_dependency_part_mm VALUES ('76', '80', '2', '0');