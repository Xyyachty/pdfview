<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display student form
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return view('students.create');
    }

    // Save Student Record -> Success Message
    public function store(Request $request)
    {
        // Check if all fields are empty
        if (empty($request->student_id) && empty($request->full_name) && empty($request->course)) {
            return back()->withInput()->with('error', 'All fields are required! Please fill out the form.');
        }

        $request->validate([
            'student_id' => 'required|unique:students',
            'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'course' => 'required|regex:/^[a-zA-Z\s]+$/'
        ], [
            'student_id.required' => 'The student ID field is required.',
            'full_name.required' => 'The full name field is required.',
            'full_name.regex' => 'The full name must only contain letters and spaces.',
            'course.required' => 'The course field is required.',
            'course.regex' => 'The course must only contain letters and spaces.',
        ]);

        Student::create($request->all());

        return back()->with('success', 'Student record added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $students = Student::all();
        return view('students.index', compact('student', 'students'));
    }

    // Update student
    public function update(Request $request, $id)
    {
        // Check if all fields are empty
        if (empty($request->student_id) && empty($request->full_name) && empty($request->course)) {
            return back()->withInput()->with('error', 'All fields are required! Please fill out the form.');
        }

        $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $id,
            'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'course' => 'required|regex:/^[a-zA-Z\s]+$/'
        ], [
            'student_id.required' => 'The student ID field is required.',
            'full_name.required' => 'The full name field is required.',
            'full_name.regex' => 'The full name must only contain letters and spaces.',
            'course.required' => 'The course field is required.',
            'course.regex' => 'The course must only contain letters and spaces.',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student record updated successfully!');
    }

    // Delete student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return back()->with('warning', 'Warning: Student record has been deleted!');
    }

    // Invalid Action -> Error Message
    public function invalidAction()
    {
        return redirect()->route('students.index')->with('error', 'Invalid action performed!');
    }

    // Restricted Page Access -> Warning Message
    public function restrictedPage()
    {
        return redirect()->route('students.index')->with('warning', 'Access restricted! You do not have permission.');
    }

    // Display System Notice -> Info Message
    public function systemNotice()
    {
        return redirect()->route('students.index')->with('info', 'System maintenance scheduled for tonight.');
    }
}
