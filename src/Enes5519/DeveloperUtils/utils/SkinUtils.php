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
		$image = imagecreatefrompng($filename);
		$data = '';
		for($y = 0, $height = imagesy($image); $y < $height; $y++){
			for($x = 0, $width = imagesx($image); $x < $width; $x++){
				$color = imagecolorat($image, $x, $y);
				$data .= pack("c", ($color >> 16) & 0xFF) //red
					. pack("c", ($color >> 8) & 0xFF) //green
					. pack("c", $color & 0xFF) //blue
					. pack("c", 255 - (($color & 0x7F000000) >> 23)); //alpha
			}
		}
		imagedestroy($image);

		return $data;
	}

}