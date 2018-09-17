<?php 
//I was running the following code using this command:
//php -f FishTank.php > index.html

class FishTank {

	public $fishTankName;
	public $fishes;

	public function __construct($fishTankName) {
		$this->fishTankName = $fishTankName;
		$this->fishes = $this->defaultFish();

	}

	public function defaultFish(){
		
			$fishes = array( 
            0 => array (
               "FishType" => 'Gold Fish',
               "Feed"	  => 0.1,
               "NumberOfFish" => 0
            ),
            
            1 => array (
               "FishType" => 'Angel Fish',
               "Feed"	  => 0.2,
               "NumberOfFish" => 0	  
            ),
            
            2 => array (
               "FishType" => 'Babel Fish',
               "Feed" 	  => 0.3,
               "NumberOfFish" => 0
 
            )
         );


		return $fishes;
	}

	// Adding a new fish
	public function addNewFishType($fishType, $feed){
		
		 array_push($this->fishes, 
               [
               	"FishType" => $fishType,
               	"Feed"	  => $feed,
               	"NumberOfFish" => 0
               ]	  
            );
		
	}

	// Adding a fish to the tank
	public function addFish($key, $amount){
		$this->fishes[$key]['NumberOfFish'] += $amount;
	}

	// Sum feed for all fish
	public function TotalFeed(){
		
		$totalFeed = 0;		
		
		$this->weightOfFeed();

		foreach ($this->fishes as $key=>$val) {
			$totalFeed = $totalFeed + $val['TotalFeed'];
		}

		return $totalFeed;

	}

	// Sum feed per fish
	public function weightOfFeed(){
		$weightOfFeed = 0;
		$totalFish = 0;

		foreach ($this->fishes as $key=>$val) {
			
			$totalFish = $val['NumberOfFish'];
			$weightOfFeed = $val['Feed'];
			$weightOfFeed = $weightOfFeed * $totalFish;
			$this->fishes[$key]['TotalFeed'] = $weightOfFeed;
			

		}

		return $weightOfFeed;
	}

	// Not really needed in the end, but a useful method to keep.
	public function howManyFish(){
		$totalFish = 0;

		foreach ($this->fishes as $key=>$val) {
			$totalFish = $totalFish + $val['NumberOfFish'];
		}
		return $totalFish;
	}

	// Export - I know this isnt XML - Running short on time.
	public function exportFish(){
		return json_encode($this->fishes, JSON_PRETTY_PRINT);
	}

}

$FishTank = new FishTank('Dave\'s Tank');

//Add a new fish - Name and Feed
$FishTank->addNewFishType('Clown Fish', 0.5);
$FishTank->addNewFishType('Star Fish', 10);


//the array key and amount of fish you want to add.
$FishTank->addFish(0, 4);
$FishTank->addFish(1, 5);
$FishTank->addFish(2, 5);
$FishTank->addFish(3, 2);
$FishTank->addFish(4, 1);


//add another Gold Fish
$FishTank->addFish(0, 1);


echo $FishTank->fishTankName. ' has '. $FishTank->howManyFish() .' hungry fish. You will need this much feed:'. '<strong>' .$FishTank->TotalFeed(). 'g' . '</strong>';

echo '<pre>' . var_export($FishTank, true) . '</pre>';

echo $FishTank->exportFish();


?>