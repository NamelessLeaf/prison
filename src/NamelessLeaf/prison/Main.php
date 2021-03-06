<?php

namespace NamelessLeaf\prison;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;


class Main extends PluginBase implements Listener {
  
  public function onEnable(){
    $this->getLogger()->info("Enabled");
  }
  
  public function onDisable(){
    $this->getLogger()->info("Disabled");
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, String $lable, Array $args) : bool {
    
    switch($cmd->getName()){
      case "playprison":
        if($sender instanceof Player){
          $this->form($sender);
        }else{
          $sender->sendMessage("stupid console u cant use form");
        }
    }
    return true;
  }
  
  public function form($player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createSimpleForm(function (Player $player, int $data = null){
      $result = $data;
      if($result === null){
        return true;
      }
      switch($result){
        case 0:
          $player->transfer("us1.falixnodes.net", 60477);
        break;
          
        case 1:
         $player->sendMessage("Exit Succsessful");
        break;
    
      }
    });
    $form->setTitle("§e>>§4§lMurder Mystery§r§e<<");
    $form->setContent("Click CONFIRM To Play Prison!");
    $form->addButton("§l§aCONFIRM");
    $form->addButton("§l§cExit");
    $form->sendToPlayer($player);
    return $form;
  }
}
