<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContributionsImport;
use App\Models\years;
use App\Models\Contribution;
use App\Models\Coop_process;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContributionsController extends Controller
{

     /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImportExport()
    {
        $arr['years'] = years::select(['id','year_name'])->get();
       return view('admin.file-import')->with($arr);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request)
    {
             $request->validate([
            'month_id' => 'required|numeric',
        ]);

        $monthId = $request->input('month_id');
       $file = $request->file('file')->store('temp');
     //  Excel::import(new ContributionsImport, $file);

      // (new ContributionsImport)->import($file);

       $data = (new ContributionsImport)->toArray($file);
      //dd($data[0]);
      if(!empty($data[0])) {
       foreach($data[0] as $v) {
         //  dd($value);
            $contribution = new Contribution();


                $contribution->member_id = $v['member_id'];
                $contribution->month_id = $monthId;
                $contribution->amount = $v['amount'];
                $contribution->naration = $v['naration'];

            $contribution->save();

                    }

                   return redirect()->route('contributions.edit',$monthId);
            }
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport()
    {
       // return Excel::download(new UsersExport, 'users-collection.xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

                        $coop_process = new Coop_process();
                        $coop_process->payroll_id = $request->month_id;
                        $coop_process->transID = 2;
                        $coop_process->processed_by = Auth::user()->id;
                        $coop_process->save();

        DB::statement("execute proc_contributions  $request->month_id ");

        return redirect("admin/contributions/{$request->month_id}")->with('message', 'Monthly Contributions saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arr['contribution'] = Contribution::where('month_id', $id)->get();

        return view('admin.contributions.show')->with($arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($arr,$id);
        $arr['contribution'] = Contribution::where('month_id', $id)->get();
        $arr['month_id'] = $id;
        return view('admin.contributions.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
