<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Project;
use App\Models\StudentsCertificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Storage;
use Str;

class StudentCertificateController extends Controller
{
    public function generateCertificate($courseId)
    {
        $student = auth()->user();
        $course = Course::findOrFail($courseId);

        $certificate = StudentsCertificate::firstOrCreate(
            ['studentId' => $student->id, 'courseId' => $courseId],
            [
                'issuedDate' => Carbon::now(),
                'pdfPath' => null,
            ]
        );

        $studentName = collect(explode(' ', $student->name))->take(2)->join(' ');
        
        $data = [
            'studentName' => $studentName,
            'courseName' => $course->courseName,
            'issuedDate' => $certificate->issuedDate->format('d F Y'),
            'certificateId' => 'CERT-' . str_pad($certificate->id, 6, '0', STR_PAD_LEFT),
        ];

        $pdf = Pdf::loadView('certificates.certificate_template', $data)
        ->setPaper('a4', 'landscape');

        $certificate->load('course');
        $fileName = 'certificate_' . Str::slug($certificate->course->courseName) . '.pdf';
        $filePath = 'certificates/' . $fileName;

        Storage::disk('public')->put($filePath, $pdf->output());

        $certificate->update([
            'pdfPath' => $filePath,
        ]);

        return $pdf->download($fileName);
        
    }
}
