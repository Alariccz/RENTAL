<x-front-layout>
    <!-- Main Content -->
    <section class="bg-darkGrey relative py-[70px]">
      <div class="container">
        <header class="mb-[30px]">
          <h2 class="font-bold text-dark text-[26px] mb-1">
            Checkout & Drive Faster
          </h2>
          <p class="text-base text-secondary">We will help you get ready today</p>
        </header>

        <div class="flex items-center gap-5 lg:justify-between">
          <!-- Form Card -->
          <form action="{{ route('front.payment.update', $booking->id) }}" method="POST"
            class="bg-white p-[30px] pb-10 rounded-3xl max-w-[490px] w-full" id="checkoutForm">
            @csrf
            @method('post')
            <div class="flex flex-col gap-[30px]">
              <div class="flex flex-col gap-4">
                <h5 class="text-lg font-semibold">
                  Review Order
                </h5>
                <!-- Items -->
                <div class="flex items-center justify-between">
                  <p class="text-base font-normal">
                    Car choosen
                  </p>
                  <p class="text-base font-semibold">
                    {{ $booking->item->brand->name }} {{ $booking->item->name }}
                  </p>
                </div>
                <!-- Items -->
                <div class="flex items-center justify-between">
                  <p class="text-base font-normal">
                    Total day
                  </p>
                  <p class="text-base font-semibold">
                    {{ $booking->start_date->diffInDays($booking->end_date) }} days
                  </p>
                </div>
                <!-- Items -->
                <div class="flex items-center justify-between">
                  <p class="text-base font-normal">
                    Service
                  </p>
                  <p class="text-base font-semibold">
                    Delivery
                  </p>
                </div>
                <!-- Items -->
                <div class="flex items-center justify-between">
                  <p class="text-base font-normal">
                    Price
                  </p>
                  <p class="text-base font-semibold">
                    Rp{{ number_format($booking->item->price, 0, ',', '.') }} per day
                  </p>
                </div>
                <!-- Items -->
                <div class="flex items-center justify-between">
                  <p class="text-base font-normal">
                    VAT (10%)
                  </p>
                  <p class="text-base font-semibold">
                    Rp{{ number_format($booking->item->price * $booking->start_date->diffInDays($booking->end_date) * 0.10, 0, ',', '.') }}
                  </p>
                </div>
                <!-- Items -->
                <div class="flex items-center justify-between">
                  <p class="text-base font-normal">
                    Grand total
                  </p>
                  <p class="text-base font-semibold">
                    Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                  </p>
                  </p>
                </div>
              </div>
              <div class="flex flex-col gap-4">
                <h5 class="text-lg font-semibold">
                  Payment Method
                </h5>
                <div class="grid md:grid-cols-2 gap-4 md:gap-[30px] items-center">
                  <div class="relative boxPayment opacity-30">
                    <input type="radio" value="mastercard" name="payment_method" id="mastercard"
                      class="absolute inset-0 z-50 opacity-0 cursor-pointer" disabled>
                    <label for="mastercard"
                      class="flex items-center justify-center gap-4 border border-grey rounded-[20px] p-5 min-h-[80px]">
                      <img src="/svgs/logo-mastercard.svg" alt="">
                      <p class="text-base font-semibold">
                        MasterCard
                      </p>
                    </label>
                  </div>
                  <div class="relative boxPayment">
                    <input type="radio" value="midtrans" name="payment_method" id="midtrans"
                      class="absolute inset-0 z-50 opacity-0 cursor-pointer" checked>
                    <label for="midtrans"
                      class="flex items-center justify-center gap-4 border border-grey rounded-[20px] p-5 min-h-[80px]">
                      <img src="/svgs/logo-midtrans.svg" alt="">
                      <p class="text-base font-semibold">
                        Midtrans
                      </p>
                    </label>
                  </div>
                </div>
              </div>
              <!-- CTA Button -->
              <div class="col-span-2 mt-5">
                <!-- Button Primary -->
                <div class="p-1 rounded-full bg-primary group">
                  <a href="#" class="btn-primary" id="checkoutButton">
                    <p>
                      Continue
                    </p>
                    <img src="/svgs/ic-arrow-right.svg" alt="">
                  </a>
                </div>
              </div>
            </div>
          </form>
          <img src="/images/porsche_small.webp" class="max-w-[50%] hidden lg:block -mr-[100px]" alt="">
        </div>
      </div>
    </section>

    <!-- Tambahkan script Midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

    <script>
      // Ubah script untuk menggunakan AJAX
      $('#checkoutButton').click(function(e) {
        e.preventDefault(); // Mencegah form submit biasa

        // Ambil data form
        var formData = $('#checkoutForm').serialize();
        var actionUrl = $('#checkoutForm').attr('action');

        // Kirim request AJAX
        $.ajax({
          url: actionUrl,
          type: 'POST',
          data: formData,
          success: function(response) {
            // Gunakan snapToken untuk membuka Snap Midtrans
            if (response.snapToken) {
              window.snap.pay(response.snapToken, {
                onSuccess: function(result) {
                  window.location.href = "{{ route('front.payment.success') }}";
                },
                onPending: function(result) {
                  alert("Pembayaran tertunda, silakan selesaikan pembayaran Anda");
                  console.log('pending transaction', result);
                },
                onError: function(result) {
                  alert("Pembayaran gagal!");
                  console.log('error transaction', result);
                },
                onClose: function() {
                  alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
              });
            } else {
              alert("Terjadi kesalahan, token pembayaran tidak ditemukan");
            }
          },
          error: function(xhr, status, error) {
            alert("Terjadi kesalahan: " + error);
            console.error(xhr.responseText);
          }
        });
      });
    </script>
  </x-front-layout>