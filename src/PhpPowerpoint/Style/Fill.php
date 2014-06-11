<?php
/**
 * This file is part of PHPPowerPoint - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPowerPoint is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPPowerPoint
 * @copyright   2009-2014 PHPPowerPoint contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpPowerpoint\Style;

use \PhpOffice\PhpPowerpoint\IComparable;
use \PhpOffice\PhpPowerpoint\Style\Color;

/**
 * PHPPowerPoint_Style_Fill
 *
 * @category   PHPPowerPoint
 * @package    PHPPowerPoint_Style
 * @copyright  Copyright (c) 2009 - 2010 PHPPowerPoint (http://www.codeplex.com/PHPPowerPoint)
 */
class Fill implements IComparable
{
    /* Fill types */
    const FILL_NONE                         = 'none';
    const FILL_SOLID                        = 'solid';
    const FILL_GRADIENT_LINEAR              = 'linear';
    const FILL_GRADIENT_PATH                = 'path';
    const FILL_PATTERN_DARKDOWN             = 'darkDown';
    const FILL_PATTERN_DARKGRAY             = 'darkGray';
    const FILL_PATTERN_DARKGRID             = 'darkGrid';
    const FILL_PATTERN_DARKHORIZONTAL       = 'darkHorizontal';
    const FILL_PATTERN_DARKTRELLIS          = 'darkTrellis';
    const FILL_PATTERN_DARKUP               = 'darkUp';
    const FILL_PATTERN_DARKVERTICAL         = 'darkVertical';
    const FILL_PATTERN_GRAY0625             = 'gray0625';
    const FILL_PATTERN_GRAY125              = 'gray125';
    const FILL_PATTERN_LIGHTDOWN            = 'lightDown';
    const FILL_PATTERN_LIGHTGRAY            = 'lightGray';
    const FILL_PATTERN_LIGHTGRID            = 'lightGrid';
    const FILL_PATTERN_LIGHTHORIZONTAL      = 'lightHorizontal';
    const FILL_PATTERN_LIGHTTRELLIS         = 'lightTrellis';
    const FILL_PATTERN_LIGHTUP              = 'lightUp';
    const FILL_PATTERN_LIGHTVERTICAL        = 'lightVertical';
    const FILL_PATTERN_MEDIUMGRAY           = 'mediumGray';

    /**
     * Fill type
     *
     * @var string
     */
    private $_fillType;

    /**
     * Rotation
     *
     * @var double
     */
    private $_rotation;

    /**
     * Start color
     *
     * @var PHPPowerPoint_Style_Color
     */
    private $_startColor;

    /**
     * End color
     *
     * @var PHPPowerPoint_Style_Color
     */
    private $_endColor;

    /**
     * Create a new PHPPowerPoint_Style_Fill
     */
    public function __construct()
    {
        // Initialise values
        $this->_fillType            = self::FILL_NONE;
        $this->_rotation            = 0;
        $this->_startColor          = new Color(Color::COLOR_WHITE);
        $this->_endColor            = new Color(Color::COLOR_BLACK);
    }

    /**
     * Get Fill Type
     *
     * @return string
     */
    public function getFillType()
    {
        return $this->_fillType;
    }

    /**
     * Set Fill Type
     *
     * @param  string                   $pValue PHPPowerPoint_Style_Fill fill type
     * @return PHPPowerPoint_Style_Fill
     */
    public function setFillType($pValue = self::FILL_NONE)
    {
        $this->_fillType = $pValue;

        return $this;
    }

    /**
     * Get Rotation
     *
     * @return double
     */
    public function getRotation()
    {
        return $this->_rotation;
    }

    /**
     * Set Rotation
     *
     * @param  double                   $pValue
     * @return PHPPowerPoint_Style_Fill
     */
    public function setRotation($pValue = 0)
    {
        $this->_rotation = $pValue;

        return $this;
    }

    /**
     * Get Start Color
     *
     * @return PHPPowerPoint_Style_Color
     */
    public function getStartColor()
    {
        // It's a get but it may lead to a modified color which we won't detect but in which case we must bind.
        // So bind as an assurance.
        return $this->_startColor;
    }

    /**
     * Set Start Color
     *
     * @param  PHPPowerPoint_Style_Color $pValue
     * @throws \Exception
     * @return PHPPowerPoint_Style_Fill
     */
    public function setStartColor(Color $pValue = null)
    {
        $this->_startColor = $pValue;

        return $this;
    }

    /**
     * Get End Color
     *
     * @return PHPPowerPoint_Style_Color
     */
    public function getEndColor()
    {
        // It's a get but it may lead to a modified color which we won't detect but in which case we must bind.
        // So bind as an assurance.
        return $this->_endColor;
    }

    /**
     * Set End Color
     *
     * @param  PHPPowerPoint_Style_Color $pValue
     * @throws \Exception
     * @return PHPPowerPoint_Style_Fill
     */
    public function setEndColor(Color $pValue = null)
    {
        $this->_endColor = $pValue;

        return $this;
    }

    /**
     * Get hash code
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        return md5(
            $this->getFillType()
            . $this->getRotation()
            . $this->getStartColor()->getHashCode()
            . $this->getEndColor()->getHashCode()
            . __CLASS__
        );
    }

    /**
     * Hash index
     *
     * @var string
     */
    private $_hashIndex;

    /**
     * Get hash index
     *
     * Note that this index may vary during script execution! Only reliable moment is
     * while doing a write of a workbook and when changes are not allowed.
     *
     * @return string Hash index
     */
    public function getHashIndex()
    {
        return $this->_hashIndex;
    }

    /**
     * Set hash index
     *
     * Note that this index may vary during script execution! Only reliable moment is
     * while doing a write of a workbook and when changes are not allowed.
     *
     * @param string $value Hash index
     */
    public function setHashIndex($value)
    {
        $this->_hashIndex = $value;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if (is_object($value)) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
            }
        }
    }
}
