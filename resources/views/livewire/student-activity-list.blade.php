<div>
    <h2 class="text-xl font-bold mb-4">Daftar Kegiatan</h2>

    @forelse ($events as $event)
        <div class="border p-4 mb-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold">{{ $event->event_name }}</h3>
            <p class="text-sm text-gray-600">{{ $event->date }} | Tipe: {{ $event->type }}</p>
            <p class="mt-2">{{ $event->description }}</p>

            <div class="mt-4">
                <h4 class="font-semibold">Gambar Umum:</h4>
                <div class="flex flex-wrap gap-2 mt-2">
                    @foreach ($event->images as $img)
                        <img src="{{ asset('storage/' . $img->image_url) }}" alt="event image" class="w-24 h-24 object-cover rounded">
                    @endforeach
                </div>
            </div>

            @if ($event->subactivities->count())
                <div class="mt-4">
                    <h4 class="font-semibold">Sub Kegiatan:</h4>
                    @foreach ($event->subactivities as $sub)
                        <div class="mt-3 p-3 border rounded">
                            <p class="font-medium">{{ $sub->title }}</p>
                            <p>{{ $sub->description }}</p>
                            <div class="flex flex-wrap gap-2 mt-2">
                                @foreach ($sub->images as $img)
                                    <img src="{{ asset('storage/' . $img->image_url) }}" class="w-24 h-24 object-cover rounded" />
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <p>Tidak ada kegiatan yang ditemukan.</p>
    @endforelse
</div>