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

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\block\Solid;
use pocketmine\level\Level;
use pocketmine\nbt\BigEndianNBTStream;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\MainLogger;

class Schematic{

	public const CONVERT_BLOCKS = [
		158 => [Block::WOODEN_SLAB, 0],
		125 => [Block::DOUBLE_WOODEN_SLAB, 0],
		188 => [Block::FENCE, 0],
		189 => [Block::FENCE, 1],
		190 => [Block::FENCE, 2],
		191 => [Block::FENCE, 3],
		192 => [Block::FENCE, 4],
		193 => [Block::FENCE, 5],
		166 => [Block::INVISIBLE_BEDROCK, 0],
		144 => [Block::AIR, 0], // mob heads
		208 => [Block::GRASS_PATH, 0],
		198 => [Block::END_ROD, 0],
		126 => [Block::WOODEN_SLAB, 0],
		95 => [Block::STAINED_GLASS, 0],
		199 => [Block::CHORUS_PLANT, 0],
		202 => [Block::PURPUR_BLOCK, 0],
		251 => [Block::CONCRETE, 0],
		204 => [Block::PURPUR_BLOCK, 0]
	];

	/** Minecraft: Pocket Edition Level */
	public const MATERIALS_POCKET = "Pocket";

	/** Minecraft Alpha and newer Level */
	public const MATERIALS_ALPHA = "Alpha";

	/** Minecraft Classic Level */
	public const MATERIALS_CLASSIC = "Classic";

	/** Unknown */
	public const MATERIALS_UNKNOWN = "Unknown";

	/** @var string */
	protected $raw;
	/** @var string */
	protected $file;
	/** @var CompoundTag */
	protected $nbt = null;

	/**
	 * Width  : Size along the X axis.
	 * Height : Size along the Y axis.
	 * Length : Size along the Z axis.
	 *
	 * @var int
	 */
	protected $width, $height, $length;

	/** @var Block[] */
	protected $blocks;

	/** @var CompoundTag */
	protected $tiles, $entities;

	/** @var string */
	protected $materials;

	public function __construct(string $file){
		if(!file_exists($file)){
			throw new \InvalidArgumentException("File not found");
		}

		$this->raw = file_get_contents($file);
		$this->file = $file;
		assert($this->getNBT() !== null);

		$this->decode();
	}

	public function save(string $file = "") : void{
		$file = $file == "" ? $this->file : $file;
		file_put_contents($file, $this->raw);
	}

	public function paste(Level $level) : void{
		$this->fixBlocks();

		$sp = true;
		foreach($this->blocks as $block){
			if($sp){
				if($block instanceof Solid){
					$sp = false;
					MainLogger::getLogger()->debug("Start POS: " . $block->asVector3()->__toString());
				}
			}
			$level->setBlock($block, $block, true, false);
		}
		MainLogger::getLogger()->debug("Finished");
	}

	public function fixBlocks(){
		if($this->materials === self::MATERIALS_POCKET){
			return;
		}

		foreach($this->blocks as $index => $block){
			if(isset(self::CONVERT_BLOCKS[$block->getId()])){
				$b = BlockFactory::get(...self::CONVERT_BLOCKS[$block->getId()]);
				$b->setComponents($block->x, $block->y, $block->z);
				$this->blocks[$index] = $block;
			}
		}
	}

	public function getNBT() : ?CompoundTag{
		if($this->nbt !== null){
			return $this->nbt;
		}

		try{
			$nbt = new BigEndianNBTStream();
			$this->nbt = $nbt->readCompressed($this->raw);
			return $this->nbt instanceof CompoundTag ? $this->nbt : null;
		}catch(\InvalidArgumentException $e){
			return null;
		}
	}

	public function decode(){
		$data = $this->getNBT();

		$this->width = $data->getShort("Width");
		$this->height = $data->getShort("Height");
		$this->length = $data->getShort("Length");
		$this->materials = $data->getString("Materials");
		$this->entities = $data->getListTag("Entities");
		$this->tiles = $data->getListTag("TileEntities");

		$this->blocks = $this->decodeBlocks($data->getByteArray("Blocks"), $data->getByteArray("Data"));
	}

	public function decodeBlocks(string $blocks, string $meta){
		$bytes = array_values(unpack("c*", $blocks));
		$meta = array_values(unpack("c*", $meta));
		$realBlocks = [];
		for($x = 0; $x < $this->width; $x++){
			for($y = 0; $y < $this->height; $y++){
				for($z = 0; $z < $this->length; $z++){
					$index = ($y * $this->width * $this->length) + ($z * $this->width) + $x;
					$block = BlockFactory::get(abs($bytes[$index]));
					$block->setComponents($x, $y, $z);
					if(isset($meta[$index])) {
						$block->setDamage($meta[$index] & 0x0F);
					}
					$realBlocks[] = $block;
				}
			}
		}

		return $realBlocks;
	}

	/**
	 * @return Block[]
	 */
	public function getBlocks() : array{
		return $this->blocks;
	}

	public function getWidth() : int{
		return $this->width;
	}

	public function getHeight() : int{
		return $this->height;
	}

	public function getLength() : int{
		return $this->length;
	}

}