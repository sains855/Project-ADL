<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\User;

class AssignmentSubmissionController extends Controller
{
    private function checkDosenAccessToAssignment($assignmentId)
    {
        $assignment = Assignment::with('module.kelas')->find($assignmentId);
        if (!$assignment) {
            return [false, null];
        }

        $dosenId = Auth::user()->id;
        if ($assignment->modul->kelas->user_id !== $dosenId) {
            return [false, null];
        }

        return [true, $assignment];
    }

    public function getSubmissionsByAssignment($assignmentId)
    {
        try {
            [$authorized, $assignment] = $this->checkDosenAccessToAssignment($assignmentId);
            if (!$authorized) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses ke assignment ini.'
                ], 403);
            }

            $submissions = AssignmentSubmission::with(['user:id,name,email', 'assignment:id,title'])
                ->where('assignment_id', $assignmentId)
                ->orderBy('submitted_at', 'desc')
                ->get();

            $submissionsData = $submissions->map(function ($submission) {
                return [
                    'id' => $submission->id,
                    'student_name' => $submission->user->name,
                    'student_email' => $submission->user->email,
                    'submitted_at' => $submission->submitted_at->format('d-m-Y H:i:s'),
                    'file_url' => $submission->file_url,
                    'assignment_title' => $submission->assignment->title,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'assignment' => [
                        'id' => $assignment->id,
                        'title' => $assignment->title
                    ],
                    'submissions' => $submissionsData,
                    'total_submissions' => $submissions->count()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getSubmissionDetail($submissionId)
    {
        try {
            $submission = AssignmentSubmission::with(['user:id,name,email,nim', 'assignment:id,title,description,modul_id'])
                ->find($submissionId);

            if (!$submission) {
                return response()->json([
                    'success' => false,
                    'message' => 'Submission tidak ditemukan'
                ], 404);
            }

            [$authorized, $assignment] = $this->checkDosenAccessToAssignment($submission->assignment_id);
            if (!$authorized) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses ke submission ini.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $submission->id,
                    'student' => [
                        'id' => $submission->user->id,
                        'name' => $submission->user->name,
                        'email' => $submission->user->email,
                        'nim' => $submission->user->nim ?? null
                    ],
                    'assignment' => [
                        'id' => $submission->assignment->id,
                        'title' => $submission->assignment->title,
                        'description' => $submission->assignment->description
                    ],
                    'submitted_at' => $submission->submitted_at->format('d-m-Y H:i:s'),
                    'file_url' => $submission->file_url,
                    'created_at' => $submission->created_at->format('d-m-Y H:i:s'),
                    'updated_at' => $submission->updated_at->format('d-m-Y H:i:s')
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getSubmissionStats($assignmentId)
    {
        try {
            [$authorized, $assignment] = $this->checkDosenAccessToAssignment($assignmentId);
            if (!$authorized) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses ke assignment ini.'
                ], 403);
            }

            $totalSubmissions = AssignmentSubmission::where('assignment_id', $assignmentId)->count();

            $recentSubmissions = AssignmentSubmission::with('user:id,name')
                ->where('assignment_id', $assignmentId)
                ->orderBy('submitted_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($submission) {
                    return [
                        'student_name' => $submission->user->name,
                        'submitted_at' => $submission->submitted_at->format('d-m-Y H:i:s')
                    ];
                });

            $submissionsPerDay = DB::table('assignment_submissions')
                ->select(DB::raw('DATE(submitted_at) as date'), DB::raw('COUNT(*) as count'))
                ->where('assignment_id', $assignmentId)
                ->where('submitted_at', '>=', now()->subDays(7))
                ->groupBy(DB::raw('DATE(submitted_at)'))
                ->orderBy('date', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'assignment_title' => $assignment->title,
                    'total_submissions' => $totalSubmissions,
                    'recent_submissions' => $recentSubmissions,
                    'submissions_per_day' => $submissionsPerDay
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadSubmission($submissionId)
    {
        try {
            $submission = AssignmentSubmission::with(['user:id,name', 'assignment'])->find($submissionId);

            if (!$submission) {
                return response()->json([
                    'success' => false,
                    'message' => 'Submission tidak ditemukan'
                ], 404);
            }

            [$authorized, $assignment] = $this->checkDosenAccessToAssignment($submission->assignment_id);
            if (!$authorized) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk download file ini.'
                ], 403);
            }

            $filePath = storage_path('app/' . $submission->file_url);

            if (!file_exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak ditemukan'
                ], 404);
            }

            $fileName = $submission->user->name . '_' . basename($submission->file_url);

            return response()->download($filePath, $fileName);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function searchSubmissions(Request $request, $assignmentId)
    {
        try {
            [$authorized, $assignment] = $this->checkDosenAccessToAssignment($assignmentId);
            if (!$authorized) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk melihat data ini.'
                ], 403);
            }

            $searchTerm = $request->get('search', '');

            $submissions = AssignmentSubmission::with(['user:id,name,email', 'assignment:id,title'])
                ->where('assignment_id', $assignmentId)
                ->whereHas('user', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%')
                          ->orWhere('email', 'like', '%' . $searchTerm . '%');
                })
                ->orderBy('submitted_at', 'desc')
                ->get();

            $submissionsData = $submissions->map(function ($submission) {
                return [
                    'id' => $submission->id,
                    'student_name' => $submission->user->name,
                    'student_email' => $submission->user->email,
                    'submitted_at' => $submission->submitted_at->format('d-m-Y H:i:s'),
                    'file_url' => $submission->file_url,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $submissionsData,
                'search_term' => $searchTerm
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
