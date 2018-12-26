@extends('layouts.admin')
@section('styles')
    <link href="{{asset('css/formLayout.css')}}" rel="stylesheet" />
@stop
@section('pageheader')
<header class="pageHeader">
        <div class="pageTitle">{{ __('Create Product') }}</div>
</header>
@endsection
@section('content')

<pre><?php  //print_r($franchises->toArray()); 
?></pre>

            <div class="card">
                @if(count($franchises) > 0)
                <div class="card-body">
                    <form method="POST" class="form-group" action="{{ url('create-product') }}" aria-label="{{ __('create-product') }}">
                        @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">
                                <select id="elc_id" autocomplete="off" name="elc_id" required>
                                <option value="">--Select Franchise--</option>
                                @foreach($franchises as $franchise)
                                <option value="{{$franchise->id}}">{{$franchise->name}}</option>
                                @endforeach
                                </select>
                            <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                            </div>
                            @if ($errors->has('elc_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('elc_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <?php $products=['5721' => 'P1', '5722' => 'P2', '5723' => 'P3',
                                '5724' => 'P4','5725' => 'P5'] ?> 
                        <div class="col-xs-12 col-sm-6">
                            <div class="formControl">
                               <select id="pid" autocomplete="off" name="pid" required>
                                <option value="">--Select Product--</option>
                                @foreach($products as $key => $product)
                                <option value="{{$key.'_'.$product}}">{{$product}}</option>
                                @endforeach
                                </select>
                            <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            @if ($errors->has('pid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pid') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    </div>
                    <div class="row">
                         <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input id="min_fee_allowed" type="text" class="{{ $errors->has('min_fee_allowed') ? ' is-invalid' : '' }}" name="min_fee_allowed" value="{{ old('min_fee_allowed') }}" placeholder="Minimum Fees Allowed" required autofocus>
                                    @if ($errors->has('min_fee_allowed'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('min_fee_allowed') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input id="max_fee_allowed" type="text" class="{{ $errors->has('max_fee_allowed') ? ' is-invalid' : '' }}" name="max_fee_allowed" value="{{ old('max_fee_allowed') }}" placeholder="Max Fees Allowed" required autofocus>

                                    @if ($errors->has('max_fee_allowed'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('max_fee_allowed') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input id="elc_share" type="text" class="{{ $errors->has('elc_share') ? ' is-invalid' : '' }}" name="elc_share" value="{{ old('elc_share') }}" placeholder="Elc Share" required autofocus>
                                    @if ($errors->has('elc_share'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('elc_share') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input id="min_fee_books_services" type="text" class="{{ $errors->has('min_fee_books_services') ? ' is-invalid' : '' }}" name="min_fee_books_services" value="{{ old('min_fee_books_services') }}" placeholder="Min Fees Book Services" required autofocus>
                                    @if ($errors->has('min_fee_books_services'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('min_fee_books_services') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                        <button type="submit" name="submit" class="btn btn-primary">
                        {{ __('Create') }}
                        </button>
                        </div>
                    </div>
                    </form>
                </div>
                @else
                <div class="card-body">No Franchise Available</div>
                @endif
            </div>
@endsection

@section('scripts')

@stop
