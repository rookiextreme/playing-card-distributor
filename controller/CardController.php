<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    $model = new CardController;
    echo json_encode($model->toString($model->distributeCard($_POST['people_no'])));
}

class CardController{
    private $cardShape;
    private $cardNum;
    public $fullDeck = [];
    public $deckTotal = 0;

    public function __construct()
    {
        $this->cardShape = ['S', 'H', 'D', 'C'];
        $this->cardNum = ['A', 2, 3, 4, 5, 6, 7, 8, 9, 'X', 'J', 'Q', 'K'];

        //Set card type and grouped into one array (A box of Cards)
        $this->cardSetup();
        //Shuffle the box of cards
        $this->shuffleCard();
    }

    private function cardSetup(){
        foreach($this->cardShape as $cs){
            foreach($this->cardNum as $cn){
                $this->fullDeck[] = $cs.'-'.$cn;
            }
        }
        $this->deckTotal = count($this->fullDeck);
    }

    private function shuffleCard(){
        shuffle($this->fullDeck);
    }

    public function distributeCard($people = 0){
        $data = [];

        //Count number of card each person should have
        $eachPerson = round($this->deckTotal / $people);

        //If number of people is more than total cards, set each person 1 card each
        if($eachPerson < 1){
            $eachPerson = 1;
        }

        //Every person get the number of cards
        for($x = 1; $x <= $people; $x++){
            $data['Person-'.$x] = [];
            $y = 1;

            if(empty($this->fullDeck)){
                $data['Person-'.$x] = [
                    'No Cards'
                ];
                break;
            }

            foreach($this->fullDeck as $k => $fd){
                if($y <= $eachPerson){
                    //Once set, remove card for the full deck
                    $data['Person-'.$x][] = $fd;
                    unset($this->fullDeck[$k]);
                }
                $y++;
            }
        }

        return $data;
    }

    public function toString($persons){
        $str = '';
        if(!empty($persons)){
            foreach($persons as $p => $c){
                $str .= $p.' - ';
                foreach($c as $card){
                    $str .= $card.',';
                }
                $str .= '<br>';
            }
        }

        return  $str;
    }
}
