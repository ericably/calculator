<?php

namespace App\Helpers;

class CalculationHelper
{
    public function calculation(string $operation): float
    {
        $patterns = [
            'first' => '~([()*/+-])~',
            'second' => '#\(+(.*)\)+#',
            'third' => '/\([^)]*\)/'
        ];

        $components = $this->pregSplitString($patterns['first'], $operation);

        if (($index=array_search('(',$components)) !== false){

            preg_match($patterns['second'], $operation, $parenthesisOperation);
            $parenthesisResult = $this->resolution($this->pregSplitString($patterns['first'],$parenthesisOperation[1]));
            $replaceParenthesisResult = preg_replace($patterns['third'],"*".$parenthesisResult."*", $operation);

            return $this->resolution($this->pregSplitString($patterns['first'], $replaceParenthesisResult));
        }

        return $this->resolution($components);

    }

    public function pregSplitString(string $pattern, string $subject): array
    {
        return preg_split($pattern, $subject,NULL,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    }

    public function resolution($components): float
    {
        while(($index=array_search('/',$components)) !== false){
            array_splice($components,$index-1,3,$components[$index-1]/$components[$index+1]);
        }

        while(($index = array_search('*',$components)) !== false){
            array_splice($components,$index-1,3,$components[$index-1]*$components[$index+1]);
        }

        while(($index=array_search('+',$components)) !== false){
            array_splice($components,$index-1,3,$components[$index-1]+$components[$index+1]);
        }

        while(($index=array_search('-',$components)) !== false){
            array_splice($components,$index-1,3,$components[$index-1]-$components[$index+1]);
        }

        return current($components);
    }

}