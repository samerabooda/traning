<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    public function index()
    {

        return view('admin.setting');
    }


    public function update(Request $request,$id)
    {
            $request->validate([
                'sitename'=>'required',
                'email'=>'required',
                'keyword'=>'required',
                'descrption'=>'required',
                'maintance'=>'required',
                'maintancemassege'=>'required',
            ]);

            $data = Setting::find($id);
            $data->sitename = $request->sitename;
            $data->siteEmailAddress = $request->email;
            $data->siteKeywords = $request->keyword;
            $data->siteDescription = $request->descrption;
            $data->maintenance = $request->maintance;
            $data->maintenance_massage = $request->maintancemassege;
            $data->save();
              session()->flash('success',__('تم التعديل بنجاح'));
              return back();


    }


}
