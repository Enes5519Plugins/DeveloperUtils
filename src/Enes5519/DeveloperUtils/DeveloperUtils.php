<?php

/*   
 *   _____             _    _ _   _ _     
 *  |  __ \           | |  | | | (_) |    
 *  | |  | | _____   _| |  | | |_ _| |___ 
 *  | |  | |/ _ \ \ / / |  | | __| | / __|
 *  | |__| |  __/\ V /| |__| | |_| | \__ \
 *  |_____/ \___| \_/  \____/ \__|_|_|___/
 *      
 *                                
 * @author Enes5519
 * @link https://github.com/Enes5519
 */

declare(strict_types=1);

namespace Enes5519\DeveloperUtils;

use Enes5519\DeveloperUtils\utils\TextUtils;
use pocketmine\plugin\PluginBase;

class DeveloperUtils extends PluginBase{

	public function onEnable(){
		$this->getLogger()->info(TextUtils::rainbow("Plugin enabled"));
	}
}