
<?php

use Illuminate\Support\Facades\Route;

use App\Models\Lead;
use App\Models\Job;
use App\Models\OutreachLog;
use App\Models\DailyActivity;
use App\Models\Skill;
use App\Models\Transaction;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\OutreachLogController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\DailyActivityController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;



/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // One-time Registration
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:5,1')
        ->name('register.submit');

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.submit');

});



/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
| Every workspace page requires authentication.
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', function () {

        $today = now()->toDateString();
        $weekStart = now()->subDays(6)->startOfDay();

        $leads = Lead::count();

        $outreachCount = OutreachLog::count();

        $replies = OutreachLog::whereIn('response_status', [
            'Replied',
            'Interested'
        ])->count();

        $jobsApplied = Job::whereNotNull('applied_date')->count();

        $income = Transaction::where('type', 'income')
            ->where('payment_status', 'Received')
            ->sum('amount');

        $todayActivity = DailyActivity::whereDate(
            'activity_date',
            $today
        )->first();

        $leadStages = Lead::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $jobStages = Job::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $skills = Skill::latest()->take(4)->get();

        $weeklyActivities = DailyActivity::whereDate(
            'activity_date',
            '>=',
            $weekStart
        )->orderBy('activity_date')->get();

        $weeklyLabels = [];
        $weeklyOutreach = [];
        $weeklyJobs = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = now()->subDays($i)->toDateString();

            $activity = $weeklyActivities->first(
                fn ($item) =>
                    $item->activity_date->toDateString() === $date
            );

            $weeklyLabels[] = now()->subDays($i)->format('D');

            $weeklyOutreach[] = $activity
                ? $activity->calls_made + $activity->messages_sent
                : 0;

            $weeklyJobs[] = $activity
                ? $activity->jobs_applied
                : 0;
        }

        $recentLeads = Lead::latest()->take(5)->get();

        $recentJobs = Job::latest()->take(5)->get();

        return view('dashboard', compact(
            'leads',
            'outreachCount',
            'replies',
            'jobsApplied',
            'income',
            'todayActivity',
            'leadStages',
            'jobStages',
            'skills',
            'weeklyLabels',
            'weeklyOutreach',
            'weeklyJobs',
            'recentLeads',
            'recentJobs'
        ));

    })->name('dashboard');


    // Client Leads
    Route::resource('leads', LeadController::class)
        ->except('show');


    // Outreach
    Route::resource('outreach', OutreachLogController::class)
        ->except('show');


    // Job Applications
    Route::resource('jobs', JobController::class)
        ->except('show');


    // Daily Activities
    Route::resource('activities', DailyActivityController::class)
        ->except('show');


    // Skills
    Route::resource('skills', SkillController::class)
        ->except('show');


    // Income & Expenses
    Route::resource('transactions', TransactionController::class)
        ->except('show');


    // Reports
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');


    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});




Route::get('/debug-session', function () {
    $path = storage_path('framework/sessions');
    
    // Try to write a session
    session(['debug_test' => now()->toDateTimeString()]);
    session()->save();
    
    // Check if directory exists and is writable
    $dirExists = is_dir($path);
    $dirWritable = is_writable($path);
    
    // Count files in session directory
    $files = [];
    if ($dirExists) {
        $files = array_diff(scandir($path), ['.', '..']);
    }
    
    return response()->json([
        'session_id' => session()->getId(),
        'session_driver' => config('session.driver'),
        'session_files_path' => config('session.files'),
        'storage_path' => $path,
        'dir_exists' => $dirExists,
        'dir_writable' => $dirWritable,
        'session_files_count' => count($files),
        'session_files_sample' => array_slice($files, 0, 5),
        'cookie_config' => [
            'name' => config('session.cookie'),
            'secure' => config('session.secure'),
            'same_site' => config('session.same_site'),
            'domain' => config('session.domain'),
            'path' => config('session.path'),
        ],
        'app_url' => config('app.url'),
        'request_secure' => request()->secure(),
    ]);
});