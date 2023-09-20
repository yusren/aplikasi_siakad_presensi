<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('judul', function ($expression) {
            return "<?php echo e(Str::words($expression, 7, '...')); ?>";
        });

        Blade::directive('desc', function ($expression) {
            return "<?php echo e(Str::words($expression, 14, '...')); ?>";
        });

        $grade_boundaries = [
            'A' => json_decode(Storage::disk('public')->get('settings.json'), true)['A'],
            'A-' => json_decode(Storage::disk('public')->get('settings.json'), true)['A-'],
            'B+' => json_decode(Storage::disk('public')->get('settings.json'), true)['B+'],
            'B' => json_decode(Storage::disk('public')->get('settings.json'), true)['B'],
            'B-' => json_decode(Storage::disk('public')->get('settings.json'), true)['B-'],
            'C+' => json_decode(Storage::disk('public')->get('settings.json'), true)['C+'],
            'C' => json_decode(Storage::disk('public')->get('settings.json'), true)['C'],
            'C-' => json_decode(Storage::disk('public')->get('settings.json'), true)['C-'],
            'D' => json_decode(Storage::disk('public')->get('settings.json'), true)['D'],
        ];

        view()->share('grade_boundaries', $grade_boundaries);

        view()->share('convertScoreToGrade', function ($score) use ($grade_boundaries) {
            foreach ($grade_boundaries as $grade => $boundary) {
                if ($score >= $boundary) {
                    return $grade;
                }
            }

            return '~';
        });
    }
}
