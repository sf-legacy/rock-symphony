<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004-2006 Sean Kerr <sean@code-box.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfConfigHandler allows a developer to create a custom formatted configuration
 * file pertaining to any information they like and still have it auto-generate
 * PHP code.
 *
 * @package    symfony
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <sean@code-box.org>
 * @version    SVN: $Id$
 */
abstract class sfConfigHandler
{
  /** @var sfParameterHolder */
  protected $parameterHolder = null;

  /**
   * Class constructor.
   *
   * @param array|null $parameters
   */
  public function __construct(array $parameters = null)
  {
    $this->parameterHolder = new sfParameterHolder();
    $this->parameterHolder->add($parameters);
  }

  /**
   * Executes this configuration handler
   *
   * @param array $configFiles An array of filesystem path to a configuration file
   *
   * @return string Data to be written to a cache file
   *
   * @throws <b>sfConfigurationException</b> If a requested configuration file does not exist or is not readable
   * @throws <b>sfParseException</b> If a requested configuration file is improperly formatted
   */
  abstract public function execute(array $configFiles): string;

  /**
   * Replaces constant identifiers in a value.
   *
   * If the value is an array replacements are made recursively.
   *
   * @param mixed $value The value on which to run the replacement procedure
   *
   * @return string|mixed|array The new value
   */
  static public function replaceConstants($value)
  {
    if (is_array($value))
    {
      array_walk_recursive($value, function(& $value) { $value = sfToolkit::replaceConstants($value); });
    }
    else
    {
      $value = sfToolkit::replaceConstants($value);
    }

    return $value;
  }

  /**
   * Replaces a relative filesystem path with an absolute one.
   *
   * @param array|string $path A relative filesystem path
   *
   * @return string The new path
   */
  static public function replacePath(string $path): string
  {
    if (!sfToolkit::isPathAbsolute($path))
    {
      // not an absolute path so we'll prepend to it
      return sfConfig::get('sf_app_dir').'/'.$path;
    }

    return $path;
  }

  /**
   * Gets the parameter holder for this configuration handler.
   *
   * @return sfParameterHolder A sfParameterHolder instance
   */
  public function getParameterHolder(): sfParameterHolder
  {
    return $this->parameterHolder;
  }

  /**
   * Returns the configuration for the current config handler.
   *
   * @param array $configFiles An array of ordered configuration files
   * @return array
   * @throws LogicException no matter what
   */
  static public function getConfiguration(array $configFiles): array
  {
    throw new LogicException('You must call the ::getConfiguration() method on a concrete config handler class');
  }
}
