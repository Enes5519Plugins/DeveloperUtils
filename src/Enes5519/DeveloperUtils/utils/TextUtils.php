<?php

/*
 *               _ _
 *         /\   | | |
 *        /  \  | | |_ __ _ _   _
 *       / /\ \ | | __/ _` | | | |
 *      / ____ \| | || (_| | |_| |
 *     /_/    \_|_|\__\__,_|\__, |
 *                           __/ |
 *                          |___/
 *
 * @author TuranicTeam
 * @link https://github.com/TuranicTeam/Altay
 *
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
		$text = str_split($str);
		$i = -1;
		foreach($text as $index => $char){
			if($char == " ") continue;
			if($i >= count(self::RAINBOW_COLORS) - 1) $i = -1;
			$color = self::RAINBOW_COLORS[++$i];
			$text[$index] = $color . $char;
		}

		return implode($text);
	}

}