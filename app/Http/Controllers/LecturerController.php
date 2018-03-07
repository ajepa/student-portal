<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LecturerSubject;
use App\Assessment;
use App\Student;
use App\StudentSubject;
use App\StudentAssessment;
use App\Subject;
use App\SubjectMark;

use Auth;
use DB;

class LecturerController extends Controller
{
    #Lecturer Index
    public function index(){
        return view('lecturer.index');
    }

    #List of subject
    public function showLecturerListSubject(){
    	$lecturer_id = Auth::user()->id;

    	$subjects = LecturerSubject::select('lecturer_subjects.subject_id as subject_id', 'subjects.subject_name')
    								->join('subjects', 'subjects.id', '=', 'lecturer_subjects.subject_id')
    								->where('lecturer_id', $lecturer_id)
    								->paginate(5);

        return view('lecturer.lecturer-list-subject', compact('subjects'));
    }

    #Assessment
    public function showAssessment($subject_id){
        $assessments = assessment::where('subject_id', $subject_id)->paginate(5);

        return view('lecturer.lecturer-list-assessment', compact('assessments', 'subject_id'));
    }

    public function createAssessment(Request $request){
        $input = $request->all();
        
        Assessment::create($input);

        return redirect()->back();
    }

    public function updateAssessment(Request $request){
        $input = $request->all();
        
        $assessment = Assessment::find($request->id);
        
        $assessment->assessment_name = $input['name'];
        
        $assessment->save();
        
        return redirect()->back();
    }

    public function deleteAssessment(Request $request){
        $assessments = Assessment::findOrFail($request->assessment_id);

        foreach($assessments as $assessment){
            $assessment->delete();
        }

        return redirect()->back();
    }

    #Student Marks OLD
    public function showStudentMarks($assessment_id){
        $assessment = Assessment::findOrFail($assessment_id);

        $student_assessments = Student::select('students.id as student_id', 'students.student_name', 'assessments.assessment_name', 'student_assessments.marks', DB::raw('COALESCE(student_assessments.id,0) as student_assessment_id'))
                                        ->join('student_subjects', 'student_subjects.student_id', '=', 'students.id', 'LEFT OUTER')
                                        ->join('assessments', 'student_subjects.subject_id', '=', 'assessments.subject_id', 'LEFT OUTER')
                                        ->leftJoin('student_assessments', function($join) use($assessment_id){
                                            $join->on('students.id', '=', 'student_assessments.student_id')
                                            ->where('student_assessments.assessment_id', '=', $assessment_id);
                                        })
                                        ->where('assessments.id', $assessment_id)->get();


        return view('lecturer.lecturer-assessment-mark', compact('assessment', 'student_assessments'));
    }

    public function processStudentMarks(Request $request){
        $input = $request->all();
        $sa_ids = $input['sa_ids'];
        $marks = $input['marks'];
        $assessment_id = $input['assessment_id'];
        $s_id = $input['s_id'];
        $field = [];

        foreach ($marks as $key => $mark){
            if($sa_ids[$key] != 0){
                $student_assessment = StudentAssessment::find($sa_ids[$key]);

                $student_assessment->marks = $mark;

                $student_assessment->save();
            }
            else{
                $student_id = $s_id[$key];
                $field['marks'] = $mark;
                $field['assessment_id'] = $assessment_id;
                $field['student_id'] = $student_id;

                StudentAssessment::create($field);
            }
        }

        return redirect()->back();
    }

    #Student Marks New
    public function showStudentSubjectMarks($subject_id){
        $subject = Subject::findOrFail($subject_id);

        $student_assessments = Student::select('students.id as student_id', 'students.student_name', 'subject_marks.quiz', 'subject_marks.midterm', 'subject_marks.assignment', 'subject_marks.mini_project', DB::raw('COALESCE(subject_marks.id,0) as subject_marks_id'))
                                        ->join('student_subjects', 'student_subjects.student_id', '=', 'students.id', 'LEFT OUTER')
                                        ->leftJoin('subject_marks', function($join) use($subject_id){
                                            $join->on('students.id', '=', 'subject_marks.student_id')
                                            ->where('subject_marks.subject_id', '=', $subject_id);
                                        })
                                        ->where('student_subjects.subject_id', $subject_id)->get();


        return view('lecturer.lecturer-student-subject-mark', compact('subject', 'student_assessments'));
    }

    public function processStudentSubjectMarks(Request $request){
        $input = $request->all();
        $sm_ids = $input['sm_ids'];
        $quizs = $input['quiz'];
        $midterm = $input['midterm'];
        $assignment = $input['assignment'];
        $mini_project = $input['mini_project'];
        $subject_id = $input['subject_id'];
        $s_id = $input['s_id'];
        $field = [];

        foreach ($quizs as $key => $quiz){
            if($sm_ids[$key] != 0){
                $subject_mark = SubjectMark::find($sm_ids[$key]);

                $subject_mark->quiz = $quiz;
                $subject_mark->midterm = $midterm[$key];
                $subject_mark->assignment = $assignment[$key];
                $subject_mark->mini_project = $mini_project[$key];

                $subject_mark->save();
            }
            else{
                $student_id = $s_id[$key];
                
                $field['quiz'] = $quiz;
                $field['midterm'] = $midterm[$key];
                $field['assignment'] = $assignment[$key];
                $field['mini_project'] = $mini_project[$key];

                $field['subject_id'] = $subject_id;
                $field['student_id'] = $student_id;

                SubjectMark::create($field);
            }
        }

        return redirect()->back();
    }
}
