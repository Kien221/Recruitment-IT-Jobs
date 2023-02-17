<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\companies;
use App\Models\imagesCompany;
class CompaniesController extends Controller
{
    public function create_Company_View(){
        $company = companies::where('hr_id',session()->get('hr_id'))->first();
        return view('hr_view.create_company',compact('company'));
    }
    public function store(Request $request){
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'industry' => $request->industry,
            'tax_code' => $request->tax_code,
            'number_of_employees' => $request->number_of_employees,
            'city' => $request->city,
            'description' => $request->description,
            'hr_id' => session()->get('hr_id'),
        ];
        if($request->hasFile('logo')){
            $file_logo = $request->file('logo')->store('company/logo_company','public');
            $data['logo'] = $file_logo;
        }
        $company = new companies;
        $company->fill($data);
        $company->save();
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $image_company = $image->store('company/images_company','public');
                $data_image = [
                    'company_id' => $company->id,
                    'image' => $image_company,
                ];
                $image = new imagesCompany;
                $image->fill($data_image);
                $image->save();
            }
        }
        return redirect()->route('create.company')->with('success','Tạo công ty thành công');
    }
}
