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

namespace Enes5519\DeveloperUtils\math;

class Math{

	/**
	 * The factorial number.
	 *
	 * @param int $number
	 * @return int
	 */
	public static function factorial(int $number) : int{
		if($number <= 0){
			throw new \InvalidArgumentException("Please enter a number greater than 0.");
		}

		if(function_exists("gmp_fact")){
			return (int) gmp_fact($number);
		}else{
			$result = $number--;
			for(; $number > 0; $number--){
				$result *= $number;
			}

			return $result;
		}
	}

	/**
	 * The combinations of numbers.
	 *
	 * @param int $n
	 * @param int $r
	 * @return int
	 */
	public static function combination(int $n, int $r) : int{
		if($n <= 0 or $r < 0){
			throw new \InvalidArgumentException("Please enter a number greater than 0.");
		}

		if($r == 0 or $r == $n){
			return 1;
		}

		if($r == ($n - 1)){
			return $n;
		}

		$nFac = self::factorial($n);
		$rFac = self::factorial($r);
		$nSubrFac = self::factorial($n - $r);

		return $nFac / ($rFac * $nSubrFac);
	}

	/**
	 * The permutations of numbers.
	 *
	 * @param int $n
	 * @param int $r
	 * @return int
	 */
	public static function permutation(int $n, int $r) : int{
		if($n <= 0 or $r < 0){
			throw new \InvalidArgumentException("Please enter a number greater than 0.");
		}

		$result = 1;
		for($i = 0; $i < $r; $i++){
			$result *= ($n - $i);
		}

		return $result;
	}

}