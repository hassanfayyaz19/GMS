<?php
$num=2314.90;
$list1  = array('','one','two','three','four','five','six','seven',
		'eight','nine','ten','eleven','twelve','thirteen','fourteen',
		'fifteen','sixteen','seventeen','eighteen','nineteen');
   
	$list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
		'seventy','eighty','ninety','hundred');
   
	$list3  = array('','thousand','million','billion','trillion',
		'quadrillion','quintillion','sextillion','septillion',
		'octillion','nonillion','decillion','undecillion',
		'duodecillion','tredecillion','quattuordecillion',
		'quindecillion','sexdecillion','septendecillion',
		'octodecillion','novemdecillion','vigintillion');
			
			
	//new code to split into 
	$numnew=explode(".",$num);
	if($numnew[1]=="00" || $numnew[1]=="")
	{
		$finaldecimal="";
	}
	else
	{
		$decimalVal= substr($numnew[1],0,2);
		
		$decimalVal1st=substr($decimalVal,0,1);
		$decimalVal2nd=substr($decimalVal,1,1);
		if($decimalVal1st==0)
		{
			$finalNum=$list1[$decimalVal2nd];
		}
		elseif($decimalVal2nd=="")
		{
			$finalNum=$list2[$decimalVal1st];
		}
		elseif($decimalVal<=19)
		{
			$finalNum=$list1[$decimalVal];
		}
		else
		{
			$decimaltens   = ( int ) ( $decimalVal / 10 );
			$decimalsingles_rem    = ( int ) ( $decimalVal % 10 );
			
			$finalNum1=$list2[$decimaltens];
			$finalNum2=$list1[$decimalsingles_rem];
			$finalNum=$finalNum1." ". $finalNum2;
		}
		$finaldecimal=" and ".$finalNum." cents";
	}
	
	
	
	// old code starts below
    $num    = ( string ) ( ( int ) $numnew[0] );
   
    if( ( int ) ( $num ) && ctype_digit( $num ) )
    {
        $words  = array( );
       
        $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
       
        
       
        $num_length = strlen( $num );
        $levels = ( int ) ( ( $num_length + 2 ) / 3 );
        $max_length = $levels * 3;
        $num    = substr( '00'.$num , -$max_length );
        $num_levels = str_split( $num , 3 );
       
        foreach( $num_levels as $num_part )
        {
            $levels--;
            $hundreds   = ( int ) ( $num_part / 100 );
            $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
            $tens       = ( int ) ( $num_part % 100 );
            $singles    = '';
           
            if( $tens < 20 )
            {
                $tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );
            }
            else
            {
                $tens   = ( int ) ( $tens / 10 );
                $tens   = ' ' . $list2[$tens] . ' ';
                $singles    = ( int ) ( $num_part % 10 );
                $singles    = ' ' . $list1[$singles] . ' ';
            }
            $words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        }
       
        $commas = count( $words );
       
        if( $commas > 1 )
        {
            $commas = $commas - 1;
        }
       
        $words  = implode( ', ' , $words );
       
        //Some Finishing Touch
        //Replacing multiples of spaces with one space
        $words  = trim( str_replace( ' ,' , ',' , trim_all( ucwords( $words ) ) ) , ', ' );
        if( $commas )
        {
            $words  = str_replace_last( ',' , ' and' , $words );
        }
       
        echo  $words.$finalNum;
    }
    else if( ! ( ( int ) $num ) )
    {
        return 'Zero';
    }
	
function str_replace_last( $search , $replace , $str ) {
if( ( $pos = strrpos( $str , $search ) ) !== false ) {
	$search_length  = strlen( $search );
	$str    = substr_replace( $str , $replace , $pos , $search_length );
}
return $str;
}
function trim_all( $str , $what = NULL , $with = ' ' )
{
if( $what === NULL )
{
	//  Character      Decimal      Use
	//  "\0"            0           Null Character
	//  "\t"            9           Tab
	//  "\n"           10           New line
	//  "\x0B"         11           Vertical Tab
	//  "\r"           13           New Line in Mac
	//  " "            32           Space
   
	$what   = "\\x00-\\x20";    //all white-spaces and control chars
}

return trim( preg_replace( "/[".$what."]+/" , $with , $str ) , $what );
}
?>