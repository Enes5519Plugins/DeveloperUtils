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

namespace Enes5519\DeveloperUtils\level;

use pocketmine\entity\Entity;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\tile\Tile;

class LocationUtils{

	public static function getNearestEntity(Position $pos, string $entityType = Entity::class) : ?Entity{
		if(empty($pos->getLevel()->getEntities())) return null;

		$entities = array_filter($pos->getLevel()->getEntities(), function(Entity $entity) use($entityType) : bool{
			return $entity instanceof $entityType;
		});
		self::distanceSort($entities, $pos);

		return reset($entities);
	}

	public static function getNearestTile(Position $pos, string $tileType = Tile::class){
		if(empty($pos->getLevel()->getTiles())) return null;

		$tiles = array_filter($pos->getLevel()->getTiles(), function(Tile $tile) use($tileType) : bool{
			return $tile instanceof $tileType;
		});
		self::distanceSort($tiles, $pos);

		return reset($tiles);
	}

	/**
	 * @param Vector3[] $array
	 * @param Vector3 $pos
	 */
	public static function distanceSort(array &$array, Vector3 $pos) : void{
		usort($array, function(Vector3 $a, Vector3 $b) use($pos) : int{
			$distanceA = $a->distance($pos);
			$distanceB = $b->distance($pos);
			if($distanceA === $distanceB){
				return 0;
			}

			return ($distanceA < $distanceB) ? 1 : -1;
		});
	}

}