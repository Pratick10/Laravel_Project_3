<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\SessionName;
use Illuminate\Support\Facades\DB;
use App\Models\StudentEnrollment;
use App\Models\Section;
use App\Models\Type;
use Illuminate\Support\Facades\Session;

class EnrollmentController extends Controller
{
    public function indexrequest(){
        $subjects = Subject::all();
        $sessions = SessionName::all();
        $sections = Section::all();
        $types = Type::all();
        //return view('admin.pages.sessions',compact('sessions'));
        return view('student.pages.enroll',compact('subjects','sessions','sections','types'));
    }
    public function index(){
        // $student_id=Session::get('id');
        // $id= $request->id;
        // print_r($id);
        $course= StudentEnrollment::all();
        // $course= StudentEnrollment::where('student_id','=',$student_id)->first();
        // $course= StudentEnrollment:: join('sections','student_enrollments.section','sections.id')
        // ->select('student_enrollments.id','student_enrollments.student_id','student_enrollments.sub_id','student_enrollments.sub_name','student_enrollments.sub_code','student_enrollments.sub_shortname','student_enrollments.sub_type','student_enrollments.session','student_enrollments.course_type','sections.section as section')
        // ->get();
        // $course = DB::table('student_enrollments')
        // ->join('sections','student_enrollments.section','sections.id')
        // ->join('types','student_enrollments.course_type','types.id')
        // ->select('student_enrollments.id','student_enrollments.student_id','student_enrollments.sub_id','student_enrollments.sub_name','student_enrollments.sub_code','student_enrollments.sub_shortname','student_enrollments.sub_type','student_enrollments.session','types.t_name as type','sections.section as section')
        // ->orderBy('student_enrollments.id', 'asc')
        // // ->where('student_enrollments.student_id','$student_id')
        // ->get();
        //return view('admin.pages.sessions',compact('sessions'));
        return view('student.pages.requestedcourse',compact('course'));
    }
    public function storerequest(Request $request){
        /**$checkbox=$request->checkbox;
        //$sub_type=$request->sub_type;
        $sub_type=Session::get('username');

        for($i=0;$i<count($checkbox);$i++)
        {
            $datasave=[

                //'sub_id'=>$checkbox[$i],
                'sub_id'=>$sub_type,
                'subject_id'=>$checkbox[$i],

            ];
            //return dd($datasave);
            DB::table('enrollmentstus')->insert($datasave);

        }
        return redirect()->back();**/

        if(!empty($request->input('checkbox'))){
            $will_insert=[];
            $will_sert=[];
            $student_id=Session::get('id');
            $sessionname=$request->session;
            // print_r($sessioname);
            foreach($request->input('checkbox') as $key=>$value){
                $subject=Subject::find($value);
                // $validated = $request->validate([
                //     // 'checkbox'=> 'required|unique:student_enrollments,session',
                //     // 'sub_name' => 'required|unique:student_enrollments,sub_name'
                //     // 'sub_name' => 'required',
                //     // 'sub_code' => 'required|unique:student_enrollments,sub_name',
                //     // 'sub_shortname' => 'required|unique:student_enrollments,sub_shortname',
                //     // 'sub_type' => 'required',
                //     // 'student_id' => 'required|section|unique:sections,section',
                //     // 'dob' => 'required|date_format:Y-m-d|before_or_equal:'.$todayDate,
                    
        
                // ]);
                $subjectname=$subject->sub_name;
                $subjectcode=$subject->sub_code;
                $subjectshortname=$subject->sub_shortname;
                $subjecttype=$subject->sub_type;
                $sec_name = $request-> section_name;
                $course_name = $request-> course_name;

                DB::table('student_enrollments')->insert(
                    array('student_id' => $student_id, 'sub_id' => $value,'sub_name'=>$subjectname,
                    'sub_code'=>$subjectcode,'sub_shortname'=>$subjectshortname,
                    'sub_type'=>$subjecttype,'session'=>$sessionname, 'section' => $sec_name, 
                    'course_type' => $course_name)
                );
                
                //array_push($will_sert,['sub_id'=>$sub_type]);
                //array_push($will_insert,['subject_id'=>$value]);


            }
           // DB::table('enrollmentstus')->insert($will_sert,$will_insert,);
        }
        return redirect()->to('enroll');

    }
}
