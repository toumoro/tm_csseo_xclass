<?php

namespace Toumoro\TmCsseoXclass\Xclass;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Marc Hirdes <hirdes@clickstorm.de>, clickstorm GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use Clickstorm\CsSeo\Utility\ConfigurationUtility;
use Clickstorm\CsSeo\Utility\DatabaseUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Render the seo and social meta data for records in frontend
 *
 * @package Clickstorm\CsSeo\UserFunc
 */
class HeaderData extends \Clickstorm\CsSeo\UserFunc\HeaderData
{


    /**
     * @param string $field
     * @param array $meta
     *
     * @return string the image path
     */
    protected function getImageOrFallback($field, $meta)
    {
        $params = [];
        if (is_array($meta[$field])) {
            $params['table'] = $meta[$field]['table'];
            $params['field'] = $meta[$field]['field'];
            $params['uid'] = $meta[$field]['uid_foreign'];
        } else {
            $params['table'] = self::TABLE_NAME_META;
            $params['field'] = 'tx_csseo_' . $field;
            $params['uid'] = $meta['uid'];
        }

        $image = DatabaseUtility::getFile($params['table'], $params['field'], $params['uid']);
        if($image) {
            return $image->getUid(); // devrait être un uid et non une URL
            return $image->getPublicUrl();
        }
    }

  
}
