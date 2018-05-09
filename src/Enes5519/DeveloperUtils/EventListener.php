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

use pocketmine\event\Listener;

class EventListener implements Listener{

	/** @var DeveloperUtils */
	protected $api;

	public function __construct(DeveloperUtils $api){
		$this->api = $api;
	}
}