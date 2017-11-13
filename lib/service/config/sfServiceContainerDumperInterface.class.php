<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfServiceContainerDumperInterface dumps the given sfServiceContainerBuilder state
 * to specific format string representation (to be stored to filesystem).
 *
 * @package    symfony
 * @subpackage service
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Ivan Voskoboinyk <ivan.voskoboinyk@gmail.com>
 */
interface sfServiceContainerDumperInterface
{
  /**
   * Dump sfServiceContainerBuilder state to string representation.
   *
   * @param \sfServiceContainerBuilder $builder
   *
   * @return string
   */
  public function dump(sfServiceContainerBuilder $builder);

}