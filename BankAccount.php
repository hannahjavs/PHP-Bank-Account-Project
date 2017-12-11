<?
  // CREATING THE DEPENDENCY:
  abstract class BankAccount{
    // PROTECTED property because it will be blackboxed
    // PROTECTED because don't want anything affecting the account
    protected $Balance = 0;
    public $APR;
    public $SortCode;
    public $FirstName;
    public $LastName;

    // Is an empty array so we can push information into it
    // Can keep information about the acocunt in here e.g withdrawals/deposits/account locked or unlocked:
    public $Audit = array(); // sub-arrays below will be pushed into this main Audit array

    // The account is LOCKED by default and protected:
    protected $Locked = false;


    //////////METHODS//////////

    // Need to make sure there is a date and time for each transaction for fraud prevention!
    public function WithDraw( $amount ){
      $trainsDate = new DateTime(); // This is a date & time object
      // if the back account is locked we do not want to allow the transaction to work
      // if the locked property is false then the account is not locked
      if( $this->Locked === false ){
        // whatever the BALANCE is MINUS the AMOUNT and reasign the value back to the balance PROPERTY
        $this->Balance -= $amount;
        // this is a sub-array that will be pushed inside the original Audit array (at the top of the code)
        // Can see the amount from the account that was successfully withdrawn from the account, then can see the new balance after the transaction has occured, then see a date and time and format it into a string using the 'c':
        array_push($this -> Audit, array("WITHDRAW ACCEPTED",$amount, $this->Balance, $transDate->format('c') ) );
      } else {
        array_push( $this->Audit, array("WITHDRAW DENIED", $amount, $this->Balance, $transDate->format('c') ) );
      }
    }

    // DEPOSIT METHOD:
    public function Deposit( $amount ){
      $trainsDate = new DateTime();
      if( $this->Locked === false ){
        $this->Balance -= $amount;
        array_push($this -> Audit, array("DEPOSIT ACCEPTED",$amount, $this->Balance, $transDate->format('c') ) );
      } else {
        array_push( $this->Audit, array("DEPOSIT DENIED", $amount, $this->Balance, $transDate->format('c') ) );
      }
    }

    // ACCOUNT LOCKED METHOD:
    public function Lock(){

      $this->Locked = true;

      $lockedDate = new DateTime();

        array_push( $this->Audit, array("Account Locked", $lockedDate->format('c') ) );
    }

    // ACCOUNT UNLOCKED METHOD:
    public function Unlock(){

      $this->Locked = false;

      $unlockedDate = new DateTime();

        array_push( $this->Audit, array("Account Unlocked", $unlockedDate->format('c') ) );
    }


  }
?>
