<?php

namespace App\Http\Controllers;

use App\Models\ECertificate;
use App\Models\EventAdvertisement;
use App\Models\RF_Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ECertificateController extends Controller
{
    public function create($event_advertisement_id)
    {
        // Get the ecert data from the database
        $ecertSVG = ECertificate::where('event_advertisement_id', $event_advertisement_id)->first();

        // get ecert status list
        $ecertStatusList= RF_Status::where('status_code','like', 'EC%')->pluck('status_name', 'status_code');
        return view('eCertificate.ecert-create', compact('ecertSVG', 'ecertStatusList', 'event_advertisement_id'));
    }

    public function validateFile($request)
    {
        // Custom messages checking file is uploaded and file type
        $message=[
            'ecertSVG.required' => 'Please upload a file',
            'ecertSVG.mimes' => 'Please upload a valid svg file',
            'ecertStatus.required' => 'Please select a status'
        ];
        // Validate the file
        Validator::make($request->all(), [
            'ecertSVG' => 'required|mimes:svg',
            'ecertStatus' => 'required'
        ],$message)->validate();


        // Check the svg file content necessary placeholders

    }

    public function store(Request $request, $event_advertisement_id)
    {
        // Validate the file
        $this->validateFile($request);

        $ecertSVG = ECertificate::where('event_advertisement_id', $event_advertisement_id)->first();
        $s3 = Storage::disk('s3');
        // If is null, create a new ecert
        if (!$ecertSVG) {
            $ecertSVG = new ECertificate();
        }
        // If is not null, delete the old ecert
        else if ($ecertSVG->count() > 0) {
            $ecertFileName = $ecertSVG->first()->ecertificate_name;
            $filepath = '/ecertificates/' . $ecertFileName;
            $s3->delete($filepath);
        }
        // Store ecert file name based on the event advertisement id
        $ecertFileName = 'ECertEV' . $event_advertisement_id . '.svg';

        // Store the file in the s3 bucket
        $filePath = '/ecertificates/' . $ecertFileName;
        $s3->put($filePath, file_get_contents(($request->file('ecertSVG'))));

        // Save all ecert data
        $ecertSVG->ecertificate_name = $ecertFileName;
        $ecertSVG->ecertificate_status = $request->ecertStatus;
        $ecertSVG->ecertificate_s3_key = $filePath;
        $ecertSVG->event_advertisement_id = $event_advertisement_id;
        $ecertSVG->save();
    }

    public function generateEcert($event_advertisement_id)
    {

    }
}
