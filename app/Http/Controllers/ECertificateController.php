<?php

namespace App\Http\Controllers;

use App\Models\ECertificate;
use App\Models\Event;
use App\Models\EventAdvertisement;
use App\Models\Participant;
use App\Models\RF_Status;
use Aws\Endpoint\Partition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class ECertificateController extends Controller
{
    public function create($event_advertisement_id)
    {
        // Get the ecert data from the database
        $ecertSVG = ECertificate::where('event_advertisement_id', $event_advertisement_id)->first();

        // get ecert status list
        $ecertStatusList = RF_Status::where('status_code', 'like', 'EC%')
            // Exclude template status
            ->where('status_code', '!=', 'EC00')
            ->pluck('status_name', 'status_code');


        return view('eCertificate.ecert-create', compact('ecertSVG', 'ecertStatusList', 'event_advertisement_id'));
    }

    public function validateFile($request)
    {
        // Custom messages checking file is uploaded and file type
        $message = [
            'ecertSVG.required' => 'Please upload a file',
            'ecertSVG.mimes' => 'Please upload a valid svg file',
            'ecertStatus.required' => 'Please select a status'
        ];
        // Validate the file
        Validator::make($request->all(), [
            'ecertSVG' => 'required|mimes:svg',
            'ecertStatus' => 'required'
        ], $message)->validate();


        // Check the svg file content necessary placeholders

    }

    // Function use to store file from template
    public function useEcertTemplate($eventAdvertisement_id)
    {
        // Get the ecert template
        $ecertTemplate = ECertificate::where('ecertificate_status', 'like', 'EC00')->first();
        $ecertSVG = ECertificate::where('event_advertisement_id', $eventAdvertisement_id)->first();


        // Store ecert file name based on the event advertisement id
        $ecertFileName = 'ECertEV' . $eventAdvertisement_id . '.svg';

        // Use the template path as the file path
        $filePath = $ecertTemplate->ecertificate_s3_key;

         // Save all ecert data
         $ecertSVG->ecertificate_name = $ecertFileName;
         $ecertSVG->ecertificate_status = "EC02";
         $ecertSVG->ecertificate_s3_key = $filePath;
         $ecertSVG->event_advertisement_id = $eventAdvertisement_id;
         $ecertSVG->save();
         return redirect()->route('participant.viewParticipantList', $eventAdvertisement_id)->with('success', 'Ecertificate updated');

    }

    public function store(Request $request, $eventAdvertisement_id)
    {
        // Validate the file
        $this->validateFile($request);

        // Get the ecert data from the database
        $ecertSVG = ECertificate::where('event_advertisement_id', $eventAdvertisement_id)->first();
        $s3 = Storage::disk('s3');
        // If is null, create a new ecert
        if (!$ecertSVG) {
            $ecertSVG = new ECertificate();
        }
        // If is not null, delete the old ecert
        else if ($ecertSVG->count() > 0) {
            $ecertFileName = $ecertSVG->ecertificate_name;
            $filepath = '/ecertificates/' . $ecertFileName;

            $s3->delete($filepath);
        }
        // Store ecert file name based on the event advertisement id
        $ecertFileName = 'ECertEV' . $eventAdvertisement_id . '.svg';

        // Store the file in the s3 bucket
        $filePath = '/ecertificates/' . $ecertFileName;
        $s3->put($filePath, file_get_contents(($request->file('ecertSVG'))));

        // Save all ecert data
        $ecertSVG->ecertificate_name = $ecertFileName;
        $ecertSVG->ecertificate_status = $request->ecertStatus;
        $ecertSVG->ecertificate_s3_key = $filePath;
        $ecertSVG->event_advertisement_id = $eventAdvertisement_id;
        $ecertSVG->save();

        return redirect()->route('participant.viewParticipantList', $eventAdvertisement_id)->with('success', 'Ecertificate updated');
    }

    public function generateEcert($event_advertisement_id)
    {
        $eventData = EventAdvertisement::where('id', $event_advertisement_id)->with('event', 'eCertificate')->first();
        // Check user is a participant for the event
        $isParticipant = Participant::where('event_advertisement_id', $event_advertisement_id)->where('user_id', auth()->user()->id)->first();
        if (!$isParticipant) {
            return redirect()->back()->with('error', 'You are not a participant for this event');
        }

        // Get the ecert data from the database
        $ecert = $eventData->eCertificate;

        // Check ecert is available
        if (!$ecert) {
            return redirect()->back()->with('error', 'E-Certificate is not available');
        }

        // Read the svg content from the s3 bucket
        $s3 = Storage::disk('s3');
        $contents = $s3->get($ecert->ecertificate_s3_key);
        // Get the svg file and convert to xml to read the text content
        $tempFilePath = tempnam(sys_get_temp_dir(), 'svg');
        file_put_contents($tempFilePath, $contents);
        $xml = simplexml_load_file($tempFilePath);


        // Only text with $ sign will taken
        $textElements = $xml->xpath('//text()[contains(., "$")] | //path[contains(string(.), "$")] | //tspan[contains(., "$")] | //textPath[contains(string(.), "$")] | //a[contains(., "$")] | //tref[contains(., "$")] | //altGlyph[contains(., "$")]');

        // Iterate the text elements and replace the necessary placeholders
        foreach ($textElements as $textElement) {
            $textContent = trim((string) $textElement);

            switch ($textContent) {
                    // CAPS LOCK PARTICIPANT NAME
                case '$PARTICIPANTNAME':
                    $textElement[0] = strtoupper($isParticipant->user->name);
                    break;
                case '$participantName':
                    $textElement[0] = $isParticipant->user->name;
                    break;
                case '$eventName':
                    $textElement[0] = $eventData->event->event_name;
                    break;
                case '$eventStartDate':
                    $textElement[0] = $eventData->event->event_start_date;
                    break;
                case '$eventEndDate':
                    $textElement[0] = $eventData->event->event_end_date;
                    break;
                case '$eventLocation':
                    $textElement[0] = $eventData->event->event_location;
                    break;
                default:
                    // No replacement needed for other text elements
                    break;
            }
        }
        $ecertSVG = $xml->asXML();
        // Convert the svg to base64
        $dataUri = 'data:image/svg+xml;base64,' . base64_encode($ecertSVG);
    //    html to convert to pdf

        return view('eCertificate.ecert-view', compact('dataUri', 'ecertSVG'));
    }
}
