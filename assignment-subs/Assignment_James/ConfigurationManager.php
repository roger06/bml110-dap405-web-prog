<?php


class  CompleteConfig  {

    public $configOptions ;
    public function __construct()
    {
        $jsonData = file_get_contents("config/config.json") or die ("Cannot accses file config.json");
        $this->configOptions = json_decode($jsonData,True);

        
    }

    //changes relevent file locations when updated
    public function UpdateConfig(string $paramName,$paramVal)
        {           
            $this->configOptions[$paramName] = $paramVal;
            $configFile = fopen("config/config.json","w");
            $configData= json_encode($this->configOptions);
            fwrite($configFile,$configData);
            fclose($configFile);
        
        }
        
}




?>