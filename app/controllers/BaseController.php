<?php

class BaseController extends Controller {

	/**
	* Construct $championsArray and $skinsArray to use in typeahead.js autocomplete on all pages. 
	*/
	public function __construct() {

		function clean($string) {
		   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
		   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		}

		function cleanandlower($string) {
		   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
		   $string = strtolower($string);
		   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		}

		//$champList = "https://prod.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=image,skins&api_key=017c21e9-1bf7-46ab-aa0c-791c138ebcf1";
		//$champListContent = file_get_contents("https://prod.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=image,skins&api_key=017c21e9-1bf7-46ab-aa0c-791c138ebcf1");
		//date_default_timezone_set('America/New_York');
/*		$champions=Champion::all();
		$skins=Skin::all();

		$championArray=array();
		$skinArray=array();

		foreach ($champions as $key => $value) {
			$championArray[]=$value->champion;
		}

		foreach ($skins as $key => $value) {
			$skinArray[]=$value->skin;
		}

		$json = json_encode($championArray);
		$json2 = json_encode($skinArray);
*/
		$championList = <<<EOD
["Aatrox","Ahri","Akali","Alistar","Amumu","Anivia","Annie","Ashe","Blitzcrank","Brand","Braum","Caitlyn","Cassiopeia","Cho'Gath","Corki","Darius","Diana","Dr. Mundo","Draven","Elise","Evelynn","Ezreal","Fiddlesticks","Fiora","Fizz","Galio","Gangplank","Garen","Gragas","Graves","Hecarim","Heimerdinger","Irelia","Janna","Jarvan IV","Jax","Jayce","Jinx","Karma","Karthus","Kassadin","Katarina","Kayle","Kennen","Kha'Zix","Kog'Maw","LeBlanc","Lee Sin","Leona","Lissandra","Lucian","Lulu","Lux","Malphite","Malzahar","Maokai","Master Yi","Miss Fortune","Mordekaiser","Morgana","Nami","Nasus","Nautilus","Nidalee","Nocturne","Nunu","Olaf","Orianna","Pantheon","Poppy","Quinn","Rammus","Renekton","Rengar","Riven","Rumble","Ryze","Sejuani","Shaco","Shen","Shyvana","Singed","Sion","Sivir","Skarner","Sona","Soraka","Swain","Syndra","Talon","Taric","Teemo","Thresh","Tristana","Trundle","Tryndamere","Twisted Fate","Twitch","Udyr","Urgot","Varus","Vayne","Veigar","Vel'Koz","Vi","Viktor","Vladimir","Volibear","Warwick","Wukong","Xerath","Xin Zhao","Yasuo","Yorick","Zac","Zed","Ziggs","Zilean","Zyra"]
EOD;
	
		$skinList = <<<EOD
["Justicar Aatrox","Midnight Ahri","Dynasty Ahri","Foxfire Ahri","Popstar Ahri","Silverfang Akali","Blood Moon Akali","Nurse Akali","Stinger Akali","Golden Alistar","Infernal Alistar","Longhorn Alistar","Sad Robot Amumu","Little Knight Amumu","Almost-Prom King Amumu","Emumu Amumu","Blackfrost Anivia","Bird of Prey Anivia","Noxus Hunter Anivia","Hextech Anivia","Reverse Annie","Frostfire Annie","Panda Annie","Prom Queen Annie","Amethyst Ashe","Heartseeker Ashe","Queen Ashe","Freljord Ashe","Woad Ashe","Sherwood Forest Ashe","Piltover Customs Blitzcrank","iBlitzcrank Blitzcrank","Boom Boom Blitzcrank","Apocalyptic Brand","Cryocore Brand","Vandal Brand","Dragonslayer Braum","Arctic Warfare Caitlyn","Officer Caitlyn","Resistance Caitlyn","Sheriff Caitlyn","Mythic Cassiopeia","Jade Fang Cassiopeia","Desperada Cassiopeia","Siren Cassiopeia","Battlecast Prime Cho'Gath","Gentleman Cho'Gath","Jurassic Cho'Gath","Loch Ness Cho'Gath","Dragonwing Corki","Urfrider Corki","Hot Rod Corki","Lord Darius","Woad King Darius","Bioforge Darius","Dark Valkyrie Diana","Lunar Goddess Diana","Corporate Dr. Mundo","Rageborn Dr. Mundo","Executioner Dr. Mundo","Soul Reaver Draven","Gladiator Draven","Death Blossom Elise","Shadow Evelynn","Tango Evelynn","Explorer Ezreal","Pulsefire Ezreal","Frosted Ezreal","Fiddle Me Timbers Fiddlesticks","Surprise Party Fiddlesticks","Bandito Fiddlesticks","Spectral Fiddlesticks","Nightraven Fiora","Royal Guard Fiora","Void Fizz","Tundra Fizz","Fisherman Fizz","Atlantean Fizz","Gatekeeper Galio","Commando Galio","Enchanted Galio","Special Forces Gangplank","Sultan Gangplank","Minuteman Gangplank","Spooky Gangplank","Steel Legion Garen","Rugged Garen","Dreadknight Garen","Sanguine Garen","Commando Garen","Oktoberfest Gragas","Gragas, Esq. Gragas","Vandal Gragas","Hillbilly Gragas","Pool Party Graves","Mafia Graves","Jailbreak Graves","Hired Gun Graves","Arcade Hecarim","Reaper Hecarim","Blood Knight Hecarim","Piltover Customs Heimerdinger","Blast Zone Heimerdinger","Frostblade Irelia","Infiltrator Irelia","Aviator Irelia","Nightblade Irelia","Forecast Janna","Hextech Janna","Frost Queen Janna","Tempest Janna","Warring Kingdoms Jarvan IV","Dragon Slayer Jarvan IV","Darkforge Jarvan IV","Commando Jarvan IV","Temple Jax","Nemesis Jax","Jaximus Jax","Vandal Jax","Full Metal Jayce","Debonair Jayce","Mafia Jinx","Sun Goddess Karma","Sakura Karma","Pentakill Karthus","Grim Reaper Karthus","Statue of Karthus","Harbinger Kassadin","Deep One Kassadin","Pre-Void Kassadin","High Command Katarina","Sandstorm Katarina","Bilgewater Katarina","Mercenary Katarina","Aether Wing Kayle","Battleborn Kayle","Viridian Kayle","Arctic Ops Kennen","Kennen M.D. Kennen","Deadly Kennen","Karate Kennen","Mecha Kha'Zix","Lion Dance Kog'Maw","Deep Sea Kog'Maw","Jurassic Kog'Maw","Monarch Kog'Maw","Wicked LeBlanc","Prestigious LeBlanc","Acolyte Lee Sin","Muay Thai Lee Sin","Pool Party Lee Sin","Dragon Fist Lee Sin","Traditional Lee Sin","Defender Leona","Iron Solari Leona","Pool Party Leona","Valkyrie Leona","Bloodstone Lissandra","Hired Gun Lucian","Dragon Trainer Lulu","Wicked Lulu","Bittersweet Lulu","Spellthief Lux","Imperial Lux","Steel Legion Lux","Sorceress Lux","Commando Lux","Glacial Malphite","Coral Reef Malphite","Obsidian Malphite","Marble Malphite","Overlord Malzahar","Djinn Malzahar","Shadow Prince Malzahar","Charred Maokai","Totemic Maokai","Assassin Master Yi","Ionia Master Yi","Headhunter Master Yi","Samurai Master Yi","Chosen Master Yi","Cowgirl Miss Fortune","Mafia Miss Fortune","Secret Agent Miss Fortune","Waterloo Miss Fortune","Road Warrior Miss Fortune","Pentakill Mordekaiser","Lord Mordekaiser","Infernal Mordekaiser","Blackthorn Morgana","Blade Mistress Morgana","Sinful Succulence Morgana","Ghost Bride Morgana","Exiled Morgana","Koi Nami","Infernal Nasus","Dreadknight Nasus","Galactic Nasus","Pharaoh Nasus","AstroNautilus Nautilus","Subterranean Nautilus","Abyssal Nautilus","Headhunter Nidalee","Pharaoh Nidalee","French Maid Nidalee","Eternum Nocturne","Frozen Terror Nocturne","Void Nocturne","Ravager Nocturne","Grungy Nunu","Nunu Bot Nunu","Demolisher Nunu","Brolaf Olaf","Pentakill Olaf","Forsaken Olaf","Glacial Olaf","Bladecraft Orianna","Sewn Chaos Orianna","Gothic Orianna","Perseus Pantheon","Full Metal Pantheon","Glaive Warrior Pantheon","Myrmidon Pantheon","Ruthless Pantheon","Scarlet Hammer Poppy","Battle Regalia Poppy","Phoenix Quinn","Chrome Rammus","Full Metal Rammus","Ninja Rammus","Freljord Rammus","Bloodfury Renekton","Pool Party Renekton","Rune Wars Renekton","Scorched Earth Renekton","Outback Renekton","Galactic Renekton","Headhunter Rengar","Battle Bunny Riven","Redeemed Riven","Crimson Elite Riven","Super Galaxy Rumble","Rumble in the Jungle Rumble","Bilgerat Rumble","Dark Crystal Ryze","Uncle Ryze","Tribal Ryze","Bear Cavalry Sejuani","Darkrider Sejuani","Sabretusk Sejuani","Masked Shaco","Asylum Shaco","Mad Hatter Shaco","Royal Shaco","Blood Moon Shen","Warlord Shen","Surgeon Shen","Ironscale Shyvana","Ice Drake Shyvana","Darkflame Shyvana","Boneclaw Shyvana","Mad Scientist Singed","Augmented Singed","Surfer Singed","Hextech Singed","Barbarian Sion","Warmonger Sion","Lumberjack Sion","Bandit Sivir","Warrior Princess Sivir","Sandscourge Skarner","Earthrune Skarner","Arcade Sona","Pentakill Sona","Guqin Sona","Divine Soraka","Celestine Soraka","Dryad Soraka","Tyrant Swain","Northern Front Swain","Bilgewater Swain","Justicar Syndra","Atlantean Syndra","Crimson Elite Talon","Dragonblade Talon","Renegade Talon","Armor of the Fifth Age Taric","Bloodstone Taric","Astronaut Teemo","Cottontail Teemo","Super Teemo","Panda Teemo","Recon Teemo","Deep Terror Thresh","Rocket Girl Tristana","Guerilla Tristana","Buccaneer Tristana","Junkyard Trundle","Lil'Slugger Trundle","Viking Tryndamere","Demonblade Tryndamere","Sultan Tryndamere","King Tryndamere","Musketeer Twisted Fate","High Noon Twisted Fate","Tango Twisted Fate","Jack of Hearts Twisted Fate","Vandal Twitch","Gangster Twitch","Spirit Guard Udyr","Primal Udyr","Black Belt Udyr","Battlecast Urgot","Giant Enemy Urgot","Arctic Ops Varus","Arclight Varus","Blight Crystal Varus","Dragonslayer Vayne","Heartseeker Vayne","Vindicator Vayne","Aristocrat Vayne","Greybeard Veigar","White Mage Veigar","Superb Villain Veigar","Baron Von Veigar","Leprechaun Veigar","Battlecast Vel'Koz","Officer Vi","Neon Strike Vi","Creator Viktor","Full Machine Viktor","Prototype Viktor","Blood Lord Vladimir","Vandal Vladimir","Count Vladimir","Marquis Vladimir","Northern Storm Volibear","Runeguard Volibear","Thunder Lord Volibear","Hyena Warwick","Firefang Warwick","Tundra Hunter Warwick","Big Bad Warwick","General Wukong","Volcanic Wukong","Jade Dragon Wukong","Scorched Earth Xerath","Runeborn Xerath","Battlecast Xerath","Warring Kingdoms Xin Zhao","Viscero Xin Zhao","Winged Hussar Xin Zhao","Imperial Xin Zhao","Commando Xin Zhao","High Noon Yasuo","Pentakill Yorick","Undertaker Yorick","Special Weapon Zac","Shockblade Zed","Major Ziggs","Mad Scientist Ziggs","Pool Party Ziggs","Shurima Desert Zilean","Groovy Zilean","Haunted Zyra","Wildfire Zyra"]
EOD;

		View::share('championsArray', $championList);
		View::share('skinsArray', $skinList);
		//View::share('champList', $champList);
		//View::share('champListContent', $champListContent);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if ( ! is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}

}
