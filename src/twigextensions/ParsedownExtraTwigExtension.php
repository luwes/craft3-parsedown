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
class ParsedownExtraTwigExtension extends \Twig_Extension
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
		return 'ParsedownExtra';
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
		$parsedownExtraFilter = new \Twig_SimpleFilter('parsedownExtra', [$this, 'parsedownExtra']);
		return [
			"parsedownExtra" => $parsedownExtraFilter,
			"pde" => $parsedownExtraFilter,
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
			new \Twig_SimpleFunction('parsedownExtra', [$this, 'parsedownExtra']),
		];
	}

	/**
	 * Our function called via Twig; it can do anything you want
	 *
	 * @param null $text
	 *
	 * @return string
	 */
	public function parsedownExtra($text = null, $parseAs = 'text')
	{
		if ($parseAs == 'line')
		{
			$parsed = Parsedown::$plugin->parsedownExtra->parseLine($text);
		}
		else
		{
			$parsed = Parsedown::$plugin->parsedownExtra->parseText($text);
		}

		return Template::raw($parsed);
	}
}
