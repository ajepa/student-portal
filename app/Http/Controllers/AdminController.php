<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use App\Subject;
use App\Course;
use App\User;
use App\LecturerSubject;
use App\Student;
use App\StudentSubject;

class AdminController extends Controller
{
    #Admin Index
    public function index(){
        return view('admin.index');
    }

    #Department
    public function department(){
    	$departments = Department::paginate(5);

        return view('admin.department', compact('departments'));
    }

    public function createDepartment(Request $request){
        $input = $request->all();
        
        Department::create($input);

        return redirect()->back();
    }

    public function updateDepartment(Request $request){
        $input = $request->all();
        
        $department = Department::find($request->id);
        
        $department->department_name = $input['name'];
        
        $department->save();
        
        return redirect()->back();
    }

    public function deleteDepartment(Request $request){
        $departments = Department::findOrFail($request->department_id);

		foreach($departments as $department){
    		$department->delete();
    	}

    	return redirect()->back();
    }

    #Subject
    public function showSubject(){
    	$subjects = Subject::paginate(5);

        return view('admin.subject', compact('subjects'));
    }

    public function createSubject(Request $request){
        $input = $request->all();
        
        Subject::create($input);

        return redirect()->back();
    }

    public function updateSubject(Request $request){
        $input = $request->all();
        
        $subject = Subject::find($request->id);
        
        $subject->subject_name = $input['name'];
        
        $subject->save();
        
        return redirect()->back();
    }

    public function deleteSubject(Request $request){
        $subjects = Subject::findOrFail($request->subject_id);

		foreach($subjects as $subject){
    		$subject->delete();
    	}

    	return redirect()->back();
    }

    #Course
    public function showCourse(){
        $courses = Course::paginate(5);

        return view('admin.course', compact('courses'));
    }

    public function createCourse(Request $request){
        $input = $request->all();
        
        Course::create($input);

        return redirect()->back();
    }

    public function updateCourse(Request $request){
        $input = $request->all();
        
        $course = Course::find($request->id);
        
        $course->course_name = $input['name'];
        
        $course->save();
        
        return redirect()->back();
    }

    public function deleteCourse(Request $request){
        $courses = Course::findOrFail($request->course_id);

        foreach($courses as $course){
            $course->delete();
        }

        return redirect()->back();
    }

    #User
    public function showUser(){
        $users = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin.user', compact('users'));
    }
    
    public function createUser(Request $request){
        $input = $request->except('password_confirmation');
        
        $input['password'] = bcrypt($request->password);
        
        User::create($input);

        return redirect()->back();
    }
    
    public function deleteUser(Request $request){
        $users = User::findOrFail($request->user_id);

		foreach($users as $user){
    		$user->delete();
    	}

    	return redirect()->back();
    }
    
    public function updateUser(Request $request){
        $input = $request->all();
        
        $user = User::find($request->id);
        
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->department = $input['department'];
        $user->roles = $input['roles'];
        
        $user->save();
        
        return redirect()->back();
    }

    #Lecturer Subject
    public function showLecturerSubject($user_id){
        $subject_lists = Subject::all();
        $subjects = LecturerSubject::select('subjects.subject_name', 'lecturer_subjects.id')
                                    ->join('subjects', 'subjects.id', '=', 'lecturer_subjects.subject_id')
                                    ->paginate(5);
        $user = User::find($user_id);
        return view('admin.lecturer-subject', compact('subjects', 'user', 'subject_lists'));

    }

    public function createLecturerSubject(Request $request){
        $input = $request->all();
        
        LecturerSubject::create($input);

        return redirect()->back();
    }

    public function deleteLecturerSubject(Request $request){
        $lecturer_subjects = LecturerSubject::findOrFail($request->id);

        foreach($lecturer_subjects as $lecturer_subject){
            $lecturer_subject->delete();
        }

        return redirect()->back();
    }

    #Student
    public function showStudent(){
        $students = Student::select('students.id', 'students.student_name', 'students.student_sem', 'courses.course_name as student_course', 'departments.department_name as student_department')
                            ->join('courses', 'courses.id', '=', 'students.student_course')
                            ->join('departments', 'departments.id', '=', 'students.student_department')
                            ->orderBy('id', 'DESC')->paginate(5);

        $departments = Department::all();

        $courses = Course::all();

        return view('admin.student', compact('students', 'departments', 'courses'));
    }
    
    public function createStudent(Request $request){
        $input = $request->all();
        
        Student::create($input);

        return redirect()->back();
    }
    
    public function deleteStudent(Request $request){
        $students = Student::findOrFail($request->student_id);

        foreach($students as $student){
            $student->delete();
        }

        return redirect()->back();
    }
    
    public function updateStudent(Request $request){
        $input = $request->all();
        
        $student = Student::find($request->id);
        
        $student->student_name = $input['student_name'];
        $student->student_sem = $input['student_sem'];
        $student->student_department = $input['student_department'];
        $student->student_course = $input['student_course'];
        
        $student->save();
        
        return redirect()->back();
    }

    #Student Subject
    public function showStudentSubject($user_id){
        $subject_lists = Subject::all();
        $subjects = StudentSubject::select('subjects.subject_name', 'student_subjects.id')
                                    ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
                                    ->where('student_subjects.student_id', $user_id)
                                    ->paginate(5);
        
        $student = Student::select('students.id', 'students.student_name', 'students.student_sem', 'courses.course_name as student_course', 'departments.department_name as student_department')
                            ->join('courses', 'courses.id', '=', 'students.student_course')
                            ->join('departments', 'departments.id', '=', 'students.student_department')
                            ->where('students.id', $user_id)->first();

        return view('admin.student-subject', compact('subjects', 'student', 'subject_lists'));

    }

    public function createStudentSubject(Request $request){
        $input = $request->all();
        
        StudentSubject::create($input);

        return redirect()->back();
    }

    public function deleteStudentSubject(Request $request){
        $student_subjects = StudentSubject::findOrFail($request->id);

        foreach($student_subjects as $student_subject){
            $student_subject->delete();
        }

        return redirect()->back();
    }

}
