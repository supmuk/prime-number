<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function index(Request $request) 
    {
        // ini_set('max_execution_time', 180); //3 minutes

        $input_no = $request->input_no;
        $input_no = collect($input_no);
        $input_no = $input_no->all();
        $starting_no;
        $ending_no;
        $add = [];
        
        if( $input_no )
        {
            foreach ($input_no as $key => $value) {
                $exploded = explode(' ', $value);
                
                $starting_no = (int)$exploded[0] ?? '';
                $ending_no = (isset($exploded[1])) ? (int)$exploded[1] : '';

                if( isset($exploded[0]) && isset($exploded[1]) )
                {

                    $temp = $starting_no;
                    

                    while( $starting_no <= $ending_no )
                    {
                         // dump($starting_no);
                        if( $this->primeCheck($starting_no) )
                        {

                            $add[] = $starting_no;
                            break;
                        }
                        // dump($starting_no);
                        $starting_no += 1;
                        // dump($add);

                    }
                    // dump($add);
                    $starting_no = $temp;

                    while( $starting_no <= $ending_no )
                    {

                        if( $this->primeCheck($ending_no) )
                        {

                            
                            $add[] = $ending_no;
                            break;
                        }
                        $ending_no -= 1;
                    }
                }
            }
            
            if( !empty($starting_no) && !empty($ending_no) )
            {
                if( count($add) == 0 )
                {
                    echo "-1";
                }
                else
                {
                    
                    echo max($add) - min($add);
                    
                }
            }
            else
            {
                echo "0";
            }
        }

    }

    function primeCheck($number){
        if ($number == 1)
        return 0;
        for ($i = 2; $i <= $number/2; $i++){
            if ($number % $i == 0)
                return 0;
        }
        return 1;
    }
}
