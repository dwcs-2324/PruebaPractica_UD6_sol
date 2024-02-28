<?php
// This class has all the necessary code for making API calls thru curl library

class CurlHelper
{

    // This method will perform an action/method thru HTTP/API calls
    // Parameter description:
    // Method= POST, PUT, GET etc
    // Data= array("param" => "value") ==> index.php?param=value
    public static function perform_http_request($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                self::doPut($data, $curl);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        // 	true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly. 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

  private  static function doPut($jsonString, $session)
    {
        // EXAMPLE OF PUT with PHP and CURL
//
// by Keran McKenzie
// 
// NOTE this assumes you are posting JSON  in a variable called $jsonString
// also assumes we have the username & password in variables

        // setup Curl


        // Put requires a file to 'put' to the servier, so lets use php's TEMP file function 
// to create the file so we don't have to worry about writing a file to the server
        $putData = tmpfile();
       // $jsonString = json_encode($data);
        // now we write the JSON string into the file
        fwrite($putData, $jsonString);
        // Reset the file pointer
        fseek($putData, 0);

        // Setup our headers so we tell the server to expect JSON
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );
        curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
        // We want to transfer this as a Binary Transfer

       
        // Do you want CURL to output the headers? Set to FALSE to hide them
        curl_setopt($session, CURLOPT_HEADER, true);
      


        // Now we want to tell CURL the were the file is and it's size
        curl_setopt($session, CURLOPT_INFILE, $putData);
        curl_setopt($session, CURLOPT_INFILESIZE, strlen($jsonString));
    }
}