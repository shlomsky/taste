<?php
/**
* BreezingForms - A Joomla Forms Application
* @version 1.7.1
* @package BreezingForms
* @copyright (C) 2008-2010 by Markus Bopp
* @license Released under the terms of the GNU General Public License
**/
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The main loader
 *
 * @param string $class
 */
function breezingformsClassLoader($class){
	
	switch($class){

                case 'BFText':
			require_once(JPATH_SITE . '/administrator/components/com_breezingforms/libraries/crosstec/classes/BFText.php');
			break;

		/**
		 * Common "Moses"
		 */
		case 'mosMainFrame':
			require_once(JPATH_SITE . '/plugins/system/legacy/mainframe.php');
			break;
			
		case 'mosMenu':
			require_once(JPATH_SITE . '/plugins/system/legacy/menu.php');
			break;
			
		case 'mosParameters':
			require_once(JPATH_SITE . '/plugins/system/legacy/parameters.php');
			break;
			
		case 'mosDBTable':
			require_once(JPATH_SITE . '/plugins/system/legacy/dbtable.php');
			break;
			
		case 'mosUser':
			require_once(JPATH_SITE . '/plugins/system/legacy/user.php');
			break;
		
		case 'mosCommonHTML':
			require_once(JPATH_SITE . '/plugins/system/legacy/commonhtml.php');
			break;
			
		case 'mosHTML':
			require_once(JPATH_SITE . '/plugins/system/legacy/html.php');
			break;
		
		case 'mosMambotHandler':
			require_once(JPATH_SITE . '/plugins/system/legacy/mambothandler.php');
			break;

		case 'database':
			require_once(JPATH_SITE . '/plugins/system/legacy/mysql.php');
			break;			
			
		/**
		 * Common J! 1.5 Classes
		 */
			   
		case 'JRecordSet':
			require_once(JPATH_SITE . '/libraries/joomla/database/recordset.php');
			break;
		case 'JLog':
			require_once(JPATH_SITE . '/libraries/joomla/error/log.php');
			break;
		case 'JClientHelper':
			require_once(JPATH_SITE . '/libraries/joomla/client/helper.php');
			break;
		case 'JVersion':
			require_once(JPATH_SITE . '/libraries/joomla/version.php');
			break;
		case 'JModuleHelper':
			require_once(JPATH_SITE . '/libraries/joomla/application/module/helper.php');
			break;
		case 'JDocumentRenderer':
			require_once(JPATH_SITE . '/libraries/joomla/document/renderer.php');
			break;
		case 'JTree':
			require_once(JPATH_SITE . '/libraries/joomla/base/tree.php');
			break;
		case 'JRoute':
			require_once(JPATH_SITE . '/libraries/joomla/methods.php');
			break;
		case 'JHTML':
			require_once(JPATH_SITE . '/libraries/joomla/html/html.php');
			break;
		case 'JPathway':
			require_once(JPATH_SITE . '/libraries/joomla/application/pathway.php');
			break;
		case 'JResponse':
			require_once(JPATH_SITE . '/libraries/joomla/environment/response.php');
			break;
		case 'JController':
			require_once(JPATH_SITE . '/libraries/joomla/application/component/controller.php');
			break;
		case 'JModel':
			require_once(JPATH_SITE . '/libraries/joomla/application/component/model.php');
			break;
		case 'JURI':
			require_once(JPATH_SITE . '/libraries/joomla/environment/uri.php');
			break;
		case 'JRouter':
			require_once(JPATH_SITE . '/libraries/joomla/application/router.php');
			break;
		case 'JMenu':
			require_once(JPATH_SITE . '/libraries/joomla/application/menu.php');
			break;
		case 'JSimpleXML':
			require_once(JPATH_SITE . '/libraries/joomla/utilities/simplexml.php');
			break;
		case 'JRegistryFormat':
			require_once(JPATH_SITE . '/libraries/joomla/registry/format.php');
			break;
		case 'JDocument':
			require_once(JPATH_SITE . '/libraries/joomla/document/document.php');
			break;
		case 'JView':
			require_once(JPATH_SITE . '/libraries/joomla/application/component/view.php');
			break;
		case 'JDate':
			require_once(JPATH_SITE . '/libraries/joomla/utilities/date.php');
			break;
		case 'JAuthorization':
			require_once(JPATH_SITE . '/libraries/joomla/user/authorization.php');
			break;
		case 'JText':
			require_once(JPATH_SITE . '/libraries/joomla/methods.php');
			break;
		case 'JString':
			require_once(JPATH_SITE . '/libraries/joomla/utilities/string.php');
			break;
		case 'JArrayHelper':
			require_once(JPATH_SITE . '/libraries/joomla/utilities/arrayhelper.php');
			break;
		case 'JCache':
			require_once(JPATH_SITE . '/libraries/joomla/cache/cache.php');
			break;
		case 'JCacheStorage':
			require_once(JPATH_SITE . '/libraries/joomla/cache/storage.php');
			break;
		case 'JPluginHelper':
			require_once(JPATH_SITE . '/libraries/joomla/plugin/helper.php');
			break;
		case 'JAuthentication':
			require_once(JPATH_SITE . '/libraries/joomla/user/authentication.php');
			break;
		case 'JUserHelper':
			require_once(JPATH_SITE . '/libraries/joomla/user/helper.php');
			break;
		case 'JRequest':
			require_once(JPATH_SITE . '/libraries/joomla/environment/request.php');
			break;
		case 'JFactory':
			require_once(JPATH_SITE . '/libraries/joomla/factory.php');
			break;
		case 'JApplication':
			require_once(JPATH_SITE . '/libraries/joomla/application/application.php');
			break;
		case 'JObject':
			require_once(JPATH_SITE . '/libraries/joomla/base/object.php');
			break;
		case 'JApplicationHelper':
			require_once(JPATH_SITE . '/libraries/joomla/application/helper.php');
			break;
		case 'JRegistry':
			require_once(JPATH_SITE . '/libraries/joomla/registry/registry.php');
			break;
		case 'JUtility':
			require_once(JPATH_SITE . '/libraries/joomla/utilities/utility.php');
			break;
		case 'JSession':
			require_once(JPATH_SITE . '/libraries/joomla/session/session.php');
			break;
		case 'JSessionStorage':
			require_once(JPATH_SITE . '/libraries/joomla/session/storage.php');
			break;
		case 'JFilterInput':
			require_once(JPATH_SITE . '/libraries/joomla/filter/filterinput.php');
			break;
		case 'JDatabase':
			require_once(JPATH_SITE . '/libraries/joomla/database/database.php');
			break;
		case 'JError':
			require_once(JPATH_SITE . '/libraries/joomla/error/error.php');
			break;
		case 'JTable':
			require_once(JPATH_SITE . '/libraries/joomla/database/table.php');
			break;
		case 'JPath':
			require_once(JPATH_SITE . '/libraries/joomla/filesystem/path.php');
			break;
		case 'JUser':
			require_once(JPATH_SITE . '/libraries/joomla/user/user.php');
			break;
		case 'JParameter':
			require_once(JPATH_SITE . '/libraries/joomla/html/parameter.php');
			break;
		case 'JComponentHelper':
			require_once(JPATH_SITE . '/libraries/joomla/application/component/helper.php');
			break;
		case 'JLanguage':
			require_once(JPATH_SITE . '/libraries/joomla/language/language.php');
			break;
		case 'JFolder':
			require_once(JPATH_SITE . '/libraries/joomla/filesystem/folder.php');
			break;
		case 'JPlugin':
			require_once(JPATH_SITE . '/libraries/joomla/plugin/plugin.php');
			break;
		case 'JEvent':
			require_once(JPATH_SITE . '/libraries/joomla/event/event.php');
			break;
		case 'JObserver':
			require_once(JPATH_SITE . '/libraries/joomla/base/observer.php');
			break;
		case 'JObservable':
			require_once(JPATH_SITE . '/libraries/joomla/base/observable.php');
			break;
		case 'JDispatcher':
			require_once(JPATH_SITE . '/libraries/joomla/event/dispatcher.php');
			break;
		case 'JException':
			require_once(JPATH_SITE . '/libraries/joomla/error/exception.php');
			break;
		case 'JPaneTabs':
			require_once(JPATH_SITE . '/libraries/joomla/html/pane.php');
			break;
		case 'JPagination':
			require_once(JPATH_SITE . '/libraries/joomla/html/pagination.php');
			break;
		case 'JFilterOutput':
			require_once(JPATH_SITE . '/libraries/joomla/filter/filteroutput.php');
			break;
		case 'JEditor':
			require_once(JPATH_SITE . '/libraries/joomla/html/editor.php');
			break;
		case 'JSessionStorageDatabase':
			require_once(JPATH_SITE . '/libraries/joomla/session/storage/database.php');
			break;
		case 'JDatabaseMySQL':
			require_once(JPATH_SITE . '/libraries/joomla/database/database/mysql.php');
			break;
		case 'JMailHelper':
			require_once(JPATH_SITE . '/libraries/joomla/mail/helper.php');
			break;
		case 'JMail':
			require_once(JPATH_SITE . '/libraries/joomla/mail/mail.php');
			break;
		case 'JTableCategory':
			require_once(JPATH_SITE . '/libraries/joomla/database/table/category.php');
			break;	
		case 'JTableComponent':
			require_once(JPATH_SITE . '/libraries/joomla/database/table/component.php');
			break;
		case 'JTableContent':
			require_once(JPATH_SITE . '/libraries/joomla/database/table/content.php');
			break;
		case 'JTablePlugin':
			require_once(JPATH_SITE . '/libraries/joomla/database/table/plugin.php');
			break;
		case 'JTableMenu':
			require_once(JPATH_SITE . '/libraries/joomla/database/table/menu.php');
			break;
		case 'JTableModule':
			require_once(JPATH_SITE . '/libraries/joomla/database/table/module.php');
			break;
		case 'JDatabaseMySQLi':
			require_once(JPATH_SITE . '/libraries/joomla/database/database/mysqli.php');
			break;
		case 'JDatabaseMySQL':
			require_once(JPATH_SITE . '/libraries/joomla/database/database/mysql.php');
			break;
		case 'JTableSection':
			require_once(JPATH_SITE . '/libraries/joomla/database/table/section.php');
			break;
		case 'JTableUser':
			require_once(JPATH_SITE . '/libraries/joomla/database/table/user.php');
			break;
		case 'JInstaller':
			require_once(JPATH_SITE . '/libraries/joomla/installer/installer.php');
			break;	
		case 'JToolBar':
			require_once(JPATH_SITE . '/libraries/joomla/html/toolbar.php');
			break;		
		case 'JBrowser':
			require_once(JPATH_SITE . '/libraries/joomla/environment/browser.php');
			break;	
		case 'JToolbarHelper':
			require_once(JPATH_SITE . '/administrator/includes/toolbar.php');
			break;
		case 'JProfiler':
			require_once(JPATH_SITE . '/libraries/joomla/error/profiler.php');
			break;	
		case 'JElement':
			require_once(JPATH_SITE . '/libraries/joomla/html/parameter/element.php');
			break;	
		case 'JFile':
			require_once(JPATH_SITE . '/libraries/joomla/filesystem/file.php');
			break;	
		case 'JButton':
			require_once(JPATH_SITE . '/libraries/joomla/html/toolbar/button.php');
			break;
		case 'JLanguageHelper':
			require_once(JPATH_SITE . '/libraries/joomla/language/helper.php');
			break;
		case 'JoomFishVersion':
			require_once(JPATH_SITE . '/administrator/components/com_joomfish/version.php');
			break;
		case 'JoomFish':
			require_once(JPATH_SITE . '/components/com_joomfish/helpers/joomfish.class.php');
			break;
		case 'JFTP':
			if(file_exists(JPATH_SITE . '/libraries/joomla/client/client.php')){
				require_once(JPATH_SITE . '/libraries/joomla/client/client.php');
			}
			else if(file_exists(JPATH_SITE . '/libraries/joomla/client/ftp.php')){
				require_once(JPATH_SITE . '/libraries/joomla/client/ftp.php');
			}
			break;
		case 'JPath':
			require_once(JPATH_SITE . '/libraries/joomla/filesystem/path.php');
			break;
		case 'JArchive':
			require_once(JPATH_SITE . '/libraries/joomla/filesystem/archive.php');
			break;
		case 'JoomFishManager':  
            require_once(JPATH_SITE . '/administrator/components/com_joomfish/classes/JoomfishManager.class.php');  
            break; 
	}
}

spl_autoload_register(null, false);
spl_autoload_register('breezingformsClassLoader');
spl_autoload_register('__autoload');
?>