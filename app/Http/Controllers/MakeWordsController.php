<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Parse\ParseObject;

class MakeWordsController extends Controller
{
    public function index(){
        $object = ParseObject::create("Words");
        $object->getObjectId();
        $object->set('word', "Triste");
        $object->save();

        $object = ParseObject::create("Words");
        $object->getObjectId();
        $object->set('word', "Molesto");
        $object->save();

        $object = ParseObject::create("Words");
        $object->getObjectId();
        $object->set('word', "Ansioso");
        $object->save();

        $object = ParseObject::create("Words");
        $object->getObjectId();
        $object->set('word', "Disgustado");
        $object->save();

        $object = ParseObject::create("Words");
        $object->getObjectId();
        $object->set('word', "Temeroso");
        $object->save();
    }
}
