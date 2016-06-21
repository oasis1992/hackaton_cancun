<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mockery\CountValidator\Exception;
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Symfony\Component\Yaml\Exception\ParseException;

class QuestionController extends Controller
{
    /**
     * QuestionController constructor.
     */
    public function __construct()
    {

    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->initParse();
        $query = new ParseQuery("Sentences2");
        try {
            $items= $query->find();
            // The object was retrieved successfully.
        } catch (ParseException $ex) {
            throw new Exception("D: alguien elimino este item");
        }
        
        return View('list')->with('items', $items);
    }

    private function initParse()
    {
        ParseClient::initialize( env('APP_ID'), '', env('MASTER_KEY'));
        ParseClient::setServerURL(env('URL_PARSE'));
    }
    
    public function getPercentaje($palabra){
        $arreglo = array('0' =>array('language'=>'es','id'=>'1','text'=>$palabra));
        $data = array('documents' => $arreglo);
        $data_string = json_encode($data);

        $url = 'https://westus.api.cognitive.microsoft.com/text/analytics/v2.0/sentiment';
        $url2 = 'https://westus.api.cognitive.microsoft.com/text/analytics/v2.0/keyPhrases';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Ocp-Apim-Subscription-Key: 524b41424a5b4c25b081025caadbb4d8',
            'Content-Length: ' . strlen($data_string)));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response1  = curl_exec($ch);
        curl_close($ch);
         return $response1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       return View('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $array = array('afraid' => 'afraid', 'happy'=>'happy', 'angry' => 'angry', 'disgusted' => 'disgusted', 'sad' => 'sad');
        $this->initParse();
        $object = ParseObject::create("Sentences2");
        $object->getObjectId();

        $text =  $request->get('text');
            $object->set('question', $request->get('text'));
        $arrayResponses = array();
        $responses = $request->get('responses');

        for($i = 0; $i < count($responses); $i++){
            $isGood = $this->checkArray($responses[$i]);

            $palabra = str_replace("#", $responses[$i], $text);

            $json = $this->getPercentaje($palabra);
            $json_decode = json_decode($json);
            $percent = 0;
            foreach ($json_decode as $json){

                $percent = $json[0]->score * 100;
                break;
            }
            unset($array[$responses[$i]]);
            $arrayResponses[$responses[$i]] = array('isGood' => $isGood, 'percentaje' => $percent);
        }

        foreach ($array as $item){
            $arrayResponses[$item] = array('isGood' => false, 'percentaje' => "100%");
        }
        $object->setArray('responses', $arrayResponses);
        $object->save();
        return redirect()->route('admin.preguntas.index');
    }

    public function checkArray($item){
        switch ($item){
            case "afraid":
                return true;
            case "happy":
                return true;
            case "angry":
                return true;
            case "disgusted":
                return true;
            case "sad":
                return true;
            default:
                return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = new ParseQuery("Questions");
        try {
            $question = $query->get($id);

        } catch (ParseException $ex) {
            throw new Exception("Ha!! que paso?");
        }

        return View('')->with('question', $question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $object = ParseObject::create("Questions");
        $object->getObjectId();
        $object->set('question', $request->get('question'));
        $arrayResponses = array();
        $responses = $request->get('responses');

        for($i = 0; $i < count($responses); $i++){
            $arrayResponses['q'.$i] = $responses[$i];
        }
        $object->setArray('responses', $arrayResponses);
        $object->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = new ParseQuery("Questions");
        try {
            $question = $query->get($id);
            $question->destroy();

        } catch (ParseException $ex) {
            throw new Exception("Ha!! que paso?");
        }

        return redirect()->route('');
    }
}
