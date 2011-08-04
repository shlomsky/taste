<?php
/**
* @package   YOOtweet Module
* @file      helper.php
* @version   1.5.4 April 2009
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2009 YOOtheme GmbH
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class modYOOtweetHelper {

	function getFeed(&$params) {

		// set options
		$options['rssUrl'] = modYOOtweetHelper::getFeedLink($params);
		$options['cache_time'] = 300; // to play nice with the twitter api use 5 minutes cache
		
		// clean feed cache manually, to fix caching issue
		$cache = JPATH_BASE.DS.'cache'.DS.md5($options['rssUrl']).'.spc';
		if (file_exists($cache) && time() - filemtime($cache) > $options['cache_time']) {
			@unlink($cache);
		}

		// get feed from twitter
		$atom =& JFactory::getXMLparser('atom', $options);
		$feed = false;

		if ($atom != false) {
			$feed = new stdclass();
			$feed->title = $atom->get_title();
			$feed->link = $atom->get_link();
			$feed->items = array_slice($atom->get_items(), 0, $params->get('num_tweets', 5));
			$feed->timeline = JString::strpos($options['rssUrl'], 'user_timeline') !== false;
			$feed->from_user = 'http://twitter.com/'.$params->get('from_user');
		}

		return $feed;
	}

	function getFeedLink(&$params) {
		
		// build query
		$query = array();
		
		if ($from_user = $params->get('from_user')) {
			$query[] = 'from%3A'.$from_user;
		}

		if ($to_user = $params->get('to_user')) {
			$query[] = 'to%3A'.$to_user;
		}

		if ($ref_user = $params->get('ref_user')) {
			$query[] = '%40'.$ref_user;
		}

		if ($hashtag = $params->get('hashtag')) {
			$query[] = '%23'.$hashtag;
		}

		if ($word = $params->get('word')) {
			$query[] = $word;
		}
	
		// build timeline link
		if ($from_user && !$to_user && !$ref_user && !$hashtag && !$word) {

			$num  = min(intval($params->get('num_tweets', 5)), 100);
			$link = 'http://twitter.com/statuses/user_timeline/'.JString::strtolower($from_user).'.atom';

			if ($num > 15) {
				$link .= '?count='.$num;
			}

			return $link;
		}
		
		// build search link
		if (count($query)) {
		
			$num  = min(intval($params->get('num_tweets', 5)), 100);
			$link = 'http://search.twitter.com/search.atom?q='.implode('+', $query);

			if ($num > 15) {
				$link .= '&rpp='.$num;
			}

			return $link;
		}
		
		return null;	
	}

	function getRelativeTime($date) {
		
		// init vars
		$now  =& JFactory::getDate();
		$date =& JFactory::getDate(strtotime($date) + ($now->toUnix() - time()));
		$diff = $now->toUnix() - $date->toUnix();

		if ($diff < 60) {
			return JText::_('less than a minute ago');
		} else if ($diff < 120) {
			return JText::_('about a minute ago');
		} else if ($diff < (45 * 60)) {
			return JText::sprintf('%s minutes ago', round($diff / 60));
		} else if ($diff < (90 * 60)) {
			return JText::_('about an hour ago');
		} else if ($diff < (24 * 3600)) {
			return JText::sprintf('about %s hours ago', round($diff / 3600));
		}
		
		return JHTML::_('date', $date->toUnix(), JText::_('DATE_FORMAT_LC2'));
	}

	function getAuthor($feed, $item) {
		$author = $item->get_author();

		if ($feed->timeline) {
			$author->link = $feed->from_user;
		}
		
		return $author;
	}

	function getText($feed, $item) {
		$text = str_replace('&apos;', "'", $item->get_content());

		if ($feed->timeline) {
			
			// remove name prefix
			$text = JString::substr($text, JString::strpos($text, ':') + 2);

			// link url
			$text = preg_replace_callback('#([\s>])([\w]+?://[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', array('modYOOtweetHelper', 'linkUrl'), $text);			
	
			// link profiles
			$text = preg_replace_callback('/@([a-zA-Z0-9_]{1,15})([) ])/', array('modYOOtweetHelper', 'linkProfile'), $text);			
		}

		return $text;			
	}

	function linkUrl($matches) {
		return $matches[1].'<a href="'.$matches[2].'">'.$matches[2].'</a>';
	}
	
	function linkProfile($matches) {
		return '<a href="http://twitter.com/'.$matches[1].'">@'.$matches[1].'</a>'.$matches[2];
	}
	
}