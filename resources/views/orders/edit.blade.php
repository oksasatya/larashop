@extends('layouts.global')

@section('title') Edit Order @endsection

@section('content')

    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif


            <form action="{{ route('orders.update', [$order->id]) }}" class="shadow-sm bg-white p-3" method="POST">

                @csrf
                @method('PUT')

                <label for="invoice_number">Invoice number</label><br>
                <input type="text" class="form-control" value="{{ $order->invoice_number }}" disabled>
                <br>

                <label for="">Buyer</label>
                <input type="text" class="form-control" value="{{ $order->user->name }}">
                <br>

                <label for="created_at">Order date</label>
                <input type="text" class="form-control" value="{{ $order->created_at }}" disabled>
                <br>

                <label for="">Books {{ $order->totalQuantity }}</label><br>
                <ul>
                    @foreach ($order->books as $book)
                        <li>{{ $book->title }} <b>{{ $book->pivot->quantity }}</b></li>
                    @endforeach
                </ul>

                <label for="">Total Price</label><br>
                <input type="text" class="form-control" value="{{ $order->total_price }}" disabled>
                <br>

                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="SUBMIT" {{ $order->status == 'SUBMIT' ? 'selected' : '' }}>SUBMIT</option>
                    <option value="PROCESS" {{ $order->status == 'PROCESS' ? 'selected' : '' }}>PROCESS</option>
                    <option value="FINISH" {{ $order->status == 'FINISH' ? 'selected' : '' }}>FINISH</option>
                    <option value="CANCEL" {{ $order->status == 'CANCEL' ? 'selected' : '' }}>CANCEL</option>
                </select>
                <br>

                <input type="submit" class="btn btn-primary" value="Update">

            </form>
        </div>
    </div>

@endsection
