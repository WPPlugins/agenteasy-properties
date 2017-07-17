<?php
/*
Plugin Name: AgentEasy Properties
Description:  Property Search and Listing Manager. 
Version: 1.0.4
Plugin URI: 
Author: AgentEasy
Author URI: http://agenteasy.com
*/


/*  
	Copyright 2012  AgentEasy 
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; If not, see <http://www.gnu.org/licenses/>.
*/


/**
* ----------------------------------------------------------------------------------------------------------------------
* Enable & Start WP Session
* ----------------------------------------------------------------------------------------------------------------------
*/

	function cp_admin_init() {
		if (!session_id()) session_start();
	}
	
	add_action('init', 'cp_admin_init');
	

/**
* ----------------------------------------------------------------------------------------------------------------------
* Set Global variables
* ----------------------------------------------------------------------------------------------------------------------
*/

	/** wp global vars */
	global $wpdb;
	
	/** Max Execution Time */
	if(!ini_get('safe_mode')) {
		set_time_limit(0);
		ini_set('max_execution_time', '3600'); // 3600 seconds =  1 hour 
	}
	
	/** unlimited memory limit */
	ini_set('memory_limit', '-1'); 
	
	/** Plugin Version */
	define('AEM_PLUGIN_Version', "1.0");
	
	/** Plugin DB Table */
	define('AEM_PLUGIN_DB_Table', $wpdb->prefix . "aem_properties");
	
	/** Plugin Folder name */
	if (!defined('AEM_PLUGIN_FOLDER')) {
		define('AEM_PLUGIN_FOLDER', 'agenteasy-properties');
	}

	/** Plugin Title/Name */
	if (!defined('AEM_PLUGIN_TITLE')) {
		#define('AEM_PLUGIN_TITLE', 'AgentEasy Properties');
		define('AEM_PLUGIN_TITLE', 'Property Search');
	}
	
	/** Plugin Full URL */
	if (!defined('AEM_PLUGIN_URL')) {
		define('AEM_PLUGIN_URL', get_option('siteurl').'/wp-content/plugins/'.AEM_PLUGIN_FOLDER);
	}

	/** Plugin Full DIR Path */
	if (!defined('AEM_PLUGIN_PATH')) {
		define('AEM_PLUGIN_PATH', 'wp-content/plugins/'.AEM_PLUGIN_FOLDER);
	}

	/** Plugin Options */
	
	// set here the url where baycentric-web-service.php file is located 
	$baycentric_web_service = 'http://agenteasy.com/ext/property-search/baycentric-web-service.php'; 
		
	if (!defined('AEM_PLUGIN_OPTION_XML_PARSER')) {
		define('AEM_PLUGIN_OPTION_XML_PARSER', $baycentric_web_service.'?xml='); 
	}

	if (!defined('AEM_PLUGIN_OPTION_API_KEY')) {
		define('AEM_PLUGIN_OPTION_API_KEY', '');
	}

	if (!defined('AEM_PLUGIN_OPTION_XML_LIMIT')) {
		define('AEM_PLUGIN_OPTION_XML_LIMIT', 30);
	}

	if (!defined('AEM_PLUGIN_OPTION_XML_AGENT')) {
		define('AEM_PLUGIN_OPTION_XML_AGENT', 0);
	}

	if (!defined('AEM_PLUGIN_OPTION_XML_AGENT_ENABLE')) {
		define('AEM_PLUGIN_OPTION_XML_AGENT_ENABLE', 'No');
	}

	if (!defined('AEM_PLUGIN_OPTION_XML_STATUS')) {
		define('AEM_PLUGIN_OPTION_XML_STATUS', 'active,pending');
	}
	
	if (!defined('AEM_PLUGIN_OPTION_XML_NEIGHBORHOODS')) {
		
		$plugin_aem_option_xml_neighborhoods = array();
				
		$plugin_aem_option_xml_neighborhoods[1010] = array('enable' => 'Yes', 'id' => 1010, 'district' => 'District 1', 'title' => 'Central Richmond');
		$plugin_aem_option_xml_neighborhoods[1020] = array('enable' => 'Yes', 'id' => 1020, 'district' => 'District 1', 'title' => 'Inner Richmond');
		$plugin_aem_option_xml_neighborhoods[1030] = array('enable' => 'Yes', 'id' => 1030, 'district' => 'District 1', 'title' => 'Jordan Pk/Laurel');
		$plugin_aem_option_xml_neighborhoods[1040] = array('enable' => 'Yes', 'id' => 1040, 'district' => 'District 1', 'title' => 'Lake Street');
		$plugin_aem_option_xml_neighborhoods[1050] = array('enable' => 'Yes', 'id' => 1050, 'district' => 'District 1', 'title' => 'Outer Richmond');
		$plugin_aem_option_xml_neighborhoods[1060] = array('enable' => 'Yes', 'id' => 1060, 'district' => 'District 1', 'title' => 'Sea Cliff');
		$plugin_aem_option_xml_neighborhoods[1070] = array('enable' => 'Yes', 'id' => 1070, 'district' => 'District 1', 'title' => 'Lone Mountain');
		
		$plugin_aem_option_xml_neighborhoods[2010] = array('enable' => 'Yes', 'id' => 2010, 'district' => 'District 2', 'title' => 'Golden Gate Hts');
		$plugin_aem_option_xml_neighborhoods[2020] = array('enable' => 'Yes', 'id' => 2020, 'district' => 'District 2', 'title' => 'Outer Parkside');
		$plugin_aem_option_xml_neighborhoods[2030] = array('enable' => 'Yes', 'id' => 2030, 'district' => 'District 2', 'title' => 'Outer Sunset');
		$plugin_aem_option_xml_neighborhoods[2040] = array('enable' => 'Yes', 'id' => 2040, 'district' => 'District 2', 'title' => 'Parkside');
		$plugin_aem_option_xml_neighborhoods[2050] = array('enable' => 'Yes', 'id' => 2050, 'district' => 'District 2', 'title' => 'Central Sunset');
		$plugin_aem_option_xml_neighborhoods[2060] = array('enable' => 'Yes', 'id' => 2060, 'district' => 'District 2', 'title' => 'Inner Sunset');
		$plugin_aem_option_xml_neighborhoods[2070] = array('enable' => 'Yes', 'id' => 2070, 'district' => 'District 2', 'title' => 'Inner Parkside');
		
		$plugin_aem_option_xml_neighborhoods[3010] = array('enable' => 'Yes', 'id' => 3010, 'district' => 'District 3', 'title' => 'Lake Shore');
		$plugin_aem_option_xml_neighborhoods[3020] = array('enable' => 'Yes', 'id' => 3020, 'district' => 'District 3', 'title' => 'Merced Heights');
		$plugin_aem_option_xml_neighborhoods[3030] = array('enable' => 'Yes', 'id' => 3030, 'district' => 'District 3', 'title' => 'Pine Lake Park');
		$plugin_aem_option_xml_neighborhoods[3040] = array('enable' => 'Yes', 'id' => 3040, 'district' => 'District 3', 'title' => 'Stonestown');
		$plugin_aem_option_xml_neighborhoods[3050] = array('enable' => 'Yes', 'id' => 3050, 'district' => 'District 3', 'title' => 'Lakeside');
		$plugin_aem_option_xml_neighborhoods[3060] = array('enable' => 'Yes', 'id' => 3060, 'district' => 'District 3', 'title' => 'Merced Manor');
		$plugin_aem_option_xml_neighborhoods[3070] = array('enable' => 'Yes', 'id' => 3070, 'district' => 'District 3', 'title' => 'Ingleside Heights');
		$plugin_aem_option_xml_neighborhoods[3080] = array('enable' => 'Yes', 'id' => 3080, 'district' => 'District 3', 'title' => 'Ingleside');
		$plugin_aem_option_xml_neighborhoods[3090] = array('enable' => 'Yes', 'id' => 3090, 'district' => 'District 3', 'title' => 'Oceanview');
		
		$plugin_aem_option_xml_neighborhoods[4010] = array('enable' => 'Yes', 'id' => 4010, 'district' => 'District 4', 'title' => 'Balboa Terrace');
		$plugin_aem_option_xml_neighborhoods[4020] = array('enable' => 'Yes', 'id' => 4020, 'district' => 'District 4', 'title' => 'Diamond Heights');
		$plugin_aem_option_xml_neighborhoods[4030] = array('enable' => 'Yes', 'id' => 4030, 'district' => 'District 4', 'title' => 'Forest Hill');
		$plugin_aem_option_xml_neighborhoods[4040] = array('enable' => 'Yes', 'id' => 4040, 'district' => 'District 4', 'title' => 'Forest Knolls');
		$plugin_aem_option_xml_neighborhoods[4050] = array('enable' => 'Yes', 'id' => 4050, 'district' => 'District 4', 'title' => 'Ingleside Terrace');
		$plugin_aem_option_xml_neighborhoods[4060] = array('enable' => 'Yes', 'id' => 4060, 'district' => 'District 4', 'title' => 'Midtown Terrace');
		$plugin_aem_option_xml_neighborhoods[4070] = array('enable' => 'Yes', 'id' => 4070, 'district' => 'District 4', 'title' => 'St. Francis Wood');
		$plugin_aem_option_xml_neighborhoods[4080] = array('enable' => 'Yes', 'id' => 4080, 'district' => 'District 4', 'title' => 'Miraloma Park');
		$plugin_aem_option_xml_neighborhoods[4090] = array('enable' => 'Yes', 'id' => 4090, 'district' => 'District 4', 'title' => 'Forest Hill Ext');
		$plugin_aem_option_xml_neighborhoods[4100] = array('enable' => 'Yes', 'id' => 4100, 'district' => 'District 4', 'title' => 'Sherwood Forest');
		$plugin_aem_option_xml_neighborhoods[4110] = array('enable' => 'Yes', 'id' => 4110, 'district' => 'District 4', 'title' => 'Monterey Heights');
		$plugin_aem_option_xml_neighborhoods[4120] = array('enable' => 'Yes', 'id' => 4120, 'district' => 'District 4', 'title' => 'Mount Davidson Manor');
		$plugin_aem_option_xml_neighborhoods[4130] = array('enable' => 'Yes', 'id' => 4130, 'district' => 'District 4', 'title' => 'Westwood Highlands');
		$plugin_aem_option_xml_neighborhoods[4140] = array('enable' => 'Yes', 'id' => 4140, 'district' => 'District 4', 'title' => 'Westwood Park');
		$plugin_aem_option_xml_neighborhoods[4150] = array('enable' => 'Yes', 'id' => 4150, 'district' => 'District 4', 'title' => 'Sunnyside');
		$plugin_aem_option_xml_neighborhoods[4160] = array('enable' => 'Yes', 'id' => 4160, 'district' => 'District 4', 'title' => 'West Portal');
		
		$plugin_aem_option_xml_neighborhoods[5010] = array('enable' => 'Yes', 'id' => 5010, 'district' => 'District 5', 'title' => 'Glen Park');
		$plugin_aem_option_xml_neighborhoods[5020] = array('enable' => 'Yes', 'id' => 5020, 'district' => 'District 5', 'title' => 'Haight Ashbury');
		$plugin_aem_option_xml_neighborhoods[5030] = array('enable' => 'Yes', 'id' => 5030, 'district' => 'District 5', 'title' => 'Noe Valley');
		$plugin_aem_option_xml_neighborhoods[5040] = array('enable' => 'Yes', 'id' => 5040, 'district' => 'District 5', 'title' => 'Twin Peaks');
		$plugin_aem_option_xml_neighborhoods[5050] = array('enable' => 'Yes', 'id' => 5050, 'district' => 'District 5', 'title' => 'Cole Valley / Parnassus Hts');
		$plugin_aem_option_xml_neighborhoods[5060] = array('enable' => 'Yes', 'id' => 5060, 'district' => 'District 5', 'title' => 'Buena Vista / Ashbury Hts');
		$plugin_aem_option_xml_neighborhoods[5070] = array('enable' => 'Yes', 'id' => 5070, 'district' => 'District 5', 'title' => 'Corona Heights');
		$plugin_aem_option_xml_neighborhoods[5080] = array('enable' => 'Yes', 'id' => 5080, 'district' => 'District 5', 'title' => 'Clarendon Heights');
		$plugin_aem_option_xml_neighborhoods[5090] = array('enable' => 'Yes', 'id' => 5090, 'district' => 'District 5', 'title' => 'Duboce Triangle');
		$plugin_aem_option_xml_neighborhoods[5100] = array('enable' => 'Yes', 'id' => 5100, 'district' => 'District 5', 'title' => 'Eureka Valley / Dolores');
		$plugin_aem_option_xml_neighborhoods[5110] = array('enable' => 'Yes', 'id' => 5110, 'district' => 'District 5', 'title' => 'Mission Dolores');
		
		$plugin_aem_option_xml_neighborhoods[6010] = array('enable' => 'Yes', 'id' => 6010, 'district' => 'District 6', 'title' => 'Anza Vista');
		$plugin_aem_option_xml_neighborhoods[6020] = array('enable' => 'Yes', 'id' => 6020, 'district' => 'District 6', 'title' => 'Hayes Valley');
		$plugin_aem_option_xml_neighborhoods[6030] = array('enable' => 'Yes', 'id' => 6030, 'district' => 'District 6', 'title' => 'Lwr Pacific Hts');
		$plugin_aem_option_xml_neighborhoods[6040] = array('enable' => 'Yes', 'id' => 6040, 'district' => 'District 6', 'title' => 'Western Addition');
		$plugin_aem_option_xml_neighborhoods[6050] = array('enable' => 'Yes', 'id' => 6050, 'district' => 'District 6', 'title' => 'Alamo Square');
		$plugin_aem_option_xml_neighborhoods[6060] = array('enable' => 'Yes', 'id' => 6060, 'district' => 'District 6', 'title' => 'North Panhandle');
		
		$plugin_aem_option_xml_neighborhoods[7010] = array('enable' => 'Yes', 'id' => 7010, 'district' => 'District 7', 'title' => 'Marina');
		$plugin_aem_option_xml_neighborhoods[7020] = array('enable' => 'Yes', 'id' => 7020, 'district' => 'District 7', 'title' => 'Pacific Heights');
		$plugin_aem_option_xml_neighborhoods[7030] = array('enable' => 'Yes', 'id' => 7030, 'district' => 'District 7', 'title' => 'Presidio Heights');
		$plugin_aem_option_xml_neighborhoods[7040] = array('enable' => 'Yes', 'id' => 7040, 'district' => 'District 7', 'title' => 'Cow Hollow');
		
		$plugin_aem_option_xml_neighborhoods[8010] = array('enable' => 'Yes', 'id' => 8010, 'district' => 'District 8', 'title' => 'Downtown');
		$plugin_aem_option_xml_neighborhoods[8020] = array('enable' => 'Yes', 'id' => 8020, 'district' => 'District 8', 'title' => 'Financial District / Barbary Coast');
		$plugin_aem_option_xml_neighborhoods[8030] = array('enable' => 'Yes', 'id' => 8030, 'district' => 'District 8', 'title' => 'Nob Hill');
		$plugin_aem_option_xml_neighborhoods[8040] = array('enable' => 'Yes', 'id' => 8040, 'district' => 'District 8', 'title' => 'North Beach');
		$plugin_aem_option_xml_neighborhoods[8050] = array('enable' => 'Yes', 'id' => 8050, 'district' => 'District 8', 'title' => 'Russian Hill');
		$plugin_aem_option_xml_neighborhoods[8060] = array('enable' => 'Yes', 'id' => 8060, 'district' => 'District 8', 'title' => 'Van Ness/Civ Ctr');
		$plugin_aem_option_xml_neighborhoods[8070] = array('enable' => 'Yes', 'id' => 8070, 'district' => 'District 8', 'title' => 'Telegraph Hill');
		$plugin_aem_option_xml_neighborhoods[8080] = array('enable' => 'Yes', 'id' => 8080, 'district' => 'District 8', 'title' => 'North Waterfront');
		$plugin_aem_option_xml_neighborhoods[8090] = array('enable' => 'Yes', 'id' => 8090, 'district' => 'District 8', 'title' => 'Tenderloin');
		
		$plugin_aem_option_xml_neighborhoods[9010] = array('enable' => 'Yes', 'id' => 9010, 'district' => 'District 9', 'title' => 'Bernal Heights');
		$plugin_aem_option_xml_neighborhoods[9020] = array('enable' => 'Yes', 'id' => 9020, 'district' => 'District 9', 'title' => 'Inner Mission');
		$plugin_aem_option_xml_neighborhoods[9030] = array('enable' => 'Yes', 'id' => 9030, 'district' => 'District 9', 'title' => 'Mission Bay');
		$plugin_aem_option_xml_neighborhoods[9040] = array('enable' => 'Yes', 'id' => 9040, 'district' => 'District 9', 'title' => 'Potrero Hill');
		$plugin_aem_option_xml_neighborhoods[9050] = array('enable' => 'Yes', 'id' => 9050, 'district' => 'District 9', 'title' => 'South of Market');
		$plugin_aem_option_xml_neighborhoods[9060] = array('enable' => 'Yes', 'id' => 9060, 'district' => 'District 9', 'title' => 'South Beach');
		$plugin_aem_option_xml_neighborhoods[9070] = array('enable' => 'Yes', 'id' => 9070, 'district' => 'District 9', 'title' => 'Ctrl Waterfront / Dogpatch');
		$plugin_aem_option_xml_neighborhoods[9080] = array('enable' => 'Yes', 'id' => 9080, 'district' => 'District 9', 'title' => 'Yerba Buena');
		
		$plugin_aem_option_xml_neighborhoods[10010] = array('enable' => 'Yes', 'id' => 10010, 'district' => 'District 10', 'title' => 'Bayview');
		$plugin_aem_option_xml_neighborhoods[10020] = array('enable' => 'Yes', 'id' => 10020, 'district' => 'District 10', 'title' => 'Crocker Amazon');
		$plugin_aem_option_xml_neighborhoods[10030] = array('enable' => 'Yes', 'id' => 10030, 'district' => 'District 10', 'title' => 'Excelsior');
		$plugin_aem_option_xml_neighborhoods[10040] = array('enable' => 'Yes', 'id' => 10040, 'district' => 'District 10', 'title' => 'Outer Mission');
		$plugin_aem_option_xml_neighborhoods[10050] = array('enable' => 'Yes', 'id' => 10050, 'district' => 'District 10', 'title' => 'Visitacion Valley');
		$plugin_aem_option_xml_neighborhoods[10060] = array('enable' => 'Yes', 'id' => 10060, 'district' => 'District 10', 'title' => 'Portola');
		$plugin_aem_option_xml_neighborhoods[10070] = array('enable' => 'Yes', 'id' => 10070, 'district' => 'District 10', 'title' => 'Silver Terrace');
		$plugin_aem_option_xml_neighborhoods[10080] = array('enable' => 'Yes', 'id' => 10080, 'district' => 'District 10', 'title' => 'Mission Terrace');
		$plugin_aem_option_xml_neighborhoods[10090] = array('enable' => 'Yes', 'id' => 10090, 'district' => 'District 10', 'title' => 'Hunters Point');
		$plugin_aem_option_xml_neighborhoods[10100] = array('enable' => 'Yes', 'id' => 10100, 'district' => 'District 10', 'title' => 'Bayview Heights');
		$plugin_aem_option_xml_neighborhoods[10110] = array('enable' => 'Yes', 'id' => 10110, 'district' => 'District 10', 'title' => 'Candlestick Point');
		$plugin_aem_option_xml_neighborhoods[10120] = array('enable' => 'Yes', 'id' => 10120, 'district' => 'District 10', 'title' => 'Little Hollywood');
		
		$plugin_aem_option_xml_neighborhoods[11010] = array('enable' => 'Yes', 'id' => 11010, 'district' => 'District 11', 'title' => 'Original Daly City');
		$plugin_aem_option_xml_neighborhoods[11020] = array('enable' => 'Yes', 'id' => 11020, 'district' => 'District 11', 'title' => 'Serramonte');
		$plugin_aem_option_xml_neighborhoods[11030] = array('enable' => 'Yes', 'id' => 11030, 'district' => 'District 11', 'title' => 'Southern Hills');
		$plugin_aem_option_xml_neighborhoods[11040] = array('enable' => 'Yes', 'id' => 11040, 'district' => 'District 11', 'title' => 'Westlake #1 / Olympic');
		$plugin_aem_option_xml_neighborhoods[11050] = array('enable' => 'Yes', 'id' => 11050, 'district' => 'District 11', 'title' => 'Westlake Highlands');
		$plugin_aem_option_xml_neighborhoods[11060] = array('enable' => 'Yes', 'id' => 11060, 'district' => 'District 11', 'title' => 'Westlake Knolls');
		$plugin_aem_option_xml_neighborhoods[11070] = array('enable' => 'Yes', 'id' => 11070, 'district' => 'District 11', 'title' => 'Broadmoor');
		$plugin_aem_option_xml_neighborhoods[11080] = array('enable' => 'Yes', 'id' => 11080, 'district' => 'District 11', 'title' => 'Westlake Terrace');
		$plugin_aem_option_xml_neighborhoods[11090] = array('enable' => 'Yes', 'id' => 11090, 'district' => 'District 11', 'title' => 'St. Francis Hts');
		$plugin_aem_option_xml_neighborhoods[11100] = array('enable' => 'Yes', 'id' => 11000, 'district' => 'District 11', 'title' => 'Westlake Palisades');
		$plugin_aem_option_xml_neighborhoods[11110] = array('enable' => 'Yes', 'id' => 11110, 'district' => 'District 11', 'title' => 'Blossom Valley');
		$plugin_aem_option_xml_neighborhoods[11120] = array('enable' => 'Yes', 'id' => 11120, 'district' => 'District 11', 'title' => 'Crown Colony');
		$plugin_aem_option_xml_neighborhoods[11130] = array('enable' => 'Yes', 'id' => 11130, 'district' => 'District 11', 'title' => 'Colma');
		$plugin_aem_option_xml_neighborhoods[11140] = array('enable' => 'Yes', 'id' => 11140, 'district' => 'District 11', 'title' => 'Brisbane');
		$plugin_aem_option_xml_neighborhoods[11150] = array('enable' => 'Yes', 'id' => 11150, 'district' => 'District 11', 'title' => 'Bayridge / Linda Vista');
		
		if(count($plugin_aem_option_xml_neighborhoods) > 0) {
			$plugin_aem_option_xml_neighborhoods_serialize = serialize($plugin_aem_option_xml_neighborhoods);
			$plugin_aem_option_xml_neighborhoods_serialize = htmlentities($plugin_aem_option_xml_neighborhoods_serialize,ENT_QUOTES);
		} else {
			$plugin_aem_option_xml_neighborhoods_serialize = "";
		}	
		
		define('AEM_PLUGIN_OPTION_XML_NEIGHBORHOODS', $plugin_aem_option_xml_neighborhoods_serialize);

	}
	
	
	/** Plugin Miscellaneous Settings */
	
	if (!defined('AEM_PLUGIN_TEMPLATE_PAGE_PARENT')) {
		define('AEM_PLUGIN_TEMPLATE_PAGE_PARENT', 'Properties');
	}

	if (!defined('AEM_THEME_ACTIVE')) {
		$aem_plugin_template_page_slug = sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_PARENT);
		if(plugin_aem_get_ID_by_slug($aem_plugin_template_page_slug) > 0) {
			define('AEM_THEME_ACTIVE', TRUE);
		} else {
			define('AEM_THEME_ACTIVE', FALSE);
		}	
	}

	if (!defined('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_PARENT')) {
		if(AEM_THEME_ACTIVE == true) {
			define('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_PARENT', AEM_PLUGIN_TEMPLATE_PAGE_PARENT);
		} else {	
			define('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_PARENT', '');
		}
	}
	
	if (!defined('AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT')) {
		define('AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT', sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_PARENT));
	}
	
	if (!defined('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_SEARCH')) {
		define('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_SEARCH', 'Search Property'); 
	}

	if (!defined('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_RESULTS')) {
		define('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_RESULTS', 'Search Results');
	}
	
	if (!defined('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_DETAILS')) {
		define('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_DETAILS', 'Property Details');
	}
	

	if (!defined('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_ACTIVE_PROPERTIES')) {
		define('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_ACTIVE_PROPERTIES', 'My Active Properties');
	}
	
	if (!defined('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_SOLD_PROPERTIES')) {
		define('AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_SOLD_PROPERTIES', 'My Sold Properties');
	}

	if (!defined('AEM_PLUGIN_SHORTCODE_SEARCH')) {
		define('AEM_PLUGIN_SHORTCODE_SEARCH', '[plugin_aem_template_search]');
	}
	
	if (!defined('AEM_PLUGIN_SHORTCODE_RESULTS')) {
		define('AEM_PLUGIN_SHORTCODE_RESULTS', '[plugin_aem_template_results]');
	}
	
	if (!defined('AEM_PLUGIN_SHORTCODE_DETAILS')) {
		define('AEM_PLUGIN_SHORTCODE_DETAILS', '[plugin_aem_template_details]');
	}
	
	if (!defined('AEM_PLUGIN_SHORTCODE_MY_ACTIVE_PROPERTIES')) {
		define('AEM_PLUGIN_SHORTCODE_MY_ACTIVE_PROPERTIES', '[plugin_aem_template_my_active_properties]');
	}
	
	if (!defined('AEM_PLUGIN_SHORTCODE_MY_SOLD_PROPERTIES')) {
		define('AEM_PLUGIN_SHORTCODE_MY_SOLD_PROPERTIES', '[plugin_aem_template_my_sold_properties]');
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
* Plugin Install/Remove 
* ----------------------------------------------------------------------------------------------------------------------
*/

	// Runs when plugin is activated 
	register_activation_hook(__FILE__,'plugin_aem_plugin_install'); 
	
	// Runs on plugin deactivation
	register_deactivation_hook( __FILE__, 'plugin_aem_plugin_remove' );



/**
* ----------------------------------------------------------------------------------------------------------------------
* Plugin Database: Properties >> Create Database Table if NOT exists
* ----------------------------------------------------------------------------------------------------------------------
*/

	if($wpdb->get_var("SHOW TABLES LIKE '".AEM_PLUGIN_DB_Table."'") != AEM_PLUGIN_DB_Table) {
		
		$sql = "CREATE TABLE IF NOT EXISTS `".AEM_PLUGIN_DB_Table."` (
				  `id` int(100) NOT NULL AUTO_INCREMENT,
				  `Represented` varchar(255) DEFAULT 'Both',
				  `MLS` int(100) DEFAULT 0,
				  `Title` varchar(255) DEFAULT NULL,
				  `URL` varchar(255) DEFAULT NULL,
				  `DefaultImageURL` varchar(255) DEFAULT NULL,
				  `DefaultThumbnailURL` varchar(255) DEFAULT NULL,
				  `PropertyType` varchar(255) DEFAULT NULL,
				  `Address` text,
				  `Bedrooms` varchar(255) DEFAULT 0,
				  `Bathrooms` varchar(255) DEFAULT 0,
				  `ListingPrice` varchar(255) DEFAULT 0,
				  `ListingDate` varchar(255) DEFAULT NULL,
				  `SellingPrice` varchar(255) DEFAULT 0,
				  `SoldDate` varchar(255) DEFAULT NULL,
				  `Description` text,
				  `Status` varchar(255) DEFAULT NULL,
				  `ListingAgent` varchar(255) DEFAULT NULL,
				  `ListingOffice` varchar(255) DEFAULT NULL,
				  `Comment` text,
				  `full_property_details` longtext,
				  `date_added` date DEFAULT NULL,
				  `date_updated` date DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
			
		$wpdb->query($sql);
		
		if($wpdb->get_var("SHOW TABLES LIKE '".AEM_PLUGIN_DB_Table."'") == AEM_PLUGIN_DB_Table) {	
			$plugin_aem_db_creation[AEM_PLUGIN_DB_Table] = '<h3>DB Table: '.AEM_PLUGIN_DB_Table.' Created Successfully</h3>';
		} else {
			$plugin_aem_db_creation[AEM_PLUGIN_DB_Table] = '<h3>Failed Creating DB Table: '.AEM_PLUGIN_DB_Table.'</h3>';
		}
		
		#echo $plugin_aem_db_creation[AEM_PLUGIN_DB_Table];
	
	}
	
	
/**
* ----------------------------------------------------------------------------------------------------------------------
* Plugin Install/Active
* ----------------------------------------------------------------------------------------------------------------------
*/

	function plugin_aem_plugin_install() {
	
		global $wpdb;
		
		// cretae the pages
		$result_create_page = plugin_aem_create_page(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_SEARCH, AEM_PLUGIN_SHORTCODE_SEARCH);
		$result_create_page = plugin_aem_create_page(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_RESULTS, AEM_PLUGIN_SHORTCODE_RESULTS);
		$result_create_page = plugin_aem_create_page(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_DETAILS, AEM_PLUGIN_SHORTCODE_DETAILS);
		
		$result_create_page = plugin_aem_create_page(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_ACTIVE_PROPERTIES, "<h2>".AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_ACTIVE_PROPERTIES."</h2> ".AEM_PLUGIN_SHORTCODE_MY_ACTIVE_PROPERTIES);
		$result_create_page = plugin_aem_create_page(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_SOLD_PROPERTIES, "<h2>".AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_SOLD_PROPERTIES."</h2> ".AEM_PLUGIN_SHORTCODE_MY_SOLD_PROPERTIES);

		// update the permalink of the current blog site
		update_option('permalink_structure', "/%postname%/");
			
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
* Plugin Uninstall/Deactivate 
* ----------------------------------------------------------------------------------------------------------------------
*/
	
	function plugin_aem_plugin_remove() {
	
		global $wpdb;
	    $force_delete = true;
		$parent_slug = '';
		
		// check if the pages has parent page & get the parent slug/permalink
		if(AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT != "") { 
			$parent_slug .= AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT.'/'; 
		} 
		

		// delete database tables created by the plugin
		if($wpdb->get_var("SHOW TABLES LIKE '".AEM_PLUGIN_DB_Table."'") == AEM_PLUGIN_DB_Table) {
	
			#$wpdb->query("DROP TABLE IF EXISTS ".AEM_PLUGIN_DB_Table.";");
			
			if($wpdb->get_var("SHOW TABLES LIKE '".AEM_PLUGIN_DB_Table."'") != AEM_PLUGIN_DB_Table) {	
				#$plugin_aem_db_removed[AEM_PLUGIN_DB_Table] = '<h3>DB Table: '.AEM_PLUGIN_DB_Table.' Removed Successfully</h3>';
			} else {
				#$plugin_aem_db_removed[AEM_PLUGIN_DB_Table] = '<h3>Failed Removing DB Table: '.AEM_PLUGIN_DB_Table.'</h3>';
			}
			
			#echo $plugin_aem_db_removed[AEM_PLUGIN_DB_Table];
		
		}


		/* ------------------------------------------------------------------------------
		
		// delete the page from the wp_post database table
		$delete_thePageIDx = wp_delete_post( plugin_aem_get_ID_by_slug($parent_slug.get_option("plugin_aem_option_template_page_search")), $force_delete );
		$delete_thePageIDx = wp_delete_post( plugin_aem_get_ID_by_slug($parent_slug.get_option("plugin_aem_option_template_page_results")), $force_delete );
		$delete_thePageIDx = wp_delete_post( plugin_aem_get_ID_by_slug($parent_slug.get_option("plugin_aem_option_template_page_details")), $force_delete );

		// delete the page from the wp_post database table
		$slug_my_active_properties = sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_ACTIVE_PROPERTIES);
		$slug_my_sold_properties = sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_MY_SOLD_PROPERTIES);
		$delete_thePageIDx = wp_delete_post( plugin_aem_get_ID_by_slug($parent_slug.$slug_my_active_properties), $force_delete );
		$delete_thePageIDx = wp_delete_post( plugin_aem_get_ID_by_slug($parent_slug.$slug_my_sold_properties), $force_delete );
		
		--------------------------------------------------------------------------------- */

		// delete the option from the wp_options database table
		
		# delete_option("plugin_aem_option_api_key");
		# delete_option("plugin_aem_option_limit");
		# delete_option("plugin_aem_option_xml_agent");
		# delete_option("plugin_aem_option_xml_agent_enable");
		# delete_option("plugin_aem_option_xml_neighborhoods_serialize");
		
		# delete_option("plugin_aem_option_template_page_base_search");
		# delete_option("plugin_aem_option_template_page_base_results");
		# delete_option("plugin_aem_option_template_page_base_details");
		
		# delete_option("plugin_aem_option_template_page_search");
		# delete_option("plugin_aem_option_template_page_results");
		# delete_option("plugin_aem_option_template_page_details");
		
	}

	
	
/**
* ----------------------------------------------------------------------------------------------------------------------
* Get Current User
* ----------------------------------------------------------------------------------------------------------------------
*/

	function plugin_aem_wp_get_current_user() {
	
		$current_user = wp_get_current_user();
		
		if ( !($current_user instanceof WP_User) ) {
     		return $current_user;
		} else { 
			return null;
		}
		
	}
	
	
/**
* ----------------------------------------------------------------------------------------------------------------------
* Get the WordPress Page ID by Slug/Permalink
* ----------------------------------------------------------------------------------------------------------------------
*/
	
	function plugin_aem_get_ID_by_slug($page_slug) {
		
		$page = get_page_by_path($page_slug);
		
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
		
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
* Plugin Admin Menu
* ----------------------------------------------------------------------------------------------------------------------
*/

	// create custom plugin settings menu
	add_action('admin_menu', 'plugin_aem_create_menu');
	
	function plugin_aem_create_menu() {
		
		/*--------------------------------------------------------
		   1. Page title – Title of the page or screen that the menu links to. If you are rendering your own page, then the page title value is stored in the global $title.
		   2. Menu title – Title of the menu.
		   3. Capability – Defines what permissions a user must have in order to access this menu. Here are a list of capabilities. (10 = Administrator)
		   4. Menu ID – Unique id of the menu.
		   5. Menu display function – Function containing HTML and PHP code on how to display the page or screen that the menu is linked to.
		   6. Menu icon – (optional) URL of the icon to use for this menu. Here is a tutorial on how to flexibly customize your menu icons.
		   7. Menu position – (optional) If left unspecified, new menu will appear at the bottom. Otherwise, standard WordPress menus are specified in positions of 5s. For example Dashboard = 0, Post = 5, Media = 10, and so on. Since we want our menu to appear after post, we set its position to 26. If we set it to 25 it will replace the Comments menu.
		----------------------------------------------------------*/
		add_menu_page(AEM_PLUGIN_TITLE, AEM_PLUGIN_TITLE, 10, 'agenteasy-properties', 'plugin_aem_settings_page', plugins_url('/images/house.gif', __FILE__), 26);
		add_submenu_page('agenteasy-properties', 'Properties', 'Properties', 10, 'agenteasy-properties/properties.php');
		add_submenu_page('agenteasy-properties', 'Add Property', 'Add Property', 10, 'agenteasy-properties/add-property.php');
		add_submenu_page('', 'Edit Property', 'Edit Property', 10, 'agenteasy-properties/edit-property.php');

	}
	

/**
* ----------------------------------------------------------------------------------------------------------------------
* Enable WYSIWYG & WP Media Library editor in plugin, 
* ----------------------------------------------------------------------------------------------------------------------
*/

	if($_GET['page'] == "agenteasy-properties/add-property.php" || $_GET['page'] == "agenteasy-properties/edit-property.php") {
		add_action( 'init', 'ae_plugin_init' );
	}

	function ae_plugin_init(){
		if (current_user_can('upload_files')) {
			add_action('admin_print_scripts', 'ae_load_jquery');
			add_action('admin_print_styles', 'ae_load_styles' );
			//add_action('admin_menu', 'ae_file_uploader_add_metabox');
		}
	}
	
	function ae_load_jquery(){
		$ae_fileupload_dir = plugins_url('/agenteasy-properties/', dirname(__FILE__));
		wp_enqueue_script('jquery');
		wp_enqueue_script('ae-fileupload', $ae_fileupload_dir . 'jquery.fileupload.js');
		wp_enqueue_script('ae-fileupload-ui', $ae_fileupload_dir . 'jquery.fileupload-ui.js');
	}
	
	function ae_load_styles(){
		$ae_fileupload_dir = plugins_url('/agenteasy-properties/', dirname(__FILE__));
		wp_enqueue_style('ae-fileupload-style', $ae_fileupload_dir . 'jquery.fileupload-ui.css');
	}

	if($_GET['post'] > 0 && $_GET['action'] == "edit" || $_GET['post_type'] == "referrals") {
		add_action( 'init', 'agent_plugin_init' );
	}
	
	function agent_plugin_init() {
		
		wp_enqueue_script('editor');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');
		add_action( 'admin_head', 'wp_tiny_mce' );

	}
	

/**
* ----------------------------------------------------------------------------------------------------------------------
* Additional Plugin
* ----------------------------------------------------------------------------------------------------------------------
* Note: Plugin is integrated to AgentEasy Properties Plugin to enable multiple image select & upload
* ----------------------------------------------------------------------------------------------------------------------
* Plugin Name: Faster Image Insert
* Plugin URI: http://blog.ticktag.org/2009/02/19/2765/
* Description: Fully integrates media manager into editing interface, avoid having to reload it separately in thickbox pop-up; comes with enhanced features, suitable for precise image control.
* Version: 2.1.0
* Author: David Frank
* Author URI: http://blog.ticktag.org/
* License: GPL2
* ----------------------------------------------------------------------------------------------------------------------
*/

	//notice in editing panel when wp_version < 3.0
	function fast_insert_form_notice() {
	
	?>
	<script type="text/javascript">
	/* <![CDATA[ */
	  jQuery(function($) {
		//intialize
		$('#screen-meta').ready(function() {
		  var view = $('#fastinsert-hide').is(':checked');
		  if(view) {
			$('#fastinsert > .inside').html('<p><?php _e('Faster Image Insert 2.0 series are for WordPress 3.0 or newer version, for older WP, download <a href="http://wordpress.org/extend/plugins/faster-image-insert/download/">1.0 series</a> instead.', 'faster-image-insert') ?></p>');
		  }
		});
	  });
	/* ]]> */
	</script>
	<?php
	}
	  
	//iframe for editing panel when wp_version > 3.0
	function fast_insert_form() {
	  global $post_ID, $temp_ID;
	  $id = (int) (0 == $post_ID ? $temp_ID : $post_ID);
	
	  $upload_form = 'faster_insert_upload_form';
	  $noflash = get_option( $upload_form );
	
	?>
	<script type="text/javascript">
	/* <![CDATA[ */
	  jQuery(function($) {
		//intialize
		$('#screen-meta').ready(function() {
		  var view = $('#fastinsert-hide').is(':checked');
		  if(view) {
			<?php if($id > 0) { ?>
			$('#fastinsert > .inside').html('<iframe frameborder="0" name="fast_insert" id="fast_insert" src="<?php echo site_url() ?>/wp-admin/media-upload.php?post_id=<?php if($noflash) echo $id.'&#038;flash=0'; else echo $id; ?>&#038;type=image&#038;tab=type" hspace="0"> </iframe>');
			<?php } else { ?>
			$('#fastinsert > .inside').html('<p><?php _e('Click here to reload after autosave. Or manually save the draft.', 'faster-image-insert') ?></p>');
			<?php } ?>
		  }
		});
		//toggle metabox
		$('#screen-meta #fastinsert-hide').click(function() {
		  var view = $('#fastinsert-hide').is(':checked');
		  if(view) {
			<?php if($id > 0) { ?>
			$('#fastinsert > .inside').html('<iframe frameborder="0" name="fast_insert" id="fast_insert" src="<?php echo site_url() ?>/wp-admin/media-upload.php?post_id=<?php if($noflash) echo $id.'&#038;flash=0'; else echo $id; ?>&#038;type=image&#038;tab=type" hspace="0"> </iframe>');
			<?php } else { ?>
			$('#fastinsert > .inside').html('<p><?php _e('Click here to reload after autosave. Or manually save the draft.', 'faster-image-insert') ?></p>');
			<?php } ?>
		  }
		});
		<?php if($id < 0) { ?>
		//update state after autosave, bind load event.
		$('#fastinsert').click(function() {
		  var newid = $('#post_ID').val();
		  if(notSaved == false && newid > 0) {
			$('#fastinsert > .inside').html('<iframe frameborder="0" name="fast_insert" id="fast_insert" src="<?php echo site_url() ?>/wp-admin/media-upload.php?post_id='+newid+'<?php if($noflash) echo '&#038;flash=0'; ?>&#038;type=image&#038;tab=type" hspace="0"> </iframe>');
			$('#fast_insert').bind("load", function() {
			  if($(this).contents().find('#media-upload').length < 1) {
				document.getElementById('fast_insert').contentWindow.location.href = document.getElementById('fast_insert').contentWindow.location.href;
			  }
			});
		  }
		});
		<?php } ?>
		<?php if($id > 0) { ?>
		//update state on insert
		$('#fast_insert').bind("load", function() {
		  if($(this).contents().find('#media-upload').length < 1) {
			document.getElementById('fast_insert').contentWindow.location.href = document.getElementById('fast_insert').contentWindow.location.href;
		  }
		});
		<?php } ?>
	  });
	/* ]]> */
	</script>
	<?php
	}
	
	//replace several scripts for new functions.
	function fast_image_insert() 
	{
	  //since FII 2.0.0: spot wordpress 3.0+ automagically
	  global $wp_version;
	  if (version_compare($wp_version, '3.0', '>=')) {
		$compat = true;
	  } else {
		$compat = false;
	  }
	  
	  //upload supported custom post type
	  $customtype = 'faster_insert_post_type';
	  $ptype = get_option( $customtype );
	  
	  //integrates manager into post/page edit inferface.
	  if($compat) {
		add_meta_box('fastinsert', 'Faster Insert', 'fast_insert_form', 'post', 'normal', 'high');
		add_meta_box('fastinsert', 'Faster Insert', 'fast_insert_form', 'page', 'normal', 'high');
		$ptypes = explode(",",$ptype);
		foreach ($ptypes as $type) add_meta_box('fastinsert', 'Faster Insert', 'fast_insert_form', $type, 'normal', 'high');
	  } else {
		add_meta_box('fastinsert', 'Faster Insert', 'fast_insert_form_notice', 'post', 'normal', 'high');
		add_meta_box('fastinsert', 'Faster Insert', 'fast_insert_form_notice', 'page', 'normal', 'high');
	  }
	}
	
	// various javascript / css goodies for:
	// 1. selected insert
	// 2. mass-editing
	// 3. styling for iframe and mass-edit table
	function faster_insert_local() {
	  
	?>
	<script type="text/javascript">
	/* <![CDATA[ */  
	  jQuery(function($) {
	  
		//bind current elements and add checkbox
		$('#media-items .new').each(function(e) {
		  var id = $(this).parent().attr('id');
		  id = id.split("-")[2];
		  $(this).prepend('<input type="checkbox" class="item_selection" title="<?php _e('Select items you want to insert','faster-image-insert'); ?>" id="attachments[' + id.substring() + '][selected]" name="attachments[' + id + '][selected]" value="selected" /> ');
		});
		
		//bind future elements and add checkbox
		$('.ml-submit').live('mouseenter',function(e) {
		  $('#media-items .new').each(function(e) {
			var id = $(this).parent().children('input[value="image"]').attr('id');
			id = id.split("-")[2];
			$(this).not(':has("input")').prepend('<input type="checkbox" class="item_selection" title="<?php _e('Select items you want to insert','faster-image-insert'); ?>" id="attachments[' + id.substring() + '][selected]" name="attachments[' + id + '][selected]" value="selected" /> ');
		  });
		  //$('.ml-submit').die('mouseenter');
		});
		
		//buttons for enhanced functions
		$('.ml-submit:first').append('<input type="submit" class="button savebutton" name="insertall" id="insertall" value="<?php echo attribute_escape( __( 'Insert selected images', 'faster-image-insert') ); ?>" /> ');  
		$('.ml-submit:first').append('<input type="submit" class="button savebutton" name="invertall" id="invertall" value="<?php echo attribute_escape( __( 'Invert selection', 'faster-image-insert') ); ?>" /> ');
		$('.ml-submit #invertall').click(
		  function(){
			$('#media-items .item_selection').each(function(e) {
			  if($(this).is(':checked')) $(this).attr("checked","");
			  else $(this).attr("checked","checked");
			});
			return false;
		  }
		);
		
		//mass-editing is default function for FII 2.0+
		if($('#gallery-settings').length > 0) {
		  $('#gallery-settings').before('<div id="mass-edit"><div class="title"><?php _e('Mass Image Edit','faster-image-insert'); ?></div></div>');
		  $('#gallery-settings .describe').clone().appendTo('#mass-edit');
		  $('#mass-edit .describe tr:eq(0)').clone().prependTo("#mass-edit .describe tbody");
		  $('#mass-edit').append('<p class="ml-submit"><input type="button" class="button" name="massedit" id="massedit" value="<?php _e('Apply changes','faster-image-insert'); ?>" /> <span><?php _e('Press "Save all changes" above to save. Only Title, Alt-Text and Caption are permanently saved.','faster-image-insert'); ?></span></p>');
	
		  //setup the form
		  $('#mass-edit tr:eq(0) .alignleft').html('<?php _e('Image Titles','faster-image-insert'); ?>');
		  $('#mass-edit tr:eq(1) .alignleft').html('<?php _e('Image Alt-Texts','faster-image-insert'); ?>');
		  $('#mass-edit tr:eq(2) .alignleft').html('<?php _e('Image Captions','faster-image-insert'); ?>');
		  $('#mass-edit tr:eq(3) .alignleft').html('<?php _e('Image Alignment','faster-image-insert'); ?>');
		  $('#mass-edit tr:eq(4) .alignleft').html('<?php _e('Image Sizes','faster-image-insert'); ?>');
		
		  $('#mass-edit tr:eq(0) .field').html('<input type="text" name="title_edit" id="title_edit" value="" />');
		  $('#mass-edit tr:eq(1) .field').html('<input type="text" name="alttext_edit" id="alttext_edit" value="" />');
		  $('#mass-edit tr:eq(2) .field').html('<input type="text" name="captn_edit" id="captn_edit" value="" />');
		  $('#mass-edit tr:eq(3) .field').html('<input type="radio" name="align_edit" id="align_none" value="none" />\n<label for="align_none" class="radio"><?php _e('None') ?></label>\n<input type="radio" name="align_edit" id="align_left" value="left" />\n<label for="align_left" class="radio"><?php _e('Left') ?></label>\n<input type="radio" name="align_edit" id="align_center" value="center" />\n<label for="align_center" class="radio"><?php _e('Center') ?></label>\n<input type="radio" name="align_edit" id="align_right" value="right" />\n<label for="align_right" class="radio"><?php _e('Right') ?></label>');
		  $('#mass-edit tr:eq(4) .field').html('<input type="radio" name="size_edit" id="size_thumb" value="thumbnail" />\n<label for="size_thumb" class="radio"><?php _e('Thumbnail') ?></label>\n<input type="radio" name="size_edit" id="size_medium" value="medium" />\n<label for="size_medium" class="radio"><?php _e('Medium') ?></label>\n<input type="radio" name="size_edit" id="size_large" value="large" />\n<label for="size_large" class="radio"><?php _e('Large') ?></label>\n<input type="radio" name="size_edit" id="size_full" value="full" />\n<label for="size_full" class="radio"><?php _e('Full size') ?></label>');
	
		  //read value and apply
		  $('#massedit').click(function() {
			var massedit = new Array();
			massedit[0] = $('#mass-edit .describe #title_edit').val();
			massedit[1] = $('#mass-edit .describe #alttext_edit').val();
			massedit[2] = $('#mass-edit .describe #captn_edit').val();
			massedit[3] = $('#mass-edit tr:eq(3) .field input:checked').val();
			massedit[4] = $('#mass-edit tr:eq(4) .field input:checked').val();
			//alert(massedit);
			var num_count = 0;
			$('.media-item').each(function(e) {
			  num_count++;
			  if(typeof massedit[0] !== "undefined" && massedit[0].length > 0) {
				$(this).find('.post_title .field input').val(massedit[0] + " (" + num_count + ")");
			  }
			  if(typeof massedit[1] !== "undefined" && massedit[1].length > 0) {
				$(this).find('.image_alt .field input').val(massedit[1] + " (" + num_count + ")");
			  }
			  if(typeof massedit[2] !== "undefined" && massedit[2].length > 0) {
				$(this).find('.post_excerpt .field input').val(massedit[2]);
			  }
			  if(typeof massedit[3] !== "undefined" && massedit[3].length > 0) {
				$(this).find('.align .field input[value='+massedit[3]+']').attr("checked","checked");
			  }
			  if(typeof massedit[4] !== "undefined" && massedit[4].length > 0) {
				$(this).find('.image-size .field input[value='+massedit[4]+']').attr("checked","checked");
			  }
			});
		  });
		}
	  });
	
	/* ]]> */
	</script>
	<style type="text/css" media="screen">
	#fast_insert{width:100%;height:500px;}
	#mass-edit th.label{width:160px;}
	#mass-edit #basic th.label{padding:5px 5px 5px 0;}
	#mass-edit .title{clear:both;padding:0 0 3px;border-bottom-style:solid;border-bottom-width:1px;font-family:Georgia,"Times New Roman",Times,serif;font-size:1.6em;border-bottom-color:#DADADA;color:#5A5A5A;}
	#mass-edit .describe td{vertical-align:middle;height:3.5em;}
	#mass-edit .describe th.label{padding-top:.5em;text-align:left;}
	#mass-edit .describe{padding:5px;width:615px;clear:both;cursor:default;}
	#mass-edit .describe select,#mass-edit .describe input[type=text]{width:15em;border:1px solid #dfdfdf;}
	#mass-edit label,#mass-edit legend{font-size:13px;color:#464646;margin-right:15px;}
	#mass-edit .align .field label{margin:0 1.5em 0 0;}
	#mass-edit p.ml-submit{border-top:1px solid #dfdfdf;}
	#mass-edit select#columns{width:6em;}
	</style>

	<?php
	}
	
	//used for passing content to edit panel.
	function fast_insert_to_editor($html) {
	?>
	<script type="text/javascript">
	/* <![CDATA[ */
	var win = window.dialogArguments || opener || parent || top;
	win.send_to_editor('<?php echo str_replace('\\\n','\\n',addslashes($html)); ?>');
	/* ]]> */
	</script>
	  <?php
	  exit;
	}
	
	//catches the insert selected images post request.
	function faster_insert_form_handler() {
	  global $post_ID, $temp_ID;
	  $post_id = (int) (0 == $post_ID ? $temp_ID : $post_ID);
	  check_admin_referer('media-form');
	  
	  //load settings
	  $customstring = 'faster_insert_plugin_custom';
	  $cstring = get_option( $customstring );
	  
	  $line_number = 'faster_insert_line_number';
	  $number = get_option( $line_number );
	  
	  $image_line = 'faster_insert_image_line';
	  $oneline = get_option( $image_line );
	  
	  if(!is_numeric($number)) $number = 4;
	
	  //modify the insertion string
	  if ( !empty($_POST['attachments']) ) {
		$result = '';
		foreach ( $_POST['attachments'] as $attachment_id => $attachment ) {
		  $attachment = stripslashes_deep( $attachment );
		  if (!empty($attachment['selected'])) {
			$html = $attachment['post_title'];
			if ( !empty($attachment['url']) ) {
			  if ( strpos($attachment['url'], 'attachment_id') || false !== strpos($attachment['url'], get_permalink($post_id)) )
				$rel = " rel='attachment wp-att-".attribute_escape($attachment_id)."'";
			  $html = "<a href='{$attachment['url']}'$rel>$html</a>";
			}
			$html = apply_filters('media_send_to_editor', $html, $attachment_id, $attachment);
			//since 1.5.0: &nbsp; is the same as a blank space, but can be passed onto TinyMCE
			if(!$oneline) $result .= $html.str_repeat("\\n".$cstring."\\n",$number);
			else $result .= $html.str_repeat($cstring,$number);
		  }
		}
		return fast_insert_to_editor($result);
	  }
	
	  return $errors;
	}
	
	//filter for media_upload_gallery, recognize insertall request.
	function faster_insert_media_upload_gallery() {
	  if ( isset($_POST['insertall']) ) {
		$return = faster_insert_form_handler();
		
		if ( is_string($return) )
		  return $return;
		if ( is_array($return) )
		  $errors = $return;
	  }
	}
	
	//filter for media_upload_image, recognize insertall request.
	function faster_insert_media_upload_image() {
	  if ( isset($_POST['insertall']) ) {
		$return = faster_insert_form_handler();
		
		if ( is_string($return) )
		  return $return;
		if ( is_array($return) )
		  $errors = $return;
	  }
	}
	
	//filter for media_upload_library, recognize insertall request.
	function faster_insert_media_upload_library() {
	  if ( isset($_POST['insertall']) ) {
		$return = faster_insert_form_handler();
		
		if ( is_string($return) )
		  return $return;
		if ( is_array($return) )
		  $errors = $return;
	  }
	}
	
	//for disabling captions
	function caption_off() {
	  $no_caption = 'faster_insert_no_caption';
	  $nocaption = get_option( $no_caption );
	  if($nocaption)
		return true;
	}
	
	//adds a new submenu for options
	function faster_insert_option() {
		add_options_page(__('Faster Image Insert - User Options','faster-image-insert'), 'Faster Image Insert', 8, __FILE__, 'faster_insert_option_detail');
	}
	
	//display the actual content of option page.
	function faster_insert_option_detail() {  
	
	  $faster_insert_update = 'faster_insert_update';
	  $faster_insert_delete = 'faster_insert_delete';
	  $faster_insert_valid = 'faster_insert_valid';
	
	  //all the options
	  $upload_form = 'faster_insert_upload_form';
	  $image_line = 'faster_insert_image_line';
	  $line_number = 'faster_insert_line_number';
	  $no_caption = 'faster_insert_no_caption';
	  $customstring = 'faster_insert_plugin_custom';
	  $customtype = 'faster_insert_post_type';
	  
	  //add options
	  add_option( $upload_form, false );
	  add_option( $image_line, false );
	  add_option( $line_number, 1 );
	  add_option( $no_caption, false );
	  add_option( $customstring, "<p></p>" );
	  add_option( $customtype, "" );
	  
	  //update options
	  if( !empty($_POST[ $faster_insert_update ]) && check_admin_referer($faster_insert_valid,'check-form') ) {
	  
		$_POST[ $upload_form ] == 'selected' ? $flash = true : $flash = false;
		$_POST[ $image_line ] == 'selected' ? $image = true : $image = false;
		if(is_numeric($_POST[ $line_number ])) $number = $_POST[ $line_number ]; else $number = 1;
		$_POST[ $no_caption ] == 'selected' ? $caption = true : $caption = false;
		if(is_string($_POST[ $customstring ]) && !empty($_POST[ $customstring ])) $cstring = $_POST[ $customstring ]; else $cstring = "<p></p>";
		if(is_string($_POST[ $customtype ]) && !empty($_POST[ $customtype ])) $ptype = $_POST[ $customtype ]; else $ptype = "";
		
		update_option( $upload_form, $flash );
		update_option( $image_line, $image );
		update_option( $line_number, $number );
		update_option( $no_caption, $caption );
		update_option( $customstring, $cstring );
		update_option( $customtype, $ptype );
	
		echo '<div class="updated"><p><strong>'.__('Settings saved.', 'faster-image-insert').'</strong></p></div>';  
	  }
	
	  //delete options
	  if( isset($_POST[ $faster_insert_delete ]) && $_POST[ $faster_insert_valid ] == 'V' ) {
		
		//compatible with version older than FII 2.0
		delete_option( $load_iframe );
		delete_option( $upload_form );
		delete_option( $image_line );
		delete_option( $line_number );
		delete_option( $mass_edit );
		delete_option( $no_caption );
		delete_option( $backcompat );
		delete_option( $plugindebug );
		delete_option( $customstring );
		delete_option( $customtype );
	
		echo '<div class="updated"><p><strong>'.__('Settings deleted.', 'faster-image-insert').'</strong></p></div>';  
	  }
	  
	  //current value
	  $flash = get_option( $upload_form );
	  $image = get_option( $image_line );
	  $number = get_option( $line_number );
	  $caption = get_option( $no_caption );
	  $cstring = get_option( $customstring );
	  $ptype = get_option( $customtype );
	
	  echo '<div class="wrap">'."\n".
		 '<div id="icon-options-general" class="icon32"><br /></div>'."\n".
		 '<h2>'.__('Faster Image Insert - User Options','faster-image-insert').'</h2>'."\n".
		 '<h3>'.__('Updates your settings here', 'faster-image-insert').'</h3>';
	?>
	
	<form name="faster-insert-option" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<?php wp_nonce_field($faster_insert_valid, 'check-form'); ?>
	
	  <table width="100%" cellspacing="2" cellpadding="5" class="form-table">
	
		<tr valign="top">
		  <th scope="row"><?php _e("Load HTML form instead of Flash uploader", 'faster-image-insert' ); ?></th>
		  <td><label for="<?php echo $upload_form; ?>"><input type="checkbox" name="<?php echo $upload_form; ?>" id="<?php echo $upload_form; ?>" value="selected" <?php if($flash) echo 'checked="checked"' ?> /> <?php _e("Enable this if you're having trouble with flash uploader.", 'faster-image-insert' ); ?></label></td>
		</tr>
		
		<tr valign="top">
		  <th scope="row"><?php _e("Insert multiple images in 1 line", 'faster-image-insert' ); ?></th>
		  <td><label for="<?php echo $image_line; ?>"><input type="checkbox" name="<?php echo $image_line; ?>" id="<?php echo $image_line; ?>" value="selected" <?php if($image) echo 'checked="checked"' ?> /> <?php _e("Enable this if you want to insert a serial of thumbnails without newlines.", 'faster-image-insert' ); ?></label></td>
		</tr>
		
		<tr valign="top">
		  <th scope="row"><?php _e("Set custom string", 'faster-image-insert' ); ?></th>
		  <td><label for="<?php echo $customstring; ?>"><input type="text" name="<?php echo $customstring; ?>" id="<?php echo $customstring; ?>" value="<?php echo $cstring; ?>" size="20" /> <?php _e("Edit this to change the custom string inserted between each image; defaults to &lt;p&gt;&lt;/p&gt;.", 'faster-image-insert' ); ?></label></td>
		</tr>
	
		<tr valign="top">
		  <th scope="row"><?php _e("Duplicate customer string", 'faster-image-insert' ); ?></th>
		  <td><label for="<?php echo $line_number; ?>"><input type="text" name="<?php echo $line_number; ?>" id="<?php echo $line_number; ?>" value="<?php echo $number; ?>" size="10" /> <?php _e("Depends on previous option; it duplicates the string inserted each time. Default is 1 time.", 'faster-image-insert' ); ?></label></td>
		</tr>
		
		<tr valign="top">
		  <th scope="row"><?php _e("Disable captions", 'faster-image-insert' ); ?></th>
		  <td><label for="<?php echo $no_caption; ?>"><input type="checkbox" name="<?php echo $no_caption; ?>" id="<?php echo $no_caption; ?>" value="selected" <?php if($caption) echo 'checked="checked"' ?> /> <?php _e("WordPress use caption as alternative text, but it also appends [caption] if set manually, Enable this if you want to set alternative text without appending caption.", 'faster-image-insert' ); ?></label></td>
		</tr>
		
		<tr valign="top">
		  <th scope="row"><?php _e("Custom post types", 'faster-image-insert' ); ?></th>
		  <td><label for="<?php echo $customtype; ?>"><input type="text" name="<?php echo $customtype; ?>" id="<?php echo $customtype; ?>" value="<?php echo $ptype; ?>" size="20" /> <?php _e("Load FII panel in custom post types other than the default post/page; default to none, comma separated.", 'faster-image-insert' ); ?></label></td>
		</tr>
		
	  </table>
	
	<p class="submit">
	<input type="submit" name="<?php echo $faster_insert_update; ?>" class="button-primary" value="<?php _e('Save Changes', 'faster-image-insert' ) ?>" />
	<input type="submit" name="<?php echo $faster_insert_delete; ?>" value="<?php _e('Uninstall', 'faster-image-insert' ) ?>" />
	</p>
	
	</form>
	
	<?php     
	  echo '</div>'."\n";
	}

	//load languages file for i18n
	function faster_insert_textdomain() {
	  if (function_exists('load_plugin_textdomain')) {
		if ( !defined('WP_PLUGIN_DIR') ) {
		  load_plugin_textdomain('faster-image-insert', str_replace( ABSPATH, '', dirname(__FILE__) ) . '/languages');
		} else {
		  load_plugin_textdomain('faster-image-insert', false, dirname( plugin_basename(__FILE__) ) . '/languages');
		}
	  }
	}

	//hook it up
	add_action('init', 'faster_insert_textdomain');
	add_action('admin_menu', 'faster_insert_option');
	add_action('admin_menu', 'fast_image_insert', 20);
	add_action('admin_head', 'faster_insert_local');
	add_filter('media_upload_gallery', 'faster_insert_media_upload_gallery');
	add_filter('media_upload_library', 'faster_insert_media_upload_library');
	add_filter('media_upload_image', 'faster_insert_media_upload_image');
	add_filter('disable_captions', 'caption_off');
	
// end of -> Additional Plugin >> Plugin Name: Faster Image Insert -----------------------------------------------------


/**
* ----------------------------------------------------------------------------------------------------------------------
* Create WordPress Page for the Template
* ----------------------------------------------------------------------------------------------------------------------
*/

	function plugin_aem_create_page($plugin_aem_page_title, $plugin_aem_page_content) {
	
		global $wpdb;
		
		// get the page slug/permalink
		$plugin_aem_page_slug = sanitize_title($plugin_aem_page_title);
		
		
		if(AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT == "") {
		
			// get the page id if exists
			$plugin_aem_page_id = plugin_aem_get_ID_by_slug($plugin_aem_page_slug);
			
		} else {
			
			// get the page id if exists
			$plugin_aem_page_id = plugin_aem_get_ID_by_slug(AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT.'/'.$plugin_aem_page_slug);
			
		}
		
		// check the page exists & get the parent page id
		if($plugin_aem_page_id > 0) {
			
			$post_info = get_post($plugin_aem_page_id); 
			$plugin_aem_page_parent_id = $post_info->post_parent;
			$plugin_aem_page_menu_order = $post_info->menu_order;
			
		} else {
		
			if(AEM_THEME_ACTIVE == TRUE) {
				$plugin_aem_page_parent_id = plugin_aem_get_ID_by_slug(AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT);
			} else {
				$plugin_aem_page_parent_id = 0;
			}	
			
			$plugin_aem_page_menu_order = 0;
			
		}
			
		// get current blog site user info
		$author_info = plugin_aem_wp_get_current_user();
		
		// Insert the PAGE into the WP database
		$plugin_aem_page = array();
		
		$plugin_aem_page['ID'] 				= $plugin_aem_page_id;
		$plugin_aem_page['post_title'] 		= $plugin_aem_page_title;
		$plugin_aem_page['post_type'] 		= 'page';
		$plugin_aem_page['post_author'] 	= $author_info->ID;
		$plugin_aem_page['post_content'] 	= $plugin_aem_page_content;
		$plugin_aem_page['post_status'] 	= 'publish';
		$plugin_aem_page['comment_status']	= 'closed';
		$plugin_aem_page['ping_status'] 	= 'closed';
		$plugin_aem_page['post_parent'] 	= $plugin_aem_page_parent_id;
		$plugin_aem_page['menu_order'] 		= $plugin_aem_page_menu_order;
		
		// Insert the post into the database
		$thePageIDx = 0;
		$thePageIDx = wp_insert_post( $plugin_aem_page );
	   
		if($thePageIDx > 0) {
			$output = true;
		} else {
			$output = false;
		} 
		
		return $output; 
	
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
* Register Plugin Settings & Set Option default values
* ----------------------------------------------------------------------------------------------------------------------
*/

	//call register settings function
	add_action( 'admin_init', 'register_plugin_aem_settings' );

	//register our settings
	function register_plugin_aem_settings() {
	
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_api_key' );
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_limit' );
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_xml_agent' );
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_xml_agent_enable' );
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_xml_neighborhoods_serialize' );
		
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_template_page_base_search' );
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_template_page_base_results' );
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_template_page_base_details' );
		
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_template_page_search' );
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_template_page_results' );
		register_setting( 'plugin-ps-settings-group', 'plugin_aem_option_template_page_details' );

	}

	if(get_option('plugin_aem_option_template_page_search') == '') {
		$pageslug = sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_SEARCH);
		add_option('plugin_aem_option_template_page_search', $pageslug);
		update_option('plugin_aem_option_template_page_search', $pageslug);
	}
	
	if(get_option('plugin_aem_option_template_page_results') == '') {
		$pageslug = sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_RESULTS);
		add_option('plugin_aem_option_template_page_results', $pageslug);
		update_option('plugin_aem_option_template_page_results', $pageslug);
	}
	
	if(get_option('plugin_aem_option_template_page_details') == '') {
		$pageslug = sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_DETAILS);
		add_option('plugin_aem_option_template_page_details', $pageslug);
		update_option('plugin_aem_option_template_page_details', $pageslug);
	}
	
	if(AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT != "") {
		$page_parent_slug = '/'.AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT;
	} else {
		$page_parent_slug = '';
	}
	
	if(get_option('plugin_aem_option_template_page_base_search') == '') {
		add_option('plugin_aem_option_template_page_base_search', get_option( 'siteurl' ).$page_parent_slug);
		update_option('plugin_aem_option_template_page_base_search', get_option( 'siteurl' ).$page_parent_slug);
	}
	
	if(get_option('plugin_aem_option_template_page_base_results') == '') {
		add_option('plugin_aem_option_template_page_base_results', get_option( 'siteurl' ).$page_parent_slug);
		update_option('plugin_aem_option_template_page_base_results', get_option( 'siteurl' ).$page_parent_slug);
	}
	
	if(get_option('plugin_aem_option_template_page_base_details') == '') {
		add_option('plugin_aem_option_template_page_base_details', get_option( 'siteurl' ).$page_parent_slug);
		update_option('plugin_aem_option_template_page_base_details', get_option( 'siteurl' ).$page_parent_slug);
	}
	
	if(get_option('plugin_aem_option_api_key') == '') {
		add_option('plugin_aem_option_api_key', AEM_PLUGIN_OPTION_API_KEY);
	}

	if(get_option('plugin_aem_option_limit') == '') {
		add_option('plugin_aem_option_limit', AEM_PLUGIN_OPTION_XML_LIMIT);
	}

	if(get_option('plugin_aem_option_xml_agent') == '') {
		add_option('plugin_aem_option_xml_agent', AEM_PLUGIN_OPTION_XML_AGENT);
	}

	if(get_option('plugin_aem_option_xml_agent_enable') == '') {
		add_option('plugin_aem_option_xml_agent_enable', AEM_PLUGIN_OPTION_XML_AGENT_ENABLE);
	}

	if(get_option('plugin_aem_option_xml_neighborhoods_serialize') == '') {
		add_option('plugin_aem_option_xml_neighborhoods_serialize', AEM_PLUGIN_OPTION_XML_NEIGHBORHOODS);
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
* Set & Get Settings values
* ----------------------------------------------------------------------------------------------------------------------
*/

	function wp_plugin_aem_params(){
	
		$wp_ps = array();
		
		$wp_ps['plugin_aem_option_xml_parser']  		 	 	= AEM_PLUGIN_OPTION_XML_PARSER;
		$wp_ps['plugin_aem_option_api_key'] 	 		 		= get_option('plugin_aem_option_api_key');
		$wp_ps['plugin_aem_option_limit'] 	 		 			= get_option('plugin_aem_option_limit');
		$wp_ps['plugin_aem_option_xml_agent'] 	 		 		= get_option('plugin_aem_option_xml_agent');
		$wp_ps['plugin_aem_option_xml_agent_enable'] 	 		= get_option('plugin_aem_option_xml_agent_enable');
		$wp_ps['plugin_aem_option_xml_status'] 	 				= AEM_PLUGIN_OPTION_XML_STATUS;
		$wp_ps['plugin_aem_option_xml_neighborhoods_serialize']  = get_option('plugin_aem_option_xml_neighborhoods_serialize');

		$wp_ps['plugin_aem_option_template_page_base_search']  	= get_option('plugin_aem_option_template_page_base_search');
		$wp_ps['plugin_aem_option_template_page_base_results'] 	= get_option('plugin_aem_option_template_page_base_results');
		$wp_ps['plugin_aem_option_template_page_base_details'] 	= get_option('plugin_aem_option_template_page_base_details');
	
		$wp_ps['plugin_aem_option_template_page_search']  		= get_option('plugin_aem_option_template_page_search');
		$wp_ps['plugin_aem_option_template_page_results'] 		= get_option('plugin_aem_option_template_page_results');
		$wp_ps['plugin_aem_option_template_page_details'] 		= get_option('plugin_aem_option_template_page_details');
	
		$wp_ps['AEM_PLUGIN_URL'] 								= AEM_PLUGIN_URL;
	
		return $wp_ps;
		
	}
	

/**
* ----------------------------------------------------------------------------------------------------------------------
* Template Page
* ----------------------------------------------------------------------------------------------------------------------
*/

	function wp_plugin_aem_template($template_page, $wp_plugin_aem_params) {
	
		global $wpdb;
		
		if($template_page == "template-my-sold-properties.php") {
		
			$sold_mlsid_listings = $wpdb->get_results("SELECT * FROM ".AEM_PLUGIN_DB_Table." WHERE Status = 'Sold' ORDER BY MLS ASC", ARRAY_A);
			
			if(count($sold_mlsid_listings) > 0) {
				$db_listings['sold_listings'] = $sold_mlsid_listings;
			} else {
				$db_listings['sold_listings'] = array();
			}
			
		}
	
		if($template_page == "template-my-active-properties.php") {
		
			$active_mlsid_listings = $wpdb->get_results("SELECT * FROM ".AEM_PLUGIN_DB_Table." WHERE Status LIKE 'Active' OR Status LIKE 'Act. Con.' OR Status LIKE 'Active Contigent' ORDER BY MLS ASC", ARRAY_A);
			
			if(count($active_mlsid_listings) > 0) {
				$db_listings['active_listings'] = $active_mlsid_listings;
			} else {
				$db_listings['active_listings'] = array();
			}
			
		}
	
		if($template_page == "template-details.php") {
		
			
			// set default value as null
			$mlsid = 0;	
			$address = "";	
			
			// get the url params on the property details page
			$aem_property_details = get_query_var('aem_property_details');
			$property_vars = explode('/',$aem_property_details);
			
			// check if 
			if(is_array($property_vars)) {
				
				// get the mlsid on property url (permalink)
				if(count($property_vars) > 0) {
					if($property_vars[0] > 0) {
						$mlsid = $property_vars[0];	
					}
				}
				
				// get the address on property url (permalink)
				if(count($property_vars) > 1) {
					if($property_vars[1] != "") {
						$address = urldecode($property_vars[1]);	
					}
				}
				
			}
			
			$WHERE  = " WHERE MLS = '".$mlsid."' ";
			$WHERE .= " AND address = '".$address."' ";
			
			$details_mlsid_listings = $wpdb->get_results("SELECT * FROM ".AEM_PLUGIN_DB_Table." ".$WHERE." LIMIT 1", ARRAY_A);
			
			if(count($details_mlsid_listings) > 0) {
				$db_listings['details_listings'] = $details_mlsid_listings;
			} else {
				$db_listings['details_listings'] = array();
			}
			
		}
	
		// turn output buffering On
		ob_start();
		
		// get the template content
		require_once($template_page);
		
		$output = ob_get_contents();
		
		// silently discard the buffer contents. 
		ob_end_clean();
		
		return $output;
		
	}

	function wp_plugin_aem_template_page($template_page) {
	
		$wp_plugin_aem_params = wp_plugin_aem_params();
		$output = wp_plugin_aem_template($template_page, $wp_plugin_aem_params);
		
		return $output;
		
	}
	

/**
* ----------------------------------------------------------------------------------------------------------------------
* Template Page: Search
* ----------------------------------------------------------------------------------------------------------------------
*/

	function plugin_aem_property_templates($content) {
	
		$content = preg_replace('/<p>\s*[(.*)]\s*<\/p>/i', "[$1]", $content);
		
		if (strpos($content, AEM_PLUGIN_SHORTCODE_SEARCH) !== FALSE) {
			$content = str_replace(AEM_PLUGIN_SHORTCODE_SEARCH, wp_plugin_aem_template_page('template-search.php'), $content);
		}
		
		if (strpos($content, AEM_PLUGIN_SHORTCODE_RESULTS) !== FALSE){
			$content = str_replace(AEM_PLUGIN_SHORTCODE_RESULTS, wp_plugin_aem_template_page('template-results.php'), $content);
		}
		
		if (strpos($content, AEM_PLUGIN_SHORTCODE_DETAILS) !== FALSE) {
			$content = str_replace(AEM_PLUGIN_SHORTCODE_DETAILS, wp_plugin_aem_template_page('template-details.php'), $content);
		}
		
		if (strpos($content, AEM_PLUGIN_SHORTCODE_MY_ACTIVE_PROPERTIES) !== FALSE) {
			$content = str_replace(AEM_PLUGIN_SHORTCODE_MY_ACTIVE_PROPERTIES, wp_plugin_aem_template_page('template-my-active-properties.php'), $content);
		}
		
		if (strpos($content, AEM_PLUGIN_SHORTCODE_MY_SOLD_PROPERTIES) !== FALSE) {
			$content = str_replace(AEM_PLUGIN_SHORTCODE_MY_SOLD_PROPERTIES, wp_plugin_aem_template_page('template-my-sold-properties.php'), $content);
		}
		
		return $content;
	
	}
	
	add_filter('the_content', 'plugin_aem_property_templates');


/**
* ----------------------------------------------------------------------------------------------------------------------
* Custom Rewrite Rule for the "Property" Detail Page (Clean/SEO friendly URL)
* ----------------------------------------------------------------------------------------------------------------------
* Example: http://myblogsite.com/detail-page/376072/2450-bush-st-san-francisco-ca-94115/
*  
*  -> Template page    : detail-page
*  -> MLS Listing#     : 376072
*  -> Property Address : 2450-bush-st-san-francisco-ca-94115
* ----------------------------------------------------------------------------------------------------------------------
*/

	function property_search_flush_rewrite() {
	  	global $wp_rewrite;
	  	$wp_rewrite->flush_rules();
	}
	
	function property_search_vars($public_query_vars) {
		$public_query_vars[] = 'aem_property_details';
		return $public_query_vars;
	}
	
	function property_search_add_rewrite_rules($wp_rewrite) {
		
		$template_page = get_option('plugin_aem_option_template_page_base_details').'/'.get_option('plugin_aem_option_template_page_details');
		
		$template_base = get_option( 'siteurl' ).'/';

		$template_page_details = str_replace($template_base, "", $template_page);
		
		$new_rules = array($template_page_details.'/(.+)' => 'index.php?pagename='.$template_page_details.'&aem_property_details=' . $wp_rewrite->preg_index(1));
		
		$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
	}

	add_action('init', 'property_search_flush_rewrite');
	add_filter('query_vars', 'property_search_vars');
	add_action('generate_rewrite_rules', 'property_search_add_rewrite_rules');
		

/**
* ----------------------------------------------------------------------------------------------------------------------
*  Pagination string
* ----------------------------------------------------------------------------------------------------------------------
*/
	
	function plugin_aem_getPaginationString($frontText = "", $page = 1, $totalitems, $limit = 10, $adjacents = 1, $targetpage = "/", $pagestring = "?pg=") {		
		
		//defaults
		if(!$adjacents) $adjacents = 1;
		if(!$limit) $limit = 10;
		if(!$page) $page = 1;
		if(!$targetpage) $targetpage = "/";
		
		//other vars
		$prev = $page - 1;									//previous page is page - 1
		$next = $page + 1;									//next page is page + 1
		$lastpage = ceil($totalitems / $limit);				//lastpage is = total items / items per page, rounded up.
		$lpm1 = $lastpage - 1;								//last page minus 1
		
		// Now we apply our rules and draw the pagination object. We're actually saving the code to a variable in case we want to draw it more than once.
		$pagination = "";
		if($lastpage > 1){	
		
			$pagination .= "<div class=\"property_results-pagination\">";
			
			#$pagination .= "<span id=\"pagination-title\">$frontText</span>";
	
			//previous button
			if ($page > 1) {
				$pagination .= "&nbsp;&nbsp;<a href=\"$targetpage$pagestring$prev\">&laquo; PREV</a>&nbsp;&nbsp;";
			} else {
				//$pagination .= "<span class=\"disabled\">&laquo; prev</span>";	
			}
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2)) {	//not enough pages to bother breaking it up
				
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page) {
						$pagination .= "<span class=\"current\">$counter</span>";
					} else {
						$pagination .= "<a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
					}
				}
				
			} elseif($lastpage >= 7 + ($adjacents * 2)) { //enough pages to hide some	
				
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 3))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page) {
							$pagination .= "<span class=\"current\">$counter</span>";
						} else {
							$pagination .= "<a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
						}
					}
					$pagination .= "<span class=\"elipses\">....</span>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . $lpm1 . "\">$lpm1</a>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . $lastpage . "\">$lastpage</a>";		
				
				//in middle; hide some front and some back
				} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
				
					$pagination .= "<a href=\"" . $targetpage . $pagestring . "1\">1</a>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . "2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page) {
							$pagination .= "<span class=\"current\">$counter</span>";
						} else {
							$pagination .= "<a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
						}
					}
					$pagination .= "...";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . $lpm1 . "\">$lpm1</a>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . $lastpage . "\">$lastpage</a>";		
				
				//close to end; only hide early pages
				} else {
				
					$pagination .= "<a href=\"" . $targetpage . $pagestring . "1\">1</a>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . "2\">2</a>";
					$pagination .= "<span class=\"elipses\">....</span>";
					for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page) {
							$pagination .= "<span class=\"current\">$counter</span>";
						} else {
							$pagination .= "<a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
						}
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) {
				$pagination .= "&nbsp;&nbsp;<a href=\"" . $targetpage . $pagestring . $next . "\">NEXT &raquo;</a>";
			} else {
				//$pagination .= "<span class=\"disabled\">next &raquo;</span>";
			}
			
			$pagination .= "</div>";
		}
		
		return $pagination;
	
	}

	
/**
* ----------------------------------------------------------------------------------------------------------------------
*  XML processing
* ----------------------------------------------------------------------------------------------------------------------
*/

	function xml2array($contents, $get_attributes=1) { 
	   
		if(!$contents) return array(); 
	
		if(!function_exists('xml_parser_create')) { 
			//print "'xml_parser_create()' function not found!"; 
			return array(); 
		} 
		
		//Get the XML parser of PHP - PHP must have this module for the parser to work 
		$parser = xml_parser_create(); 
		xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 ); 
		xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 ); 
		xml_parse_into_struct( $parser, $contents, $xml_values ); 
		xml_parser_free( $parser ); 
	
		if(!$xml_values) return; //Hmm... 
	
		//Initializations 
		$xml_array = array(); 
		$parents = array(); 
		$opened_tags = array(); 
		$arr = array(); 
	
		$current = &$xml_array; 
	
		//Go through the tags. 
		foreach($xml_values as $data) { 
			
			unset($attributes,$value); //Remove existing values, or there will be trouble 
	
			//This command will extract these variables into the foreach scope 
			// tag, type, level(int), attributes(array). 
			extract($data);//We could use the array by itself, but this cooler. 
	
			$result = ''; 
			
			if($get_attributes) { //The second argument of the function decides this. 
				
				$result = array(); 
				if(isset($value)) $result['value'] = $value; 
	
				//Set the attributes too. 
				if(isset($attributes)) { 
					foreach($attributes as $attr => $val) { 
						if($get_attributes == 1) $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr' 
						/**  :TODO: should we change the key name to '_attr'? Someone may use the tagname 'attr'. Same goes for 'value' too */ 
					} 
				} 
				
			} elseif(isset($value)) { 
				$result = $value; 
			} 
	
			//See tag status and do the needed. 
			if($type == "open") { //The starting of the tag '<tag>' 
				
				$parent[$level-1] = &$current; 
	
				if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag 
					
					$current[$tag] = $result; 
					$current = &$current[$tag]; 
	
				} else { //There was another element with the same tag name 
					
					if(isset($current[$tag][0])) { 
						array_push($current[$tag], $result); 
					} else { 
						$current[$tag] = array($current[$tag],$result); 
					}
					
					$last = count($current[$tag]) - 1; 
					$current = &$current[$tag][$last]; 
					
				} 
	
			} elseif($type == "complete") { //Tags that ends in 1 line '<tag />' 
				
				//See if the key is already taken. 
				if(!isset($current[$tag])) { //New Key 
					
					$current[$tag] = $result; 
	
				} else { //If taken, put all things inside a list(array) 
					
					if((is_array($current[$tag]) and $get_attributes == 0)//If it is already an array... 
						or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $get_attributes == 1)) { 
						
						// ...push the new element into that array. 
						array_push($current[$tag],$result); 
					
					} else { //If it is not an array... 
						$current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value 
					} 
					
				} 
	
			} elseif($type == 'close') { //End of tag '</tag>' 
				$current = &$parent[$level-1]; 
			} 
		} 
	
		return($xml_array); 
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
*  Exclude Pages from the Navigation Menu
* ----------------------------------------------------------------------------------------------------------------------
*/

	function exclude_plugin_aem_pages_from_navmenu($exclude_array) {
		
		$results_page_slug = sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_RESULTS);
		$details_page_slug = sanitize_title(AEM_PLUGIN_TEMPLATE_PAGE_TITLE_DETAILS);
		
		// check if the pages has parent page & get the parent slug/permalink
		if(AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT != "") { 
			$parent_slug = AEM_PLUGIN_TEMPLATE_PAGE_SLUG_PARENT.'/'; 
		} else {
			$parent_slug = '';
		}
		
		$results_page_id = plugin_aem_get_ID_by_slug($parent_slug.$results_page_slug);
		$details_page_id = plugin_aem_get_ID_by_slug($parent_slug.$details_page_slug);
		
		return array_merge( $exclude_array, array( $results_page_id, $details_page_id  ) );		
				
	}	
	
	add_filter('wp_list_pages_excludes', 'exclude_plugin_aem_pages_from_navmenu');


/**
* ----------------------------------------------------------------------------------------------------------------------
*  Integrate the Media Library into a Plugin
* ----------------------------------------------------------------------------------------------------------------------
*/

	function wp_gear_manager_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery');
	}
	
	function wp_gear_manager_admin_styles() {
		wp_enqueue_style('thickbox');
	}
	
	add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
	add_action('admin_print_styles', 'wp_gear_manager_admin_styles');


/**
* ----------------------------------------------------------------------------------------------------------------------
*  WP Admin Plugin Setting Page
* ----------------------------------------------------------------------------------------------------------------------
*/

	function plugin_aem_settings_page() {
	?>
    
		<div class="wrap">
		
			<div class="icon32" id="icon-themes"><br></div>
			<h2 class="nav-tab-wrapper" style="border-bottom:none;"><?php echo AEM_PLUGIN_TITLE; ?></h2>
			
			<p>&nbsp;</p>
			
			<?php 
			// update the XML Settings
			if (isset($_POST["update_plugin_aem_settings"])){
			
				$errcount = 0;
				
				update_option('plugin_aem_option_api_key', $_POST["plugin_aem_option_api_key"]);
				
				if($_POST["plugin_aem_option_xml_agent_enable"]) {
					
					if($_POST["plugin_aem_option_xml_agent"] != "") {
						
						update_option('plugin_aem_option_xml_agent_enable', $_POST["plugin_aem_option_xml_agent_enable"]);
						update_option('plugin_aem_option_xml_agent', $_POST["plugin_aem_option_xml_agent"]);
					
					} else {
						echo '<div id="message" class="updated fade"><p><strong>';
						echo 'Error Saving Agent MLSID setting. MLSID is empty.';
						echo '</strong></p></div>';
						$errcount++;
					} 
					
				} else {
					update_option('plugin_aem_option_xml_agent_enable', 'No');
				}
				
				if($_POST["plugin_aem_option_limit"] >= 10 && $_POST["plugin_aem_option_limit"] <= 100) {
					update_option('plugin_aem_option_limit', $_POST["plugin_aem_option_limit"]);
				} else {
					echo '<div id="message" class="updated fade"><p><strong>';
					echo 'Error Saving LIMIT setting. Value should have a minimum value of 10 and maximum value of 100.';
					echo '</strong></p></div>';
					$errcount++;
				}
					
				if($errcount == 0) {	
					echo '<div id="message" class="updated fade"><p><strong>';
					echo 'Settings Saved.';
					echo '</strong></p></div>';
				}
				
			}
			
			// update the Neighborhoods array
			if (isset($_POST["update_xml_settings_neighborhoods"])){
			
				if(count($_POST["plugin_aem_option_xml_neighborhoods"]) > 0) {
					$plugin_aem_option_xml_neighborhoods_serialize = serialize($_POST["plugin_aem_option_xml_neighborhoods"]);
					$plugin_aem_option_xml_neighborhoods_serialize = htmlentities($plugin_aem_option_xml_neighborhoods_serialize,ENT_QUOTES);
					delete_option('plugin_aem_option_xml_neighborhoods_serialize');
					add_option('plugin_aem_option_xml_neighborhoods_serialize', $plugin_aem_option_xml_neighborhoods_serialize);
				}
						
				echo '<div id="message" class="updated fade"><p><strong>';
				echo 'Neighborhoods Updated.';
				echo '</strong></p></div>';

			}

			// update the Template Pages
			if (isset($_POST["update_template_pages"])){
			
				update_option('plugin_aem_option_template_page_base_search', $_POST["plugin_aem_option_template_page_base_search"]);
				update_option('plugin_aem_option_template_page_base_results', $_POST["plugin_aem_option_template_page_base_results"]);
				update_option('plugin_aem_option_template_page_base_details', $_POST["plugin_aem_option_template_page_base_details"]);
				
				update_option('plugin_aem_option_template_page_search', $_POST["plugin_aem_option_template_page_search"]);
				update_option('plugin_aem_option_template_page_results', $_POST["plugin_aem_option_template_page_results"]);
				update_option('plugin_aem_option_template_page_details', $_POST["plugin_aem_option_template_page_details"]);
						
				echo '<div id="message" class="updated fade"><p><strong>';
				echo 'Settings Saved.';
				echo '</strong></p></div>';
				
			}
			?>
			
			<form method="post" action="" name="form_update_plugin_aem_settings" id="form_update_plugin_aem_settings">
				<table cellspacing="0" class="widefat">
					<tr class="alternate">
						<th scope="row" colspan="2" style="background:#D7D7D7; font-size:14px;">Plugin Settings</th>
					</tr>
					<tr class="alternate">
						<th scope="row">Agent API Key</th>
						<td>
                        	<input type="text" name="plugin_aem_option_api_key" value="<?php echo get_option('plugin_aem_option_api_key'); ?>" style="border:1px solid #CCCCCC; width:800px;" />
                        	<span class="description" style="font-size:11px; font-style:normal; float:right;">You'll need an API key to use this plugin.</span>
                        </td>
					</tr>
					<tr class="alternate">
						<th scope="row">Agent MLSID</th>
						<td>
                            Enable: 
                            <input type="checkbox" name="plugin_aem_option_xml_agent_enable" id="plugin_aem_option_xml_agent_enable" value="Yes" onclick="javascript: checkAgentEnable();" <?php if(get_option('plugin_aem_option_xml_agent_enable') == "Yes") { echo 'checked="checked"'; } ?> style="border:1px solid #CCCCCC;" />
                        	&nbsp;&nbsp;
                            MLSID:
                            <input type="text" name="plugin_aem_option_xml_agent" id="plugin_aem_option_xml_agent" value="<?php echo get_option('plugin_aem_option_xml_agent'); ?>" style="border:1px solid #CCCCCC; width:200px;" />
                        	<span class="description" style="font-size:11px; font-style:normal; float:right;">XML agent: Agent MLSID</span>
                            <script language="JavaScript">
							function checkAgentEnable() {
								if(document.form_update_plugin_aem_settings.plugin_aem_option_xml_agent_enable.checked == true) {
									document.form_update_plugin_aem_settings.plugin_aem_option_xml_agent.disabled = false;
								} else {
									document.form_update_plugin_aem_settings.plugin_aem_option_xml_agent.disabled = true;
								}
							}
							checkAgentEnable();
                            </script> 
                        </td>
					</tr>
					<tr class="alternate">
						<th scope="row">Limit</th>
						<td>
                        	<input type="text" name="plugin_aem_option_limit" value="<?php echo get_option('plugin_aem_option_limit'); ?>" style="border:1px solid #CCCCCC; width:40px;" />
                        	<span class="description" style="font-size:11px; font-style:normal; float:right;">Number of results/listings to return per page, max is 100</span>
                        </td>
					</tr>
					<tr class="alternate">
						<td colspan="2">
                        	<input type="submit" class="button-primary" name="update_plugin_aem_settings" value="<?php _e('Save Changes') ?>" style="margin:10px auto;" />
                        </td>
					</tr>
				</table>
			</form>
			
			<br/><br/>
			
			<form method="post" action="" name="form_update_xml_settings_neighborhoods">
                <table cellspacing="0" class="widefat">
                    <tr class="alternate">
                        <th scope="row" style="background:#D7D7D7; font-size:14px;">Neighborhoods</th>
                    </tr>
					<tr class="alternate">
						<td style="text-align:left; padding:10px 5px;">
							<?php 
							$option_xml_neighborhoods = array();
							if(get_option('plugin_aem_option_xml_neighborhoods_serialize') != "") {
								$option_xml_neighborhoods = html_entity_decode(get_option('plugin_aem_option_xml_neighborhoods_serialize'),ENT_QUOTES);
								$option_xml_neighborhoods = unserialize($option_xml_neighborhoods);
							} 
							?>
							<?php if(count($option_xml_neighborhoods) > 0) {?>
                                <?php foreach($option_xml_neighborhoods as $neighborhood) { ?> 
                                    <div style="float:left; width:230px; text-align:left; margin:2px; padding:2px; border:1px solid #CCCCCC; text-align:left;">
                                        <input type="checkbox" name="plugin_aem_option_xml_neighborhoods[<?php echo $neighborhood['id']; ?>][enable]" value="Yes" title="Enable Neighborhood" <?php if($neighborhood['enable'] == "Yes") { echo 'checked="checked"'; } ?> style="border:1px solid #CCCCCC;"> 
                                        <input type="hidden" name="plugin_aem_option_xml_neighborhoods[<?php echo $neighborhood['id']; ?>][id]" value="<?php echo $neighborhood['id']; ?>" title="Neighborhood ID" style="border:1px solid #CCCCCC; width:50px;"> 
                                        <input type="hidden" name="plugin_aem_option_xml_neighborhoods[<?php echo $neighborhood['id']; ?>][title]" value="<?php echo $neighborhood['title']; ?>" title="Neighborhood Name" style="border:1px solid #CCCCCC; width:180px;"> 
                                        <input type="hidden" name="plugin_aem_option_xml_neighborhoods[<?php echo $neighborhood['id']; ?>][district]" value="<?php echo $neighborhood['district']; ?>" title="Neighborhood District" style="border:1px solid #CCCCCC; width:150px;"> 
                                        <?php echo $neighborhood['title']; ?>
                                    </div>	
                            	<?php } ?>
                            <?php } else { ?>
                                <span class="description">No Neighborhood.</span>
                            <?php } ?>	
                        </td>
					</tr>
                    <tr class="alternate">
                        <td style="padding:10px; text-align:left;">
                            <input type="submit" class="button-primary" name="update_xml_settings_neighborhoods" value="<?php _e('Save Changes') ?>" />
                        </td>
                    </tr>
            	</table>
            </form>
			
            <br/><br/>
            
			<form method="post" action="" name="form_update_template_pages">
				<table cellspacing="0" class="widefat">
					<tr class="alternate">
						<th scope="row" style="background:#D7D7D7; font-size:14px;" width="20%">Template Page</th>
						<th scope="row" style="background:#D7D7D7; font-size:14px;" >Permalink : &nbsp;<span class="description" style="font-style:normal; font-weight:normal;">Value should be the same with the Page Permalink where the Shortcode is placed</span></th>
						<th scope="row" style="background:#D7D7D7; font-size:14px;" width="20%">Shortcode</th>
					</tr>
					<tr class="alternate">
						<th>
							<a href="<?php echo get_option('plugin_aem_option_template_page_base_search'); ?>/<?php echo get_option('plugin_aem_option_template_page_search'); ?>/" style="font-size:13px;" target="_blank">
								<?php echo AEM_PLUGIN_TEMPLATE_PAGE_TITLE_SEARCH; ?>
							</a>
						</th>
						<td>
							<input type="text" name="plugin_aem_option_template_page_base_search" value="<?php echo get_option('plugin_aem_option_template_page_base_search'); ?>" style="border:1px solid #CCCCCC; width:400px;" />/
							<input type="text" name="plugin_aem_option_template_page_search" value="<?php echo get_option('plugin_aem_option_template_page_search'); ?>" style="border:1px solid #CCCCCC; width:200px;" />/
						</td>
						<td>
                             <?php echo AEM_PLUGIN_SHORTCODE_SEARCH; ?>
						</td>
					</tr>
					<tr class="alternate">
						<th>
							<a href="<?php echo get_option('plugin_aem_option_template_page_base_results'); ?>/<?php echo get_option('plugin_aem_option_template_page_results'); ?>/" style="font-size:13px;" target="_blank">
								<?php echo AEM_PLUGIN_TEMPLATE_PAGE_TITLE_RESULTS; ?>
							</a>
						</th>
						<td>
							<input type="text" name="plugin_aem_option_template_page_base_results" value="<?php echo get_option('plugin_aem_option_template_page_base_results'); ?>" style="border:1px solid #CCCCCC; width:400px;" />/
							<input type="text" name="plugin_aem_option_template_page_results" value="<?php echo get_option('plugin_aem_option_template_page_results'); ?>" style="border:1px solid #CCCCCC; width:200px;" />/
						</td>
						<td>
                             <?php echo AEM_PLUGIN_SHORTCODE_RESULTS; ?>
						</td>
					</tr>
					<tr class="alternate">
						<th>
							<a href="<?php echo get_option('plugin_aem_option_template_page_base_details'); ?>/<?php echo get_option('plugin_aem_option_template_page_details'); ?>/" style="font-size:13px;" target="_blank">
								<?php echo AEM_PLUGIN_TEMPLATE_PAGE_TITLE_DETAILS; ?>
							</a>
						</th>
						<td>
							<input type="text" name="plugin_aem_option_template_page_base_details" value="<?php echo get_option('plugin_aem_option_template_page_base_details'); ?>" style="border:1px solid #CCCCCC; width:400px;" />/
							<input type="text" name="plugin_aem_option_template_page_details" value="<?php echo get_option('plugin_aem_option_template_page_details'); ?>" style="border:1px solid #CCCCCC; width:200px;" />/
						</td>
						<td>
                            <?php echo AEM_PLUGIN_SHORTCODE_DETAILS; ?>
						</td>
					</tr>
					<tr class="alternate">
						<td colspan="3">
                            <input type="submit" class="button-primary" name="update_template_pages" value="<?php _e('Save Changes') ?>" style="margin:10px auto;" />
                        </td>
					</tr>
				</table>
			</form>
            
			<p>&nbsp;</p>

            <table cellspacing="0" class="widefat">
                <tr class="alternate">
                    <th scope="row" style="background:#D7D7D7; font-size:14px;" width="25%">Shortcodes</th>
                    <th scope="row" style="background:#D7D7D7; font-size:14px;">Description</th>
                </tr>
                <tr class="alternate">
                    <td>
                        <?php echo AEM_PLUGIN_SHORTCODE_MY_ACTIVE_PROPERTIES; ?>
                    </td>
                    <td>
                         When the Agent MLSID is supplied in the Plugin Settings and the Shortcode is on a page, it will display the auto feed of the Agents Active Listings.
                    </td>
                </tr>
                <tr class="alternate">
                    <td>
                        <?php echo AEM_PLUGIN_SHORTCODE_MY_SOLD_PROPERTIES; ?>
                    </td>
                    <td>
                         When the Agent MLSID is supplied in the Plugin Settings and the Shortcode is on a page, it will display the auto feed of the Agents Sold Listings.
                    </td>
                </tr>
            </table>

			<p>&nbsp;</p>
            
			<h2 class="title" style="font-size:20px; padding-top:0px;">
				Usage: 
				<span style="font-size:12px; font-style:normal;">Add the trigger text (Shortcode) to the page content to display the template. By default, the pages with shortcode are created already on plugin activation.</span>
			</h2>
            
			<p>&nbsp;</p>
				
		</div>
	
	<?php 
	} 
	
	
/**
* ----------------------------------------------------------------------------------------------------------------------
*  WP Admin Plugin Properties Page
* ----------------------------------------------------------------------------------------------------------------------
*/

	function plugin_aem_properties_page() {
	?>
    
		<div class="wrap">
		
			<div class="icon32" id="icon-themes"><br></div>
			<h2 class="nav-tab-wrapper" style="border-bottom:none;">Properties</h2>
			
			<p>&nbsp;</p>
			
			<p>&nbsp;</p>
				
		</div>
	
	<?php 
	} 


/**
* ----------------------------------------------------------------------------------------------------------------------
*  Agent Information Widget
* ----------------------------------------------------------------------------------------------------------------------
*/
	
	add_action("widgets_init", array('Widget_aem_agent_information', 'register'));
	
	register_activation_hook( __FILE__, array('Widget_aem_agent_information', 'activate'));
	register_deactivation_hook( __FILE__, array('Widget_aem_agent_information', 'deactivate'));
	
	class Widget_aem_agent_information {
	
	 	 function activate(){
		
			$data = array('widgetTitle' => 'Contact Info',  
						  'agentMLSID' => '',
						  'agentImage' => '',
						  'agentName' => '',
						  'agentFax' => '',
						  'agentDRE' => '',
						  'agentPhone' => '',
						  'agentMobile' => '',
						  'agentEmail' => '',
						  'agentWebsite' => '',
						  'agentOffice' => '',
						  'agent1name' => '',
						  'agent1phone' => '',
						  'agent2name' => '',
						  'agent2phone' => '',
						  'agentAddress' => '');
		
			if ( ! get_option('widget_aem_agent_information')){
		  		add_option('widget_aem_agent_information' , $data);
				#echo "add widget options";
			} else {
		  		#update_option('widget_aem_agent_information' , $data);
				#echo "update widget options";
			}
			
	  	}
	  
	  	function deactivate(){
			#delete_option('widget_aem_agent_information');
			#echo "delete widget options";
	  	}
	  
	  	function control(){
	  
			$data = get_option('widget_aem_agent_information');
		  
			?>
			<p><label>Title: <br /><input class="widefat" name="widget_aem_agent_information_widgetTitle" type="text" value="<?php echo $data['widgetTitle']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
			<?php /*?>
            <p><label>Agent MLSID: <br /><input class="widefat" name="widget_aem_agent_information_agentMLSID" type="text" value="<?php echo $data['agentMLSID']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
			<?php */?>
            <p><label>Agent Name: <br /><input class="widefat" name="widget_aem_agent_information_agentName" type="text" value="<?php echo $data['agentName']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
			
            <p>
				<script language="JavaScript">
                jQuery(document).ready(function() {
                
                    var uploadID = ''; /*setup the var in a global scope*/
                
                    jQuery('.upload-button').click(function() {
                        uploadID = jQuery(this).prev('input'); /*set the uploadID variable to the value of the input before the upload button*/
                        formfield = jQuery('.upload').attr('name');
                        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                        return false;
                    });
                
                    window.send_to_editor = function(html) {
                        imgurl = jQuery('img',html).attr('src');
                        uploadID.val(imgurl); /*assign the value of the image src to the input*/
                        tb_remove();
                    };
                });
                </script>
                <label>
                    Image URL: 
                    <br />
                    <input class="widefat" name="widget_aem_agent_information_agentImage" type="text" value="<?php echo $data['agentImage']; ?>" style="border: 1px solid #CCCCCC;"  class="upload" />
                  	<input class="upload-button" name="wsl-image-add" type="button" value="Upload Image" />  
                </label>
            </p>
            <p><label>DRE#: <br /><input class="widefat" name="widget_aem_agent_information_agentDRE" type="text" value="<?php echo $data['agentDRE']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
            <p><label>Mobile#: <br /><input class="widefat" name="widget_aem_agent_information_agentMobile" type="text" value="<?php echo $data['agentMobile']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
			<p><label>Phone#: <br /><input class="widefat" name="widget_aem_agent_information_agentPhone" type="text" value="<?php echo $data['agentPhone']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
            			<p><label>Fax#: <br /><input class="widefat" name="widget_aem_agent_information_agentFax" type="text" value="<?php echo $data['agentFax']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
            	
			<p><label>Email: <br /><input class="widefat" name="widget_aem_agent_information_agentEmail" type="text" value="<?php echo $data['agentEmail']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
			<p><label>Website: <br /><input class="widefat" name="widget_aem_agent_information_agentWebsite" type="text" value="<?php echo $data['agentWebsite']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
			<p><label>Office/Company Name: <br /><input class="widefat" name="widget_aem_agent_information_agentOffice" type="text" value="<?php echo $data['agentOffice']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
			<p><label>Address: <br /><textarea class="widefat" rows="4" cols="20" name="widget_aem_agent_information_agentAddress" style="border: 1px solid #CCCCCC;"><?php echo $data['agentAddress']; ?></textarea></label></p>
            
           <p> Teams</p>
<p>            Agent #1 (left)</p>
          <p><label>Name: <br /><input class="widefat" name="widget_aem_agent_information_agent1name" type="text" value="<?php echo $data['agent1name']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
            <p><label>Phone: <br /><input class="widefat" name="widget_aem_agent_information_agent1phone" type="text" value="<?php echo $data['agent1phone']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
<p>            Agent #1 (right)</p>
           <p><label>Name: <br /><input class="widefat" name="widget_aem_agent_information_agent2name" type="text" value="<?php echo $data['agent2name']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
            <p><label>Phone: <br /><input class="widefat" name="widget_aem_agent_information_agent2phone" type="text" value="<?php echo $data['agent2phone']; ?>" style="border: 1px solid #CCCCCC;" /></label></p>
            
           
			<?php
		  
			if (isset($_POST['widget_aem_agent_information_widgetTitle'])){
			
				$data['widgetTitle'] = attribute_escape($_POST['widget_aem_agent_information_widgetTitle']);
				$data['agentMLSID'] = attribute_escape($_POST['widget_aem_agent_information_agentMLSID']);
				$data['agentImage'] = attribute_escape($_POST['widget_aem_agent_information_agentImage']);
				$data['agentName'] = attribute_escape($_POST['widget_aem_agent_information_agentName']);
				$data['agentPhone'] = attribute_escape($_POST['widget_aem_agent_information_agentPhone']);
				$data['agentMobile'] = attribute_escape($_POST['widget_aem_agent_information_agentMobile']);
				$data['agentFax'] = attribute_escape($_POST['widget_aem_agent_information_agentFax']);
				$data['agentDRE'] = attribute_escape($_POST['widget_aem_agent_information_agentDRE']);
				$data['agentEmail'] = attribute_escape($_POST['widget_aem_agent_information_agentEmail']);
				$data['agentWebsite'] = attribute_escape($_POST['widget_aem_agent_information_agentWebsite']);
				$data['agentOffice'] = attribute_escape($_POST['widget_aem_agent_information_agentOffice']);
				$data['agent1name'] = attribute_escape($_POST['widget_aem_agent_information_agent1name']);
				$data['agent1phone'] = attribute_escape($_POST['widget_aem_agent_information_agent1phone']);
				$data['agent2name'] = attribute_escape($_POST['widget_aem_agent_information_agent2name']);
				$data['agent2phone'] = attribute_escape($_POST['widget_aem_agent_information_agent2phone']);
				$data['agentAddress'] = attribute_escape($_POST['widget_aem_agent_information_agentAddress']);
				
				update_option('widget_aem_agent_information', $data);
		  
			}
			
			#print_r($_POST);
			#print_r($data);
		
	  	}
	  
	  	function widget($args){
	  
	  		$wp_plugin_aem_params = wp_plugin_aem_params();
			$data = get_option('widget_aem_agent_information');
				
			#if($data['agentMLSID'] != '') {
				
				ob_start();
				require_once(AEM_PLUGIN_PATH.'/template-widget-agent-information.php');
				$agent_information = ob_get_contents();
				ob_end_clean();
				
				echo $args['before_widget'];
				
				if($data['widgetTitle'] != '') {
					echo $args['before_title'] . $data['widgetTitle'] . $args['after_title'];
				}
							
				echo $agent_information;
				echo $args['after_widget'];
		
			#}
			
	  	}
	  
	  	function register(){
			register_sidebar_widget('Agent Information', array('Widget_aem_agent_information', 'widget'));
			register_widget_control('Agent Information', array('Widget_aem_agent_information', 'control'));
	  	}
	  
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
* Cleans a string for input into a MySQL Database.
* Gets rid of unwanted characters/SQL injection etc.
* ----------------------------------------------------------------------------------------------------------------------
*/
	
	function aem_clean($str){
	
		// Only remove slashes if it's already been slashed by PHP
		#if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		#}
		
		// Let MySQL remove nasty characters.
		$str = mysql_real_escape_string($str);
		
		return $str;
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
* This function will set & get date 
* ----------------------------------------------------------------------------------------------------------------------
*/

	 function aem_formatDate($dateFormat="g:ia \o\\n\ F j, Y", $dateValue) {
		
		$dated = str_replace(array(" ",":"),"-",$dateValue);
		list($year,$month,$day,$hour,$minute,$seconds) = explode("-",$dated);
		
		// you can edit this line to display date/time in your preferred notation
		$niceday = @date($dateFormat,mktime($hour,$minute,$seconds,$month,$day,$year));
		
		return $niceday;
	}


/**
* ----------------------------------------------------------------------------------------------------------------------
* This function will get the wp post attachment ID from an Image Src
* ----------------------------------------------------------------------------------------------------------------------
*/

	function aem_get_attachment_id_from_src($image_src) {
		
		global $wpdb;
		
		$attachment_id = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE guid = '$image_src' LIMIT 1");
	 
		if($attachment_id == null){
			$image_src = basename ( $image_src );
			$id = $wpdb->get_var("SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attachment_metadata' AND meta_value LIKE '%$image_src%' LIMIT 1");
		}
		
		if($attachment_id == null){
			$attachment_id = 0;
		}
		
		return $attachment_id;
		
	} 


?>