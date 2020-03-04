<?php

    if( ! function_exists('first_step')){

        function first_step($num = 0){
            list($first,$second) = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2);
            dd(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,3));
            
        }
    }

    if( ! function_exists('second_step')){
        
        function second_step($num = 0){
            first_step($num);
        }
    }

    if( ! function_exists('third_step')){

        function third_step($num = 0){
            second_step($num);
        }
    }