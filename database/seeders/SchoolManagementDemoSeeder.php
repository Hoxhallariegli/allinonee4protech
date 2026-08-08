<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolManagement\{Guardian, Teacher, SchoolClass, Student};
use Carbon\Carbon;

class SchoolManagementDemoSeeder extends Seeder
{
    public function run()
    {
        echo "🏫 Seeding School Management...\n";

        // 1. Guardians
        $guardians = [
            ['name' => 'Artur Muka', 'phone' => '0681234567', 'email' => 'artur.muka@example.com'],
            ['name' => 'Blerina Dashi', 'phone' => '0692345678', 'email' => 'blerina.dashi@example.com'],
            ['name' => 'Celik Mani', 'phone' => '0673456789', 'email' => 'celik.mani@example.com'],
            ['name' => 'Drita Leka', 'phone' => '0684567890', 'email' => 'drita.leka@example.com'],
            ['name' => 'Erion Sulo', 'phone' => '0695678901', 'email' => 'erion.sulo@example.com'],
        ];

        $guardianModels = [];
        foreach ($guardians as $g) {
            $guardianModels[] = Guardian::create($g);
        }
        echo "   ✅ 5 Guardians created.\n";

        // 2. Teachers
        $teachers = [
            ['name' => 'Prof. Agim Rama', 'subject' => 'Mathematics', 'phone' => '0681110001'],
            ['name' => 'Znj. Evisa Koka', 'subject' => 'Literature', 'phone' => '0681110002'],
            ['name' => 'Z. Sokol Meti', 'subject' => 'Physics', 'phone' => '0681110003'],
            ['name' => 'Znj. Mirela Gjoni', 'subject' => 'History', 'phone' => '0681110004'],
            ['name' => 'Prof. Edmond Haxhi', 'subject' => 'Computer Science', 'phone' => '0681110005'],
        ];

        $teacherModels = [];
        foreach ($teachers as $t) {
            $teacherModels[] = Teacher::create($t);
        }
        echo "   ✅ 5 Teachers created.\n";

        // 3. Classes
        $classes = [
            ['name' => 'Class 10-A', 'capacity' => 30],
            ['name' => 'Class 10-B', 'capacity' => 28],
            ['name' => 'Class 11-A', 'capacity' => 25],
            ['name' => 'Class 11-B', 'capacity' => 25],
            ['name' => 'Class 12-Science', 'capacity' => 20],
        ];

        $classModels = [];
        foreach ($classes as $index => $c) {
            $classModels[] = SchoolClass::create(array_merge($c, [
                'teacher_id' => $teacherModels[$index % count($teacherModels)]->id
            ]));
        }
        echo "   ✅ 5 Classes created.\n";

        // 4. Students
        $students = [
            ['name' => 'Albi Muka', 'birth_date' => Carbon::now()->subYears(15)],
            ['name' => 'Bora Dashi', 'birth_date' => Carbon::now()->subYears(16)],
            ['name' => 'Dori Mani', 'birth_date' => Carbon::now()->subYears(15)],
            ['name' => 'Ena Leka', 'birth_date' => Carbon::now()->subYears(17)],
            ['name' => 'Fatos Sulo', 'birth_date' => Carbon::now()->subYears(16)],
        ];

        foreach ($students as $index => $s) {
            Student::create(array_merge($s, [
                'guardian_id' => $guardianModels[$index % count($guardianModels)]->id,
                'class_id' => $classModels[$index % count($classModels)]->id,
            ]));
        }
        echo "   ✅ 5 Students created.\n";

        echo "✨ School Seeding Complete!\n";
    }
}
