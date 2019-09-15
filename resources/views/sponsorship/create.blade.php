@extends('index')

@section('title')
  Promozioni appartamenti
@endsection

@section('content')

  @if (Auth::user()->id == $flatValue->user_id)

  <div class="container mt-5">
    <div class="row">
      <div class="col">
        @if (session('success_message'))
          <div class="alert alert-success">
            {{ session('success_message') }}
          </div>
        @endif

        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="post" id="payment-form" action="{{ url('/checkout') }}">
            @csrf
            <section>

              <div class="container mt-5 w-100">
                <div class="row">
                  <div class="col-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Promo 24 ore <i class="fas fa-plane ml-3"></i></h5>
                        <p class="card-text">Promuovi il tuo appartamento per 24 ore, verrà messo subito in evidenza!</p>
                        <button class="btn btn-success setPrice" type="button" name="24"><span id='prezzo'>2.99</span>€</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Promo 72 <i class="fas fa-fighter-jet ml-3"></i></h5>
                        <p class="card-text">Il tuo appartamento in evidenza per 72 ore, per gli host più esigenti!</p>
                        <button class="btn btn-success setPrice" type="button" name="72"><span id='prezzo'>5.99</span>€</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Promo 144 <i class="fas fa-space-shuttle ml-3"></i></h5>
                        <p class="card-text">Il tuo appartamento sempre al TOP per 144 ore! Si voooolaaaa!</p>

                        <button class="btn btn-success setPrice" type="button" name="144"><span id='prezzo'>9.99</span>€</button>
                      </div>
                    </div>
                  </div>
                  </div>
              </div>

              <div class="container mt-2">
                <div class="row">
                  <div class="col-12">
                    <label for="amount">
                        <div class="input-wrapper amount-wrapper">
                          <input id="flat_id" name="flat_id" type="hidden" value="{{ $_GET['flatId'] }}">
                          <input id="duration" name="duration" type="hidden" value="">
                          <input id="amount" name="amount" type="hidden" min="1" value="">
                        </div>
                    </label>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <div class="container mt-4">
              <div class="row">
                <div class="col">
                  <input id="nonce" name="payment_method_nonce" type="hidden" />
                  <button id="confPayment" class="btn btn-success" type="submit"><span>Conferma il pagamento</span></button>
                </div>
              </div>
            </div>

        </form>
      </div>
    </div>
  </div>

  @else
    <h1 class="text-danger">Non puoi accedere a questa pagina</h1>
  @endif

  <script src="https://js.braintreegateway.com/web/dropin/1.20.1/js/dropin.min.js"></script>
  <script>
      var form = document.querySelector('#payment-form');
      var client_token = "{{ $token }}";

      braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
      }, function (createErr, instance) {
        if (createErr) {
          console.log('Create Error', createErr);
          return;
        }
        form.addEventListener('submit', function (event) {
          event.preventDefault();

          instance.requestPaymentMethod(function (err, payload) {
            if (err) {
              console.log('Request Payment Method Error', err);
              return;
            }

            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
          });
        });
      });
  </script>
@endsection
