<?php
/**
 * File: NpassInterface.php
 * @author: Cvar1984 <gedzsarjuncomuniti@gmail.com>
 * Date: 19.01.2020
 * Last Modified Date: 20.01.2020
 * Last Modified By: Cvar1984 <gedzsarjuncomuniti@gmail.com>
 */

namespace Cvar1984\Npass;

interface NpassInterface
{
    /**
     * @method getHigh get high percentage
     * @method getMid get medium percentage
     * @method getLow get low percentage
     * @param void
     * @return array or empty
     */
    public function getHigh();
    public function getMid();
    public function getLow();
}
