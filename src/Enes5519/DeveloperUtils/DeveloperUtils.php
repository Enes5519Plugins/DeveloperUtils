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
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace Enes5519\DeveloperUtils;

use Enes5519\DeveloperUtils\utils\TextUtils;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\SetSpawnPositionPacket;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class DeveloperUtils extends PluginBase{

	/** @var DeveloperUtils */
	private static $api;

	public function onLoad(){
		self::$api = $this;
	}

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getLogger()->info(TextUtils::rainbow("Plugin enabled"));
	}

	public static function getAPI() : DeveloperUtils{
		return self::$api;
	}

	public static function setCompassDestination(Player $player, Vector3 $pos){
		$pos = $pos->floor();

		$pk = new SetSpawnPositionPacket();
		$pk->spawnType = SetSpawnPositionPacket::TYPE_WORLD_SPAWN;
		$pk->x = $pos->x;
		$pk->y = $pos->y;
		$pk->z = $pos->z;
		$pk->spawnForced = false;
		$player->dataPacket($pk);
	}
}