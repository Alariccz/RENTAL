<x-front-layout>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]">
      <div class="container">
        <!-- Breadcrumb -->
        <ul class="flex items-center gap-5 mb-[50px]">
          <li
              class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
            <a href="{{ route('front.index') }}">Home</a>
          </li>
          <li
              class="text-secondary font-normal text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
            <a href="#!">
              {{ $item->brand->name?? 'Unknown Brand' }}
            </a>
          </li>
          <li
              class="text-dark font-semibold text-base capitalize after:content-['/'] last:after:content-none inline-flex gap-5">
            Details
          </li>
        </ul>

        <div class="grid grid-cols-12 gap-[30px]">
          <!-- Car Preview -->
          <div class="col-span-12 lg:col-span-8">
            <div class="bg-white p-4 rounded-[30px] flex flex-col gap-4" id="gallery">
              <img :src="thumbnails[activeThumbnail].url" :key="thumbnails[activeThumbnail].id"
                   class="md:h-[490px] rounded-[18px] h-auto w-full" alt="">
              <div class="grid items-center grid-cols-4 gap-3 md:gap-5">
                <div v-for="(thumbnail, index) in thumbnails" :key="thumbnail.id">
                  <a href="#!" @click="changeActive(index)">
                    <img :src="thumbnail.url" alt="" class="thumbnail"
                         :class="{ selected: index == activeThumbnail }">
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Details -->
          <div class="col-span-12 md:col-start-5 lg:col-start-auto md:col-span-8 lg:col-span-4">
            <div class="bg-white p-5 pb-[30px] rounded-3xl h-full">
              <div class="flex flex-col h-full divide-y divide-grey">
                <!-- Name, Category, Rating -->
                <div class="max-w-[230px] pb-5">
                  <h1 class="font-bold text-[28px] leading-[42px] text-dark mb-[6px]">
                    {{ $item->brand->name?? 'Unknown Brand' }} {{ $item->name }}
                  </h1>
                  <p class="text-secondary font-normal text-base mb-[10px]">
                    {{ $item->type->name }}
                  </p>
                  <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1">
                      @for ($i = 0; $i < floor($item->star); $i++)
                        <img src="/svgs/ic-star.svg" class="h-[22px] w-[22px]" alt="">
                      @endfor
                      @for ($i = 0; $i < (5 - ceil($item->star)); $i++)
                        <!-- Menampilkan bintang kosong -->
                        <img src="/svgs/ic-star-empty.svg" class="h-[22px] w-[22px]" alt="">
                      @endfor
                    </span>
                  </div>

                </div>
                <!-- Features -->
                <ul class="flex flex-col gap-4 flex-start pt-5 pb-[25px]">
                  @php
                    $features = explode(',', $item->features);
                  @endphp
                  @foreach ($features as $feature)
                    <li class="flex items-center gap-3 text-base font-semibold text-dark">
                      <img src="/svgs/ic-checkDark.svg" alt="">
                      {{ $feature }}
                    </li>
                  @endforeach
                </ul>
                <!-- Price, CTA Button -->
                <div class="flex items-center justify-between gap-4 pt-5 mt-auto">
                  <div>
                    <p class="font-bold text-dark text-[22px]">
                      Rp {{ number_format($item->price) }}
                    </p>
                    <p class="text-base font-normal text-secondary">
                      /day
                    </p>
                  </div>
                  <div class="w-full max-w-[70%]">
                    <!-- Button Primary -->
                    <div class="p-1 rounded-full bg-primary group">
                      <a href="{{ route('front.checkout', $item->slug)}}" class="btn-primary">
                        <p>
                          Rent Now
                        </p>
                        <img src="/svgs/ic-arrow-right.svg" alt="">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="container relative py-[100px]">
      <header class="text-center mb-[50px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">
          Frequently Asked Questions
        </h2>
        <p class="text-base text-secondary">Learn more about Vrom and get a success</p>
      </header>

      <!-- Questions -->
      <div class="grid md:grid-cols-2 gap-x-[50px] gap-y-6 max-w-[910px] w-full mx-auto">
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq1">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
                Bagaimana cara melakukan pemesanan mobil?            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq1-content">
            <p class="text-base text-dark leading-[26px]">
                Anda dapat memesan mobil secara mudah melalui website kami, memilih jenis mobil, tanggal penyewaan, dan lokasi pengambilan. Anda juga bisa menghubungi customer service untuk melakukan pemesanan secara langsung.
            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq2">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
                Apakah ada batasan usia untuk menyewa mobil?</p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq2-content">
            <p class="text-base text-dark leading-[26px]">
                Untuk menyewa mobil di tempat kami, Anda harus berusia minimal 21 tahun dan maksimal 70 tahun. Pengemudi yang berusia antara 21 hingga 25 tahun mungkin dikenakan biaya tambahan untuk asuransi.            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq3">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
                Apakah saya perlu memiliki SIM internasional untuk menyewa mobil?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq3-content">
            <p class="text-base text-dark leading-[26px]">
               Jika Anda adalah warga negara asing, Anda perlu memiliki SIM internasional yang sah. Jika Anda adalah warga negara Indonesia, cukup menggunakan SIM A yang masih berlaku.
            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq4">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
                Apakah saya bisa menyewa mobil untuk perjalanan antar kota?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq4-content">
            <p class="text-base text-dark leading-[26px]">
                Ya, Anda bisa membawa mobil untuk perjalanan antar kota. Namun, pastikan untuk memberitahukan kami sebelumnya agar kami dapat menyesuaikan persyaratan dan asuransi kendaraan.            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq5">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
                Bagaimana cara membayar sewa mobil?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq5-content">
            <p class="text-base text-dark leading-[26px]">
                Pembayaran dapat dilakukan melalui kartu kredit, transfer bank. Kami menerima berbagai metode pembayaran yang aman dan nyaman.            </p>
          </div>
        </a>
        <a href="#!" class="px-6 py-4 border rounded-[24px] border-grey h-min accordion max-w-[430px]"
           id="faq6">
          <div class="flex items-center justify-between gap-1">
            <p class="text-base font-semibold text-dark">
              Apakah Anda menawarkan layanan antar jemput?
            </p>
            <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
          </div>
          <div class="hidden pt-4 max-w-[335px]" id="faq6-content">
            <p class="text-base text-dark leading-[26px]">
                Ya, kami menawarkan layanan antar jemput ke lokasi yang Anda tentukan dengan biaya tambahan. Layanan ini dapat disesuaikan dengan kebutuhan Anda.
            </p>
          </div>
        </a>
      </div>
    </section>

    <!-- Similar Cars -->
    <section class="bg-darkGrey">
      <div class="container relative py-[100px]">
        <header class="mb-[30px]">
          <h2 class="font-bold text-dark text-[26px] mb-1">
            Similar Cars
          </h2>
          <p class="text-base text-secondary">Start your big day</p>
        </header>

        <!-- Cars -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]">
          @foreach ($similiarItems as $similiarItem)
            <!-- Card -->
            <div class="card-popular">
              <div>
                <h5 class="text-lg text-dark font-bold mb-[2px]">
                  {{ $similiarItem->name }}
                </h5>
                <p class="text-sm font-normal text-secondary">
                  {{ $similiarItem->type ? $similiarItem->type->name : '-' }}
                </p>
                <a href="{{ route('front.detail', $similiarItem->slug) }}" class="absolute inset-0"></a>
              </div>
              <img src="{{ $similiarItem->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px]"
                   alt="">
              <div class="flex items-center justify-between gap-1">
                <!-- Price -->
                <p class="text-sm font-normal text-secondary">
                  <span class="text-base font-bold text-primary">${{ $similiarItem->price }}</span>/day
                </p>
                <!-- Rating -->
                <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                  ({{ $similiarItem->star }}/5)
                  <img src="/svgs/ic-star.svg" alt="">
                </p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.36/dist/vue.global.prod.js"></script>
    <script>
      const {
        createApp
      } = Vue
      createApp({
        data() {
          return {
            activeThumbnail: 0,
            thumbnails: [
              @foreach (json_decode($item->photos) as $key => $photo)
                {
                  id: {{ $key }},
                  url: "{{ Storage::url($photo) }}"
                },
              @endforeach
            ],
          }
        },
        methods: {
          changeActive(id) {
            this.activeThumbnail = id;
          }
        }
      }).mount('#gallery')
    </script>
  </x-front-layout>
