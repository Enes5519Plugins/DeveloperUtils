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

namespace Enes5519\DeveloperUtils\utils;

use pocketmine\utils\TextFormat;

class TextUtils{

	public const RAINBOW_COLORS = [
		TextFormat::RED,
		TextFormat::GOLD,
		TextFormat::YELLOW,
		TextFormat::GREEN,
		TextFormat::AQUA,
		TextFormat::BLUE,
		TextFormat::LIGHT_PURPLE
	];

	public static function rainbow(string $str) : string{
		$text = self::str_split_unicode($str);
		$i = -1;
		foreach($text as $index => $char){
			if($char == " ") continue;
			if($i >= count(self::RAINBOW_COLORS) - 1) $i = -1;
			$color = self::RAINBOW_COLORS[++$i];
			$text[$index] = $color . $char;
		}

		return implode($text);
	}
	
	public static function str_split_unicode(string $str, int $l = 0) : array{
		if ($l > 0) {
			$ret = array();
			$len = mb_strlen($str, "UTF-8");
			for ($i = 0; $i < $len; $i += $l) {
				$ret[] = mb_substr($str, $i, $l, "UTF-8");
			}
			return $ret;
		}
		
		return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
	}
}
