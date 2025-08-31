<?php
namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FutureXIntegration extends Model{

    const GRANT_TYPE = 'client_credentials';
    const CLIENT_ID = 'e8f97d82-8fab-436b-8f0c-26f15ac00e7d'; // test : "9e41c692-767c-43f7-9458-a87f0cc86a11"  live : "e8f97d82-8fab-436b-8f0c-26f15ac00e7d"
    const CLIENT_SECRET = 'GmiWB40Jh4pI';                      // test :B25DiAT1iwYc                            live : "GmiWB40Jh4pI"

    const MAIN_URL = 'https://futurex.nelc.gov.sa/';  // test : "https://integration-futurex.nelc.gov.sa/"




    public function getToken()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type='.self::GRANT_TYPE.'&client_id='.self::CLIENT_ID.'&client_secret='.self::CLIENT_SECRET,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);
        $result = json_decode($jsonString, true);
        return $result ;
    }

    public function enrollmentProgress($postdata)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'enrollment-progress?_format=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->getToken()['access_token']
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);

        $result = json_decode($jsonString, true);
        return $result ;

    }

    public function generateCertificate($postdata)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'certificate?_format=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->getToken()['access_token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);
        $result = json_decode($jsonString, true);
        return $result ;
    }



    public function getCourseCategory()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'/field-options/vocabulary/course_category?_format=json&items_per_page=200',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->getToken()['access_token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);
        $result = json_decode($jsonString, true);
        return $result['content'] ;
    }

    public function getCourseLevel()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'field-options/vocabulary/course_level?_format=json&items_per_page=50',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->getToken()['access_token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);
        $result = json_decode($jsonString, true);
        return $result['content'] ;
    }
    public function getCourseLanguage()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'field-options/vocabulary/language?_format=json&items_per_page=50',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->getToken()['access_token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);
        $result = json_decode($jsonString, true);
        return $result['content'] ;
    }
    public function getSkills()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'field-options/vocabulary/skills?_format=json&items_per_page=2500',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->getToken()['access_token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);
        $result = json_decode($jsonString, true);
        return $result['content'] ;
    }
    public function getTags()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'field-options/vocabulary/tags?_format=json&items_per_page=2500',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->getToken()['access_token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);
        $result = json_decode($jsonString, true);
        return $result['content'] ;
    }


    public function createCourse($postdata)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::MAIN_URL.'create-course?_format=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$this->getToken()['access_token']
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}') + 1;
        $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart);
        $result = json_decode($jsonString, true);
        return $result ;
    }




}