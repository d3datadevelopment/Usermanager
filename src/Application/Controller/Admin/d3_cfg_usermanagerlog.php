<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

declare(strict_types = 1);

namespace D3\Usermanager\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\Log\d3_cfg_log;

class d3_cfg_usermanagerlog extends d3_cfg_log
{
    protected $_sModId = 'd3usermanager';

    /**
     * @return string
     */
    public function d3getAdditionalUrlParams(): string
    {
        $sRet = parent::d3getAdditionalUrlParams();

        if ($this->_sModId) {
            $sRet .= '&sD3ModId='.$this->_sModId;
        }

        return $sRet;
    }
}
