<?php
/**
 * Parsedown plugin for Craft CMS 3.x
 *
 * Adds Parsedown, the PHP Markdown parser to Craft CMS.
 *
 * @link      https://wesleyluyten.com
 * @copyright Copyright (c) 2017 Wesley Luyten
 */

namespace luwes\parsedown\twigextensions;

use luwes\parsedown\Parsedown;

use Craft;
use craft\helpers\Template;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Wesley Luyten
 * @package   Parsedown
 * @since     1.0.0
 */
class ParsedownTwigExtension extends \Twig_Extension
{
	// Public Methods
	// =========================================================================

	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName()
	{
		return 'Parsedown';
	}

	/**
	 * Returns an array of Twig filters, used in Twig templates via:
	 *
	 *      {{ 'something' | someFilter }}
	 *
	 * @return array
	 */
	public function getFilters()
	{
		$parsedownFilter = new \Twig_SimpleFilter('parsedown', [$this, 'parsedown']);
		return [
			"parsedown" => $parsedownFilter,
			"pd" => $parsedownFilter,
		];
	}

	/**
	 * Returns an array of Twig functions, used in Twig templates via:
	 *
	 *      {% set this = someFunction('something') %}
	 *
	* @return array
	 */
	public function getFunctions()
	{
		return [
			new \Twig_SimpleFunction('parsedown', [$this, 'parsedown']),
		];
	}

	/**
	 * Our function called via Twig; it can do anything you want
	 *
	 * @param null $text
	 *
	 * @return string
	 */
	public function parsedown($text = null, $parseAs = 'text')
	{
		if ($parseAs == 'line')
		{
			$parsed = Parsedown::$plugin->parsedown->parseLine($text);
		}
		else
		{
			$parsed = Parsedown::$plugin->parsedown->parseText($text);
		}

		return Template::raw($parsed);
	}
}
