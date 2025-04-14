<x-front-layout>
  <section class="container my-12">
    <h1 class="text-3xl font-bold mb-4">Transaksi Saya</h1>

    @forelse ($bookings as $booking)
      <div class="border rounded-lg p-6 shadow-md mb-6 bg-white">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
        <div>
          <h2 class="text-xl font-semibold">{{ optional($booking->item)->name }}</h2>
          <p class="text-sm text-gray-500">Tipe: {{ $booking->item->type->name ?? '-' }}</p>
          <p class="text-sm text-gray-500">Merek: {{ optional(optional($booking->item)->brand)->name }}</p>
          <p class="text-sm text-gray-500">
          Tanggal Sewa: {{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('d M Y') }}
          - {{ \Carbon\Carbon::parse($booking->end_date)->translatedFormat('d M Y') }}
          </p>
          <p class="mt-4 text-gray-700">Status:
          <span class="px-2 py-1 rounded-full text-white 
        @if($booking->status == 'pending') bg-yellow-500 
      @elseif($booking->status == 'confirmed') bg-green-600 
  @else bg-red-500 @endif">
            {{ ucfirst($booking->status) }}
          </span>
          </p>

        </div>
        <div class="mt-4 lg:mt-0 flex flex-col items-start gap-2">
          <img src="{{ optional($booking->item)->image }}" alt="{{ optional($booking->item)->name }}"
          class="w-32 h-20 object-cover rounded">
          <a href="https://wa.me/62895377200378?text=Halo%20Admin%20Ridenic%2C%20saya%20ingin%20bertanya%20mengenai%20transaksi%20saya%20di%20website.%20Mohon%20bantuannya%20ya%21"
          target="_blank" class="btn-primary text-sm mt-2">
          Hubungi Admin Ridenic
          </a>
        </div>
        </div>
      </div>
  @empty
  <p>Belum ada transaksi.</p>
@endforelse
  </section>
</x-front-layout>