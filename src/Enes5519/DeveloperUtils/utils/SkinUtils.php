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

class SkinUtils{

	/**
	 * Converts an image to bytes
	 * @param string $filename path to png
	 * @return string bytes for skin
	 */
	public static function getTextureFromFile(string $filename) : string{
		assert(file_exists($filename));
		$im = imagecreatefrompng($filename);
		list($width, $height) = getimagesize($filename);
		$bytes = "";
		for($y = 0; $y < $height; $y++){
			for($x = 0; $x < $width; $x++){
				$argb = imagecolorat($im, $x, $y);
				$a = ((~((int) ($argb >> 24))) << 1) & 0xff;
				$r = ($argb >> 16) & 0xff;
				$g = ($argb >> 8) & 0xff;
				$b = $argb & 0xff;
				$bytes .= chr($r) . chr($g) . chr($b) . chr($a);
			}
		}
		imagedestroy($im);
		return $bytes;
	}

}