<div class="max-w-2xl mx-auto py-10 px-6 space-y-8">
    <!-- Step Heading -->
    <div class="space-y-1">
        <h2 class="text-2xl font-bold">
            {{ $step === 1 ? 'Data Orang Tua' : "Data Anak ke-{$currentStudentIndex} dari {$totalStudents}" }}
        </h2>
        <p class="text-gray-500 text-sm">
            {{ $step === 1 ? 'Isi data lengkap orang tua dan jumlah anak yang ingin didaftarkan.' : 'Lengkapi data anak sesuai urutan.' }}
        </p>
    </div>

    @if ($step === 1)
        <form wire:submit.prevent="submitParentForm" class="space-y-5">
            <flux:input wire:model.defer="parentForm.name" label="Nama Lengkap" required placeholder="Nama orang tua/wali" />

            <flux:input wire:model.defer="parentForm.phone_number" label="Nomor Telepon" type="tel" required placeholder="08xxxxxxxxxx" />

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model.defer="parentForm.password" label="Password" type="password" required />
                <flux:input wire:model.defer="parentForm.password_confirmation" label="Konfirmasi Password" type="password" required />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:select wire:model.defer="parentForm.gender" label="Jenis Kelamin" required>
                    <option value="">Pilih</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </flux:select>

                <flux:select wire:model.defer="parentForm.religion" label="Agama" required>
                    <option value="">Pilih</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu/Budha">Hindu/Budha</option>
                    <option value="Konghucu">Konghucu</option>
                </flux:select>
            </div>

            <flux:textarea wire:model.defer="parentForm.address" label="Alamat" required placeholder="Alamat lengkap orang tua" />

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model.defer="parentForm.job" label="Pekerjaan" required />
                <flux:input wire:model.defer="parentForm.income" label="Penghasilan per bulan (Rp)" type="number" required />
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" wire:model.defer="parentForm.is_wali" class="rounded border-gray-300">
                <label class="text-sm text-gray-700">Orang tua adalah wali</label>
            </div>

            <flux:input wire:model="totalStudents" label="Jumlah Anak yang Didaftarkan" type="number" min="1" required />

            <flux:button type="submit" variant="primary" class="w-full">Lanjut ke Form Anak</flux:button>
        </form>
    @else
        <form wire:submit.prevent="submitStudentForm" class="space-y-5">
            <flux:input wire:model.defer="studentForm.name" label="Nama Anak" required />

            <div class="grid grid-cols-2 gap-4">
                <flux:select wire:model.defer="studentForm.gender" label="Jenis Kelamin" required>
                    <option value="">Pilih</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </flux:select>

                <flux:select wire:model.defer="studentForm.religion" label="Agama" required>
                    <option value="">Pilih</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu/Budha">Hindu/Budha</option>
                    <option value="Konghucu">Konghucu</option>
                </flux:select>
            </div>

            <flux:textarea wire:model.defer="studentForm.address" label="Alamat Anak" required />

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model.defer="studentForm.birth_place" label="Tempat Lahir" required />
                <flux:input wire:model.defer="studentForm.birth_date" label="Tanggal Lahir" type="date" required />
            </div>

            <flux:input wire:model.defer="studentForm.nation" label="Kebangsaan" required />
            <flux:input wire:model.defer="studentForm.spesific_desease" label="Penyakit Khusus (jika ada)" />

            <div class="flex items-center gap-2">
                <input type="checkbox" wire:model.defer="studentForm.disabled" class="rounded border-gray-300">
                <label class="text-sm text-gray-700">Anak berkebutuhan khusus</label>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="studentForm.kartu_keluarga" label="Upload Kartu Keluarga" type="file" accept="image/*" />
                <flux:input wire:model="studentForm.akta_kelahiran" label="Upload Akta Kelahiran" type="file" accept="image/*" />
            </div>

            <flux:button type="submit" variant="primary" class="w-full">
                {{ $currentStudentIndex < $totalStudents ? 'Simpan & Lanjut Anak Berikutnya' : 'Simpan & Selesai' }}
            </flux:button>
        </form>
    @endif
</div>