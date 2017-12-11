<?php
  require("BankAccount.php"); // Load in the BankAccount.php file


  // Relationships between classes must be establish before coding:
  class ISA extends BankAccount{
    // Create a public property which will reflect the amount of days they will be able to withdraw funds from the ISA account otherwise a penalty will be issued. Additional services may come with the acocunt such as holiday insurance etc...:
    public $TimePeriod = 28;
    public $AdditionalServices;

    // Methods //

    // Seeing if the transaction violates the 28 day period
    public function WithDraw($amount){
      // log the date and time in the audit array
      $transDate = new DateTime();
      // last transaction variable which is going to contain a number that will tell us how many days betweent he last transaction and this transaction thats been executed - if it is under 28days time period then there will be a penalty but if it is over 28 days then that transaction will not incur a penalty
      $lastTransaction = null;

      // The COUNT FUNCTION (which is native to PHP) allows us to count how many elements are in the array. Looking at the main Audit Array and all of the sub-arrays. Iterate through how many elements are in the arrays:
      $length = count($this->Audit);

      // we need to know how many sub arrays or elements are in our main Audit Array
      // We want to find the LATEST SUCCESSFUL Withdrawal on account and see if it VIOLATES THE RULES
      // We are going to do a FOR LOOP to do this:

      // the variable is i which is an integer/number which will be stored in the length
      // we want to start from the bottom of the array because they are the latest users activity transactions.

      // the condition is,
      // as long as $i is greater than > 0 then the for loop is going to keep iterating,
      // we are doing $i-- to take away 1 from the minus value until we get to 0 because then we will stop executing the for loop (we are deincrimenting),
      for( $i = $length; $i > 0; $i-- ){

        // creating a new variable called $element,
        // which is going to store this specific array,
        // targeting the main Audit Array and all the subarrays by using $this->Audit,
        $element = $this->Audit[$i - 1];

        // looking for the latest withdrawal transaction,
        // target that specific element in the array and see if it is a withdraw accepted,
        // this will look at the first element in the transaction array sees if it is EQUAL TO transaction accepted - if it is not then it will stop the for loop dead in its tracks!
        if( $element[0] === "WITHDRAW ACCEPTED" ){

          // This new date and time OBJECT will be generated for the date and time - comparing the last transactions date and time to the CURRENT date and time
          $days = new DateTime ($element[3] );
          // target the last transaction made and run the diff method,
          // this takes an argument that compares this date and time to the current transaction date,
          // then give a number "%a" that will be assigned to the last transaction variable:
          $lastTransaction = $days->diff($transDate)->format("%a");

          break; // STOP the for loop from looping through older transactions that have no relevance to us.
        }
      }
    }

    public function Penalty($amount){

    }
  }
?>
