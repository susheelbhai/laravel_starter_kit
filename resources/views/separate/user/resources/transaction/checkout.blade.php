<x-layout.user.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> All Order | {{ config('app.name') }}</title>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @php
                $gst_percentage = 18;
            @endphp
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            Checkout
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive card-table transactions-table">
                                <tbody>
                                    <tr>
                                        <td> Price </td>
                                        <td> {{ $request['amount'] }}</td>
                                    </tr>
                                    <tr>
                                        <td> GST (18%) </td>
                                        <td> {{ $request['amount']*(0.01*$gst_percentage) }}</td>
                                    </tr>
                                    <tr>
                                        <td> Total </td>
                                        <td> {{ $request['amount']*(1+0.01*$gst_percentage) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="{{ route('pay') }}" method="post">
                                @csrf
                                <x-form.element.input1 name="action_url" type="hidden" value="{{ route('dashboard') }}" />
                                <x-form.element.input1 name="redirect_url" type="hidden" value="{{ route('transaction.index') }}" />
                                <x-form.element.input1 name="business_id" type="hidden" value="{{ Auth::guard('user')->user()->business_id }}" />
                                <x-form.element.input1 name="gateway" type="hidden" value="{{ config('payment.gateway_id') }}" />
                                <x-form.element.input1 name="name" type="hidden" value="{{ Auth::guard('user')->user()->name }}" />
                                <x-form.element.input1 name="email" type="hidden" value="{{ Auth::guard('user')->user()->email }}" />
                                <x-form.element.input1 name="phone" type="hidden" value="{{ Auth::guard('user')->user()->phone }}" />
                                <x-form.element.input1 name="amount" type="hidden" value="{{ $request['amount']*1.18 }}"/>
                                <x-form.element.input1 name="gst_percentage" type="hidden" value="{{ $gst_percentage }}"/>
                                <x-form.element.button1 name="button" type="submit" title="Pay Now" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</x-layout.user.app>
