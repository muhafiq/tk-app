<div>
    <form wire:submit.prevent="submitActivityForm" class="space-y-5" enctype="multipart/form-data">
        <h2>Kegiatan Utama</h2>
        <flux:input wire:model.defer="form.event_name" placeholder="Nama kegiatan dan Dimana?" label="Nama Kegiatan" required />

        <flux:input wire:model.defer="form.date" label="Tanggal" type="date" required />

        <flux:textarea wire:model.defer="form.description" placeholder="Deskripsi" label="Deskripsi Kegiatan" required />

        <select wire:model.defer="form.type" required>
            <option value="">Pilih tipe Kegiatan</option>
            <option value="class">Class</option>
            <option value="school">School</option>
        </select>

        <h2>Sub Kegiatan</h2>
        @foreach ($subactivities as $index => $sub)
            <div wire:key="sub-{{ $index }}" class="border p-4 rounded-lg space-y-2">
                <flux:input
                    type="text"
                    wire:model.defer="subactivities.{{ $index }}.title"
                    placeholder="Judul Sub Kegiatan"
                    label="Judul Sub Kegiatan"
                    required
                />

                <flux:textarea
                    wire:model.defer="subactivities.{{ $index }}.description"
                    placeholder="Deskripsi Sub Kegiatan"
                    label="Deskripsi"
                    required
                />

                <flux:input
                    type="file"
                    multiple
                    wire:model="subactivities.{{ $index }}.photos"
                    accept="image/*"
                    label="Foto Sub Kegiatan"
                />

                <flux:button type="button" wire:click="removeSubactivity({{ $index }})">
                    Hapus Sub Kegiatan
                </flux:button>
            </div>
        @endforeach

        <button type="button" wire:click="addSubactivity" class="bg-blue-500 text-white px-4 py-2 rounded">
            + Tambah Sub Kegiatan
        </button>

        <flux:button type="submit" variant="primary" class="w-full">
            Simpan
        </flux:button>

        @if (session()->has('message'))
            <div class="text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>