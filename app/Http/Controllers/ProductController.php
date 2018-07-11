<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\AreaOffice;
use App\Feeder;

class ProductController extends Controller{
  

    public function importExportView(){

        return view('import_export');

    }


    public function importFile(Request $request){
   
        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();

            $data = \Excel::load($path)->get();

            if($data->count()){
                //$data->ignoreEmpty();
                foreach ($data as $key => $value) {
                    //query the feeders table here
                    //if you get a valid feeder, set feeder_id=$feeder->id
                    //do the same for area_office
                  
                    //$area= AreaOffice::find();
                   // $AreaOffice = AreaOffice::where('name','like', '%' .$value->name. '%')->first();
                     $AreaOffice = AreaOffice::where('name','like', '%' .$value->area_office_id. '%')->first();
                    //$Feeder = Feeder::where('name','like', '%' .$value->area_office_id . '%')->get();

                  $arr[] = [
                        'name' => $value->name = $value->name ?? '',
                        'rating' => $value->rating = $value->rating ?? '',
                        'voltage_ratio' => $value->voltage_ratio = $value->voltage_ratio ?? '',
                        'category' => $value->category = $value->category ?? '',
                        'type' => $value->type = $value->type ?? '',
                        'area_office_id' => $AreaOffice->id = $AreaOffice->id ?? 1,
                        
                        'location' => $value->location = $value->location ?? '',
                        'coverage_area' => $value->coverage_area = $value->coverage_area ?? '',
                        'created_by' => $value->created_by = $value->created_by ?? '',
                        'status' => $value->status =  $value->status ?? '',
                    ];

                   // $arrs[] = ['name' =>$AreaOffice->id ,'title' => $value->title, 'body' => $value->body];

                }

                if(!empty($arr)){

                   // \DB::table('products')->insert($arrs);
                    \DB::table('paga')->insert($arr);

                    dd('Insert Recorded successfully.');

                }

            }

        }

        dd('Request data does not have any files to import.');       

       // return AreaOffice::all();

    } 


    public function exportFile($type){

        $products = Product::get()->toArray();

        return \Excel::create('hdtuto_demo', function($excel) use ($products) {

            $excel->sheet('sheet name', function($sheet) use ($products){

                $sheet->fromArray($products);
            });

        })->download($type);

    }  
}
