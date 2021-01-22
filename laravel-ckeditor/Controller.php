<?php

namespace fireproof\Http\Controllers\setting;

use Illuminate\Http\Request;
use fireproof\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use fireproof\SettingPDF1;
use fireproof\SettingPDF2;
use fireproof\SettingPDFfooter;
use fireproof\SettingPDFDocument;

class PdfsettingController extends Controller
{
    public function settingpdf1()
    {
        $id = Auth::user()->CompanyId;  
        $pdf1 = SettingPDF1::where('CompanyId',$id)->first();
        $pdf2 = SettingPDF2::where('CompanyId',$id)->first();
        $pdf_footer = SettingPDFfooter::where('CompanyId',$id)->first();
        $pdf_document = SettingPDFDocument::where('CompanyId',$id)->first();
        return view('Setting.settingpdf1',compact('pdf1','pdf2','pdf_footer','pdf_document'));
    }
    public function submitpdf1(Request $request)    
    {
        $id = Auth::user()->CompanyId;       

        $valid = $request->validate([
            'editor1' => 'required'            
        ],
        [
           'editor1.required' => 'The PDF Formate One field is required.',
        ]);
        $update_val = $request->updval;
        if(!is_null($update_val)){
            $a = SettingPDF1::find($update_val);
        } else {
            $a = new SettingPDF1;
        }
        $a->CompanyId = $id;
        $a->msg = $request->editor1;             
        $a->created_at = date('Y-m-d H:i:s'); 
        $a->updated_at = date('Y-m-d H:i:s');
        $a->save();
        
        if(!is_null($update_val)){
            return redirect()->back()->with('success', 'PDF Formate One update successfully!');
        }
        else
        {
            return redirect()->back()->with('success', 'PDF Formate One added successfully!');	
        }
    }
   
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('images/pdf/'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/pdf/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
