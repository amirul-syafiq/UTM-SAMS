<?php

namespace App\Http\Controllers;

use App\Models\EventAdvertisementImage;
use Illuminate\Http\Request;

class EventAdvertisementImageController extends Controller
{
    public function store($image, $eventAdvertisementId){

        $eaImage=EventAdvertisementImage::where('event_advertisement_id', $eventAdvertisementId)->get();

        if($eaImage->count() > 0){
            $imageFileName = $eaImage->first()->image_name;
            $s3 = \Illuminate\Support\Facades\Storage::disk('s3');
            $filePath = '/eventAdvertisement/' . $imageFileName;
            $s3->delete($filePath);
        }
        $imageFileName = 'EAI'.$eventAdvertisementId .'.' . $image->getClientOriginalExtension();
        $s3 = \Illuminate\Support\Facades\Storage::disk('s3');
        $filePath = '/eventAdvertisement/' . $imageFileName;
        $s3->put($filePath, file_get_contents($image));

        EventAdvertisementImage::create([
            'event_advertisement_id' => $eventAdvertisementId,
            'image_name' => $imageFileName,
            'image_s3_key' => $filePath

        ]);

    }



}
