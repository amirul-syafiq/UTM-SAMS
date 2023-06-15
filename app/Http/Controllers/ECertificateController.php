<?php

namespace App\Http\Controllers;

use App\Models\ECertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ECertificateController extends Controller
{
    public function store(Request $request, $event_advertisement_id)
    {

        $ecertSVG = ECertificate::where('event_advertisement_id', $event_advertisement_id)->first();
        $s3 = Storage::disk('s3');
        $newEcertSVG = new ECertificate();

        if ($ecertSVG->count() > 0) {
            $ecertFileName = $ecertSVG->first()->image_name;
            $filepath = '/ecertificates/' . $ecertFileName;
            $s3->delete($filepath);
            $newEcertSVG = $ecertSVG->first();
        }

        $ecertFileName = 'ECertEV' . $event_advertisement_id . '.svg';
        $filePath = '/ecertificates/' . $ecertFileName;
        $s3->put($filePath, $request->file('ecertSVG'));


        // Convert the input to json
        $ecertKeyValue = [];


        foreach ($request->all() as $key => $value) {
            if ($key != '_token' && $key != '_method' && $key != 'submitButton') {
                $ecertKeyValue[$key] = $value;
            }
        }
        $jsonData = json_encode($ecertKeyValue);
        $ecertSVG->ecertificate_attribute_key_value = $jsonData;

        // Save all ecert data
        $ecertSVG->image_name = $ecertFileName;
        $ecertSVG->ecertificate_status = $request->ecertificate_status;
        $ecertSVG->ecertificate_s3_key = $filePath;
        $ecertSVG->event_advertisement_id = $event_advertisement_id;
        $ecertSVG->save();
    }
}
