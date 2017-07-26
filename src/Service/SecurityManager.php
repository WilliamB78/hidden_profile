<?php


namespace Service;


class SecurityManager 
{
    private function sanitizeValue(&$value)

    {
        $value = trim(strip_tags($value));            
        // trim() supprime les espaces en début et en fin de chaîne

        // strip_tags() supprime les balises

    }



    private function sanitizeArray(array &$array)

    {

        array_walk_recursive($array, [$this, 'sanitizeValue']);



        // même chose avec une fonction anonyme

    //    array_walk($array, function (&$value) {

    //        $value = trim(strip_tags($value));

    //    });

    }
    
    public function sanitizeGet()
    {
        $this->sanitizeArray($_GET);
    }

    public function debug($var, $mode = 1)
        {
        
        $trace = debug_backtrace();
        echo "<strong>debug demandé dans le fichier " . $trace[0]['file'] . " en ligne : " . $trace[0]['line'] . "</strong>";
        if ($mode == 1){
          echo '<pre>'; var_dump($var); echo '</pre>' ;
        }
        else {
          echo '<pre>'; print_r($var); echo '</pre>' ;
        }
}

    public function sanitizePost()

    {

        $this->sanitizeArray($_POST);

        // $_POST et toutes les superglobales sont accessibles dans les fonctions

    }
    
    public function generateRandomString($length = 10) 
            
    {
        
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        
    }
    
}
