<?php

namespace App\Http\Controllers;

use App\Exports\homeModelExport;
use App\Imports\homeModelImport;
use App\Models\homeModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class HomeModelController extends Controller
{
    public function index(Request $request) {

        if($request->has('search')){
            $data =  homeModel::where('name', 'LIKE', '%' .$request->search.'%')->paginate(5);
        }else{
            $data =  homeModel::paginate(5);
        }

        return view('home', compact('data'));
    }

   public function login(){
        return view('add');
   }

   public function insert(Request $request){
        $data = homeModel::create($request->all());

        if($request->hasFile('foto')){
            $request->file('foto')->move('img/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('santri')->with('success','Data added successfully!');
    }

    public function showData($id){
        $data = homeModel::find($id);
        // dd($data);
        return view('show', compact('data'));
    }

    public function updateData(Request $request, $id){
        $data = homeModel::find($id);
        $data->update($request->all());

        return redirect()->route('santri')->with('success','Data successfully edited!');
    }

    public function deleteData($id){
        $data = homeModel::find($id);
        $data->delete();

        return redirect()->route('santri')->with('success','Data successfully deleted!');
    }

    public function exportPdf(){

        $data = homeModel::all();
        view()->share('data', $data);

        $pdf = PDF::loadview('home-pdf');
        return $pdf->download('data.pdf');

    }

    public function exportExcel(){
        return Excel::download(new homeModelExport, 'data.xlsx');
    }

    public function importExcel(Request $request){
        $data = $request->file('file');
        $nameFile = $data->getClientOriginalName();
        $data->move ('studentData', $nameFile);

        Excel::import(new homeModelImport, \public_path('/studentData/'.$nameFile));
        return \redirect()->back();
    }
}
