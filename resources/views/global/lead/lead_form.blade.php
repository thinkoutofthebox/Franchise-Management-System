<div class="card">
    <div id="BasicDetails">
        <div class="card-body">
            <form method="POST" class="form-group" onsubmit="return registerStudent()">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
                                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
                                    <span id="error-name" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-user"></i></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                                <div class="formControl">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                    <span id="error-email" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                                </span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label> -->
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <input id="phone" type="text" name="phone" value="{{$phone}}" required readonly />
                                    <span id="error-phone" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <!-- <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label> -->
                                    <input id="address" type="text" value="{{ old('address') }}" placeholder="Address" required autofocus>
                                    <span id="error-address" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <!-- <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label> -->
                                    <input id="postal_code" type="text" name="postal_code" value="{{ old('postal_code') }}" placeholder="Postal Code" required autofocus>
                                    <span id="error-postal_code" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-map-pin" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->
                                    <input id="father_name" type="text" name="father_name" value="{{ old('father_name') }}" placeholder="Father Name" required autofocus>
                                    <span id="error-father_name" class="invalid-feedback" role="alert"></span>
                                    <div class="input-icon"><i class="fa fa-user"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="formControl">
                                    <select id="pid" autocomplete="off" name="pid" required>
                                        <option value="">--Select Course--</option>
                                        @foreach($products as $product)
                                        <option data-min_fee_allowed="{{$product->min_fee_allowed}}" data-max_fee_allowed="{{$product->max_fee_allowed}}" data-min_fee_books_services="{{$product->min_fee_books_services}}" value="{{$product->pid}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="image" id="image">
                    <div class="col-xs-12 col-sm-6 uploadPhoto">
                        <div class="defaultImg">
                            <img id="snap">
                            <i class="fa fa-user"></i>
                                        <a href="javascript:void(0);" id="start-camera" class="visible" onclick="StartCamera()">Capture Student Photo</a>
                            <video id="camera-stream" class="cameraView" style="display:none;"></video>
                            <canvas></canvas>
                            <div class="controls" id="controlsWrap" style="display:none;">
                                <a href="#" id="delete-photo" title="Delete Photo" class="disabled"><i class="fa fa-trash"></i></a>
                                <a href="#" id="take-photo" title="Take Photo"><i class="fa fa-camera"></i></a>
                                <a href="#" id="download-photo" download="selfie.png" title="Save Photo" class="disabled"><i class="fa fa-save"></i></a>
                            </div>
                        </div>
                        <p id="error-message" class="errorMsg"></p>
                    </div>


                      <div class="col-xs-12 col-sm-12">
                            <label class="radio-inline"><input type="radio" name="category" checked value="gen"> Gen </label>
                            <label class="radio-inline"><input type="radio" name="category" value="sc"> SC </label>
                            <label class="radio-inline"><input type="radio" name="category" value="st"> ST </label>
                            <label class="radio-inline"><input type="radio" name="category" value="obc"> OBC </label>
                        </div>                       
                        <div class="col-xs-12 col-sm-12">
                            <input type="checkbox" class="regchk checkbox" id="is_muslim" name="is_muslim" value="1"> IsMuslim
                        </div>
                    <div class="col-xs-12 col-sm-12">
                        <hr>
                        <div>
                            {{ __('Referred Phone Numbers') }}
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input type="text" name="referred_phone[]" placeholder="Phone 1">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input type="text" name="referred_phone[]" placeholder="Phone 2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input type="text" name="referred_phone[]" placeholder="Phone 3">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input type="text" name="referred_phone[]" placeholder="Phone 4">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input type="text" name="referred_phone[]" placeholder="Phone 5">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="formControl noIcon">
                                    <input type="text" name="referred_phone[]" placeholder="Phone 6">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <button type="submit" id="enrol" name="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>