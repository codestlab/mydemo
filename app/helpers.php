<?php

function uploadFile($file){
    $brandCr = $file;
    $ImagesDestinationPath = base_path().'/public/uploads';
    $imageName = 'brand_cr_'. time().'.'.$brandCr->getClientOriginalExtension();
    $brandCr->move($ImagesDestinationPath, $imageName);
    return $imageName;
}

function generatePDF($data){
    $pdf = PDF::loadView('pdf', $data, [], [
        'temp_dir'               => public_path('uploads/temp'),
    ]);

    $path = public_path('uploads/users');
    $fileName = 'user_detail_' . time() . '.' . 'pdf' ;
    $fullPath = $path . '/' . $fileName;
    $pdf->save($fullPath);

    return $fullPath;
}
