<?php

namespace Food;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {
    public function onEnable(): void
    {
        $this->getLogger()->info("Plugin activé avec succes");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
    }
    public function RapidFood(PlayerItemUseEvent $event){
        $player = $event->getPlayer();
        if($player->getInventory()->getItemInHand()->getId() == $this->getConfig()->get("id")){
            $item = $event->getItem();
            $item->setCount(1);
            $food = $player->getHungerManager()->getFood();
            $player->getHungerManager()->setFood($food + $this->getConfig()->get("add_food"));
            $player->getHungerManager()->setSaturation($this->getConfig()->get("add_saturation"));
            $player->getInventory()->removeItem($item);
        }
    }
}