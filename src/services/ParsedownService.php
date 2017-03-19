<?php
/**
 * Parsedown plugin for Craft CMS 3.x
 *
 * Adds Parsedown, the PHP Markdown parser to Craft CMS.
 *
 * @link      https://wesleyluyten.com
 * @copyright Copyright (c) 2017 Wesley Luyten
 */

namespace luwes\parsedown\services;

use Craft;
use craft\base\Component;

use Parsedown;

/**
 * ParsedownService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Wesley Luyten
 * @package   Parsedown
 * @since     1.0.0
 */
class ParsedownService extends Component
{
	/**
	 * Parses some text.
	 *
	 * @param string $text
	 * @return string
	 */
	public function parseText($text)
	{
		return $this->_getParsedown()->text($text);
	}
	/**
	 * Parses a single line, without wrapping it in <p>.
	 *
	 * @param string $line
	 * @return string
	 */
	public function parseLine($line)
	{
		return $this->_getParsedown()->line($line);
	}
	/**
	 * Returns a new Parsedown instance.
	 *
	 * @access private
	 * @return \Parsedown
	 */
	private function _getParsedown()
	{
		return new Parsedown();
	}
}
