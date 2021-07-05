<?php
    

    class Person {
        private string $name;
        private string $lastName;
        private $friends;

        public function __construct(string $name, string $lastName){
            $this->name=$name;
            $this->lastName=$lastName;
            $this->friends = [];
        }

        public function getName():string{
            return $this->name;
        }

        public function getLastName():string{
            return $this->lastName;
        }

        public function getFullName():string{
            return $this->getName()." ".$this->getLastName();
        }

        public function getFriends(){
            return $this->friends;
        }

        public function setFriends($friend){
            $this->friends [] = $friend;
        }


        // Method where the person say simple hello and who they are
        public function sayHello():string{
            return  $this->who()." Hello, my name is ".$this->getFullName().".";

        }

        /* Method which say hello to people and nice to meet you for the first
         time. The second time the person who know each other just say Hi. */
        public function sayHelloToPeople(Person $first, Person $second):string{
            $greeting = $this->sayHello();
            if($this->isFriend($first)){
                $greeting.= sprintf(" Hi, %s.", $first->getName());
            }
            else{
                $greeting .= sprintf(" Nice to meet you, %s.", $first->getName()); 
            }

            if($this->isFriend($second)){
                $greeting .= sprintf(" Hi, %s.", $second->getName());
            }
            else{
                $greeting .= sprintf(" Nice to meet you, %s.", $second->getName());
            }

            return $greeting;
        }

        //Method which looks if the persons are know each other.
        protected function isFriend(Person $person){
            if(in_array($person, $this->getFriends())){
                return true;
            }
            else{
                $this->setFriends($person);
                $person->setFriends($this);
                return false;
            }
          
        }

        //Method which shows, at the beggining, the Person who is talking.
        protected function who():string{
            return "{".$this->getName()."}:";
        }


        //Magic method which shows the Full Name of the person's friends.
        public function __toString():string{
            $friendsName = [];
            foreach($this->getFriends() as $friend){
                $friendsName[]=$friend->getFullName();
            }
            return implode(",",$friendsName);
                         
        }
    
    }

    //test

    $angelina = new Person("Angelina","Jolie");
    $spiderMan = new Person("Peter", "Parker");
    $brad = new Person("Brad", "Pitt");
    $john = new Person("John","Lennon");

    echo $angelina->sayHello()."\n";
    echo $spiderMan->sayHelloToPeople($angelina,$john)."\n";
    echo $spiderMan->sayHelloToPeople($angelina,$brad)."\n";
    echo $brad->sayHelloToPeople($angelina,$spiderMan)."\n";
    echo $brad->sayHelloToPeople($angelina,$spiderMan)."\n";
    echo $brad->sayHelloToPeople($angelina,$john)."\n";
    echo $john->sayHelloToPeople($angelina,$brad)."\n";
    echo $brad."\n";
    echo $john."\n";
    echo $angelina."\n";





?>