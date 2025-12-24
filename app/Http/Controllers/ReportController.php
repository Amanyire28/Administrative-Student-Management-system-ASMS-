<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Mark;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    /**
     * Show the report card form
     */
    public function form()
    {
        $students = Student::orderBy('name')->get();
        return view('reports.form', compact('students'));
    }

    /**
     * Generate report card
     */
    public function generate(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'term' => 'required|in:1,2,3',
            'academic_year' => 'required'
        ]);

        return redirect()->route('report.card', [
            'student' => $request->student_id,
            'term' => $request->term,
            'year' => $request->academic_year
        ]);
    }

    /**
     * Show report card
     */
    public function show(Student $student, Request $request)
    {
        $term = $request->get('term', 1);
        $year = $request->get('year', date('Y'));

        $marks = Mark::where('student_id', $student->id)
                    ->where('term', $term)
                    ->where('academic_year', $year)
                    ->with('subject')
                    ->get();

        $totalMarks = $marks->sum('marks_obtained');
        $totalPossible = $marks->sum('total_marks');
        $percentage = $totalPossible > 0 ? ($totalMarks / $totalPossible) * 100 : 0;

        return view('reports.show', compact('student', 'marks', 'term', 'year', 'totalMarks', 'totalPossible', 'percentage'));
    }

    /**
     * Download report card as PDF
     */
    public function download(Student $student, Request $request)
    {
        $term = $request->get('term', 1);
        $year = $request->get('year', date('Y'));

        $marks = Mark::where('student_id', $student->id)
                    ->where('term', $term)
                    ->where('academic_year', $year)
                    ->with('subject')
                    ->get();

        $totalMarks = $marks->sum('marks_obtained');
        $totalPossible = $marks->sum('total_marks');
        $percentage = $totalPossible > 0 ? ($totalMarks / $totalPossible) * 100 : 0;

        $pdf = PDF::loadView('reports.pdf', compact('student', 'marks', 'term', 'year', 'totalMarks', 'totalPossible', 'percentage'));

        return $pdf->download("report-card-{$student->admission_number}-term{$term}-{$year}.pdf");
    }
}
