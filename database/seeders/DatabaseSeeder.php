<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Period;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [];
        $classData = [
            ['name' => 'Class 1', 'section' => 'A', 'room_number' => '101', 'capacity' => 30],
            ['name' => 'Class 2', 'section' => 'A', 'room_number' => '102', 'capacity' => 35],
            ['name' => 'Class 3', 'section' => 'A', 'room_number' => '103', 'capacity' => 35],
            ['name' => 'Class 4', 'section' => 'A', 'room_number' => '201', 'capacity' => 40],
            ['name' => 'Class 5', 'section' => 'A', 'room_number' => '202', 'capacity' => 40],
            ['name' => 'Class 6', 'section' => 'B', 'room_number' => '203', 'capacity' => 40],
            ['name' => 'Class 7', 'section' => 'A', 'room_number' => '301', 'capacity' => 45],
            ['name' => 'Class 8', 'section' => 'A', 'room_number' => '302', 'capacity' => 45],
            ['name' => 'Class 9', 'section' => 'A', 'room_number' => '303', 'capacity' => 50],
            ['name' => 'Class 10', 'section' => 'A', 'room_number' => '304', 'capacity' => 50],
        ];

        foreach ($classData as $c) {
            $classes[] = SchoolClass::create($c);
        }

        $subjects = [];
        $subjectData = [
            ['name' => 'Mathematics', 'code' => 'MATH'],
            ['name' => 'English', 'code' => 'ENG'],
            ['name' => 'Urdu', 'code' => 'URD'],
            ['name' => 'Science', 'code' => 'SCI'],
            ['name' => 'Computer Science', 'code' => 'CS'],
            ['name' => 'Islamiat', 'code' => 'ISL'],
            ['name' => 'Pakistan Studies', 'code' => 'PST'],
            ['name' => 'Physics', 'code' => 'PHY'],
            ['name' => 'Chemistry', 'code' => 'CHM'],
            ['name' => 'Biology', 'code' => 'BIO'],
        ];

        foreach ($subjectData as $s) {
            $subjects[] = Subject::create($s);
        }

        $teachers = [];
        $teacherData = [
            ['name' => 'Ahmed Khan', 'email' => 'ahmed@school.com', 'phone' => '03001234567', 'employee_id' => 'TCH001', 'gender' => 'male', 'qualification' => 'M.Sc Mathematics', 'joining_date' => '2020-01-15'],
            ['name' => 'Fatima Ali', 'email' => 'fatima@school.com', 'phone' => '03012345678', 'employee_id' => 'TCH002', 'gender' => 'female', 'qualification' => 'M.A English', 'joining_date' => '2019-06-01'],
            ['name' => 'Muhammad Usman', 'email' => 'usman@school.com', 'phone' => '03023456789', 'employee_id' => 'TCH003', 'gender' => 'male', 'qualification' => 'M.Sc Physics', 'joining_date' => '2021-03-10'],
            ['name' => 'Ayesha Bibi', 'email' => 'ayesha@school.com', 'phone' => '03034567890', 'employee_id' => 'TCH004', 'gender' => 'female', 'qualification' => 'M.Sc Computer Science', 'joining_date' => '2022-01-01'],
            ['name' => 'Hassan Raza', 'email' => 'hassan@school.com', 'phone' => '03045678901', 'employee_id' => 'TCH005', 'gender' => 'male', 'qualification' => 'M.A Urdu', 'joining_date' => '2018-08-20'],
            ['name' => 'Sadia Noor', 'email' => 'sadia@school.com', 'phone' => '03056789012', 'employee_id' => 'TCH006', 'gender' => 'female', 'qualification' => 'M.Sc Chemistry', 'joining_date' => '2020-07-15'],
        ];

        foreach ($teacherData as $t) {
            $teachers[] = Teacher::create($t);
        }

        $assignments = [
            [0, 0, 0], [0, 0, 1], [0, 0, 2],
            [1, 1, 0], [1, 1, 1], [1, 1, 3],
            [2, 7, 8], [2, 7, 9],
            [3, 4, 4], [3, 4, 5], [3, 4, 7],
            [4, 2, 0], [4, 2, 1], [4, 5, 2],
            [5, 8, 8], [5, 8, 9],
        ];

        foreach ($assignments as [$ti, $si, $ci]) {
            TeacherSubject::create([
                'teacher_id' => $teachers[$ti]->id,
                'subject_id' => $subjects[$si]->id,
                'class_id' => $classes[$ci]->id,
            ]);
        }

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $times = [
            ['08:00', '08:45'], ['08:45', '09:30'], ['09:30', '10:15'],
            ['10:30', '11:15'], ['11:15', '12:00'], ['12:00', '12:45'],
        ];

        foreach ($classes as $classIdx => $class) {
            if ($classIdx > 2) break;
            foreach ($days as $day) {
                foreach ($times as $pIdx => $time) {
                    $teacherIdx = ($classIdx + $pIdx) % count($teachers);
                    $subjectIdx = ($classIdx + $pIdx) % count($subjects);
                    Period::create([
                        'teacher_id' => $teachers[$teacherIdx]->id,
                        'subject_id' => $subjects[$subjectIdx]->id,
                        'class_id' => $class->id,
                        'day' => $day,
                        'start_time' => $time[0],
                        'end_time' => $time[1],
                        'period_number' => $pIdx + 1,
                    ]);
                }
            }
        }

        $studentNames = [
            'Ali Ahmad', 'Bilal Khan', 'Chand Bibi', 'Danish Malik',
            'Erum Shah', 'Faisal Raza', 'Gulshan Ara', 'Hamza Ali',
            'Iqra Noor', 'Junaid Ahmed', 'Khadija Bibi', 'Luqman Khan',
            'Mariam Fatima', 'Nasir Uddin', 'Omer Farooq', 'Palwasha Bibi',
            'Qasim Ali', 'Rabia Noor', 'Saeed Khan', 'Tahira Begum',
            'Umar Hayat', 'Veena Kumari', 'Waseem Akram', 'Xenia Bibi',
            'Yasir Iqbal', 'Zainab Ali', 'Abdul Rehman', 'Bushra Khan',
            'Daniyal Ahmed', 'Eman Fatima',
        ];

        $studentCount = 0;
        foreach ($classes as $classIdx => $class) {
            $numStudents = min(count($studentNames) - $studentCount, rand(3, 5));
            for ($i = 0; $i < $numStudents && $studentCount < count($studentNames); $i++) {
                $name = $studentNames[$studentCount];
                Student::create([
                    'name' => $name,
                    'email' => strtolower(str_replace(' ', '.', $name)) . '@student.school.com',
                    'phone' => '030' . rand(10000000, 99999999),
                    'roll_number' => 'STD' . str_pad($studentCount + 1, 3, '0', STR_PAD_LEFT),
                    'class_id' => $class->id,
                    'gender' => $i % 2 == 0 ? 'male' : 'female',
                    'date_of_birth' => now()->subYears(rand(6, 16))->subDays(rand(1, 365)),
                    'parent_name' => 'Parent of ' . $name,
                    'parent_phone' => '030' . rand(10000000, 99999999),
                    'address' => 'House ' . rand(1, 500) . ', Street ' . rand(1, 50) . ', Peshawar',
                    'admission_date' => now()->subMonths(rand(1, 24)),
                ]);
                $studentCount++;
            }
        }

        $allStudents = Student::all();
        $statuses = ['present', 'present', 'present', 'present', 'absent', 'late'];

        for ($d = 0; $d < 10; $d++) {
            $date = now()->subDays($d);
            if ($date->isWeekend()) continue;

            foreach ($allStudents as $student) {
                Attendance::create([
                    'student_id' => $student->id,
                    'class_id' => $student->class_id,
                    'date' => $date,
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }
    }
}
