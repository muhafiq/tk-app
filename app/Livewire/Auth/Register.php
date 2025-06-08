<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ParentModel;
use Livewire\WithFileUploads;
use App\Models\Student;
use App\Services\ClassroomAllocator;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    use WithFileUploads;
    public int $step = 1;
    public array $parentForm = [
        // stored in users table
        'name' => '',
        'phone_number' => '',
        'password' => '',
        'password_confirmation' => '',

        // stored in parents table
        'is_wali' => false,
        'gender' => '',
        'religion' => '',
        'address' => '',
        'job' => '',
        'income' => 0,
    ];

    public int $totalStudents = 1;
    public int $currentStudentIndex = 1;

    public array $studentForm = [
        'name' => '',
        'gender' => '',
        'religion' => '',
        'address' => '',
        'kartu_keluarga' => null,
        'akta_kelahiran' => null,
        'spesific_desease' => '',
        'birth_date' => null,
        'birth_place' => '',
        'nation' => '',
        'disabled' => false
    ];

    /**
     * Handle parent registration
     */
    public function submitParentForm(): void
    {
        $validated = $this->validate([
            'parentForm.name' => 'required|string|max:255',
            'parentForm.phone_number' => 'required|string|max:20|unique:users,phone_number',
            'parentForm.password' => 'required|string|min:8|confirmed',
            'parentForm.password_confirmation' => 'required|string|min:8',

            'parentForm.is_wali' => 'required|boolean',
            'parentForm.gender' => 'required|in:L,P',
            'parentForm.religion' => 'required|string|max:50|in:Islam,Kristen,Katolik,Hindu/Budha,Konghucu',
            'parentForm.address' => 'required|string|max:255',
            'parentForm.job' => 'required|string|max:100',
            'parentForm.income' => 'required|integer|min:0',
        ]);

        $data = $validated['parentForm'];

        $user = User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'role' => 'parent',
            'password' => Hash::make($data['password'])
        ]);

        $parent = ParentModel::create([
            'is_wali' => $data['is_wali'],
            'gender' => $data['gender'],
            'religion' => $data['religion'],
            'address' => $data['address'],
            'job' => $data['job'],
            'income' => $data['income'],
            'user_id' => $user->id,
        ]);

        session()->put('parent_id', $parent->id); // save for step 2
        $this->step = 2;
    }

    /**
     * Handle students registration
     */
    public function submitStudentForm()
    {
        $validated = $this->validate([
            'studentForm.name' => 'required|string',
            'studentForm.gender' => 'required|in:L,P',
            'studentForm.religion' => 'required|string',
            'studentForm.address' => 'required|string',
            'studentForm.kartu_keluarga' => 'image|max:2048',
            'studentForm.akta_kelahiran' => 'image|max:2048',
            'studentForm.spesific_desease' => 'string',
            'studentForm.birth_date' => 'required|date',
            'studentForm.birth_place' => 'required|string',
            'studentForm.nation' => 'required|string',
            'studentForm.disabled' => 'boolean'
        ]);

        $data = $validated['studentForm'];


        if (!empty($data['kartu_keluarga'])) {
            $data['kartu_keluarga'] = $this->uploadImage($data['kartu_keluarga']);
        }

        if (!empty($data['akta_kelahiran'])) {
            $data['akta_kelahiran'] = $this->uploadImage($data['akta_kelahiran']);
        }

        $data['parent_id'] = session('parent_id');
        $data['classroom_id'] = ClassroomAllocator::getAvailableClassroomId();

        Student::create($data);

        // cek apakah ini anak terakhir
        if ($this->currentStudentIndex < $this->totalStudents) {
            $this->currentStudentIndex++;
            $this->resetStudentForm(); // reset isian form untuk anak berikutnya
            session()->flash('message', "Data anak ke-{$this->currentStudentIndex} dari {$this->totalStudents}");
        } else {
            return redirect()->route('login')->with('success', 'Semua anak berhasil didaftarkan.');
        }
    }


    public function resetStudentForm()
    {
        $this->studentForm = [
            'name' => '',
            'gender' => '',
            'religion' => '',
            'address' => '',
            'kartu_keluarga' => null,
            'akta_kelahiran' => null,
            'spesific_desease' => '',
            'birth_date' => null,
            'birth_place' => '',
            'nation' => '',
            'disabled' => false
        ];
    }

    public function uploadImage($image, $folder = "student_docs")
    {
        if (!$image) return null;

        // Simpan ke storage/app/public/student_docs/namafile.jpg
        return $image->store($folder, 'public');
    }
}
