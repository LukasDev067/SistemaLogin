<?php

namespace SistemaLogin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\{Player, Server};
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\event\player\PlayerQuitEvent;
class Loader extends PluginBase implements Listener {
    
public $win = [];

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onJoin(PlayerJoinEvent $ev) {
        $ev->setJoinMessage("");
        $player = $ev->getPlayer();
         /*       $player->teleport($this->getServer()->getLevelByName("LobbyWindow")->getSafeSpawn());*/
        $window = new WindowInventory($player, 27, "§aSistema");
        $player->addWindow($window);
       $this->win[$player->getName()] = $window;
      /*  for ($slot = 0; $slot < 27; $slot++){
        $window->setItem($slot, Item::get(351, 1, 1));*/
        $window->setItem(0, Item::get(351, 1, 1));
        $window->setItem(1, Item::get(351, 1, 1));
        $window->setItem(2, Item::get(351, 1, 1));
        $window->setItem(3, Item::get(351, 1, 1));
        $window->setItem(4, Item::get(351, 1, 1));
        $window->setItem(5, Item::get(351, 1, 1));
        $window->setItem(6, Item::get(351, 1, 1));
        $window->setItem(7, Item::get(351, 1, 1));
        $window->setItem(8, Item::get(351, 1, 1));
        $window->setItem(9, Item::get(351, 1, 1));
        $window->setItem(10, Item::get(351, 1, 1));
        $window->setItem(11, Item::get(351, 1, 1));
        $window->setItem(12, Item::get(351, 1, 1));
        $window->setItem(13, Item::get(351, 1, 1));
        $window->setItem(14, Item::get(351, 1, 1));
        $window->setItem(15, Item::get(351, 1, 1));
        $window->setItem(16, Item::get(351, 1, 1));
        $window->setItem(17, Item::get(351, 1, 1));
        $window->setItem(18, Item::get(351, 1, 1));
        $window->setItem(19, Item::get(351, 1, 1));
        $window->setItem(20, Item::get(351, 1, 1));
        $window->setItem(21, Item::get(351, 1, 1));
        $window->setItem(22, Item::get(351, 1, 1));
        $window->setItem(23, Item::get(351, 1, 1));
        $window->setItem(24, Item::get(351, 1, 1));
        $window->setItem(25, Item::get(351, 1, 1));
        $window->setItem(26, Item::get(351, 1, 1));
        $window->setItem(27, Item::get(351, 1, 1));
                
        $window->setItem(rand(0, 27), Item::get(351, 2, 1));
       // }
    }
   public function onClose(InventoryCloseEvent $e){
      $p = $e->getPlayer();
      $world = $p->getLevel()->getFolderName();
      $lobby = ["world"];
      if(in_array($world, $lobby)){
		$name = $p->getName();
		if(isset($this->win[$name])){
			unset($this->win[$name]);
      $p->kick("§aSistema \n §aVoçe tentou sair da verificação!!");
        }
		}
	}
	public function onQuit(PlayerQuitEvent $e){
		$name = $e->getPlayer()->getName();
		if(isset($this->win[$name])){
			unset($this->win[$name]);
		}
	}
	public function onTransaction(InventoryTransactionEvent $e){
		$put = $e->getTransaction();
		$p = $put->getPlayer();
		$name = $p->getName();
		foreach($put->getTransactions() as $action){
			$item = $action->getTargetItem();
			$custom = $item->getCustomName();
			if(isset($this->win[$name])){
				$e->setCancelled();
				$inv = $this->win[$name];
            if($item->getId() === 351 && $item->getDamage() === 2){
           $p->removeWindow($inv);
      /*    if(!$p->getLevel()->getName() !== $this->getServer()->getDefaultLevel()){*/
           unset($this->win[$name]);
     }
    if($item->getId() === 351 && $item->getDamage() === 1){
   $p->removeWindow($inv);
   $p->kick("§aSistema \n §a Verificação incorreta");
     }
    }
   }
  }
}
