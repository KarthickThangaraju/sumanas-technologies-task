@extends('layouts.app')
     
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-4">
            <div class="card" style="height:260px">
                <div class="card-header">
                    Product Details <a class="btn btn-success" href="{{  url('/product' ) }}" style="float:right">Back</a>
                </div>
                <div class="card-body">
                    <table>
                    @foreach($singleproduct as $product)
                        <tr>
                            <th>Product Name:</th>
                            <th>{{ $product->title }}</th>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <th>{{ $product->description }}</th>
                        </tr>
                        <tr>
                            <th>Price:</th>
                            <th>{{ $product->price }}</th>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
    </div>
        <div class="col-md-8">
            <div class="card" style="height:260px">
                <div class="card-header">
                    Payment Details
                </div>
   
                <div class="card-body">
   
                    <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                        @csrf
                        @foreach($singleproduct as $product)
                        <input type="hidden" name="product" id="plan" value="{{ $product->id }}">
                        @endforeach
   
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                                </div>
                            </div>
                        </div><br>
   
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Card details</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                            <hr>
                                <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Pay</button>
                            </div>
                        </div>
   
                    </form>
   
                </div>
            </div>
        </div>
    </div>
</div>
   
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}')
   
    const elements = stripe.elements()
    const cardElement = elements.create('card')
   
    cardElement.mount('#card-element')
   
    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')
   
    form.addEventListener('submit', async (e) => {
        e.preventDefault()
   
        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }   
                }
            }
        )
        if(error) {
            cardBtn.disable = false
        } else {
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
        }
    })
</script>
@endsection