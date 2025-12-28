<div class="pl-lg-4">
    <form id="restorant-form" method="post" action="{{ route('admin.restaurants.update', $restorant) }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
        <div class="col-md-6">
        <input type="hidden" id="rid" value="{{ $restorant->id }}"/>
        @if(config('settings.enable_miltilanguage_menus'))
            @php
                $languages = explode(",", config('settings.front_languages'));
            @endphp
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text-resto" role="tablist">
                    @foreach($languages as $key => $language)
                        @if($key % 2 == 0)
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 {{ $key == 0 ? 'active' : '' }}" id="tabs-icons-text-{{ $language }}-resto-tab" data-toggle="tab" href="#tabs-icons-text-resto-{{ $language }}" role="tab" aria-controls="tabs-icons-text-resto-{{ $language }}" aria-selected="true">{{ $languages[$key+1] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="myTabContentResto">
                        @foreach($languages as $key => $language)
                            @if($key % 2 == 0)
                                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabs-icons-text-resto-{{ $language }}" role="tabpanel" aria-labelledby="tabs-icons-text-resto-{{ $language }}-tab">
                                    @include('partials.fields',['fields'=>[
                                        ['ftype'=>'input','name'=>"Restaurant Name (".$languages[$key+1].")",'id'=>"name_".$language,'name_field'=>"name[".$language."]",'placeholder'=>"Restaurant Name",'required'=>true,'value'=>$restorant->getTranslation('name', $language)],
                                        ['ftype'=>'input','name'=>"Restaurant description (".$languages[$key+1].")",'id'=>"description_".$language, 'name_field'=>"description[".$language."]",'placeholder'=>"Restaurant description",'required'=>true,'value'=>$restorant->getTranslation('description', $language)],
                                        ['ftype'=>'input','name'=>"Restaurant address (".$languages[$key+1].")",'id'=>"address_".$language, 'name_field'=>"address[".$language."]",'placeholder'=>"Restaurant address",'required'=>true,'value'=>$restorant->getTranslation('address', $language)],
                                    ]])
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @include('partials.fields',['fields'=>[
                ['ftype'=>'input','name'=>"Restaurant phone",'id'=>"phone",'placeholder'=>"Restaurant phone",'required'=>true,'value'=>$restorant->phone],
            ]])
        @else
            @include('partials.fields',['fields'=>[
                ['ftype'=>'input','name'=>"Restaurant Name",'id'=>"name",'placeholder'=>"Restaurant Name",'required'=>true,'value'=>$restorant->name],
                ['ftype'=>'input','name'=>"Restaurant description",'id'=>"description",'placeholder'=>"Restaurant description",'required'=>true,'value'=>$restorant->description],
                ['ftype'=>'input','name'=>"Restaurant address",'id'=>"address",'placeholder'=>"Restaurant address",'required'=>true,'value'=>$restorant->address],
                ['ftype'=>'input','name'=>"Restaurant phone",'id'=>"phone",'placeholder'=>"Restaurant phone",'required'=>true,'value'=>$restorant->phone],
            ]])
        @endif
        @if(config('settings.multi_city'))
            @include('partials.fields',['fields'=>[
                ['ftype'=>'select','name'=>"Restaurant city",'id'=>"city_id",'data'=>$cities,'required'=>true,'value'=>$restorant->city_id],
            ]])
        @endif
       
        @if(auth()->user()->hasRole('admin'))
            <br/>
            <div class="row">
                <div class="col-6 form-group{{ $errors->has('fee') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-description">{{ __('Fee percent') }}</label>
                    <input type="number" name="fee" id="input-fee" step="any" min="0" max="100" class="form-control form-control-alternative{{ $errors->has('fee') ? ' is-invalid' : '' }}" value="{{ old('fee', $restorant->fee) }}" required autofocus>
                    @if ($errors->has('fee'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fee') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-6 form-group{{ $errors->has('static_fee') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-description">{{ __('Static fee') }}</label>
                    <input type="number" name="static_fee" id="input-fee" step="any" min="0" class="form-control form-control-alternative{{ $errors->has('static_fee') ? ' is-invalid' : '' }}" value="{{ old('static_fee', $restorant->static_fee) }}" required autofocus>
                    @if ($errors->has('static_fee'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('static_fee') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <br/>
            <div class="form-group">
                <label class="form-control-label" for="item_price">{{ __('Is Featured') }}</label>
                <label class="custom-toggle" style="float: right">
                    <input type="checkbox" name="is_featured" <?php if($restorant->is_featured == 1){echo "checked";}?>>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>
            </div>
            <br/>
        @endif
        <br/>
        @if (!config('app.issd',false))
            @include('restorants.partials.options')
        @endif
        
        <br/>
        <div class="row">
            <?php
                $images=[
                    ['name'=>'resto_wide_logo','label'=>__('Restaurant wide logo'),'value'=>$restorant->logowide,'style'=>'width: 200px; height: 62px;','help'=>"PNG 650x120 recomended"],
                    ['name'=>'resto_wide_logo_dark','label'=>__('Dark restaurant wide logo'),'value'=>$restorant->logowidedark,'style'=>'width: 200px; height: 62px;','help'=>"PNG 650x120 recomended"],
                    ['name'=>'resto_logo','label'=>__('Restaurant Image'),'value'=>$restorant->logom,'style'=>'width: 295px; height: 200px;','help'=>"JPEG 590 x 400 recomended"],
                    ['name'=>'resto_cover','label'=>__('Restaurant Cover Image'),'value'=>$restorant->coverm,'style'=>'width: 200px; height: 100px;','help'=>"JPEG 2000 x 1000 recomended"]
        ];
        if(config('app.issd')){
            unset($images[0]);
            unset($images[1]);
            unset($images[3]);
        }
            ?>
            @foreach ($images as $image)
                <div class="col-md-6">
                    @include('partials.images',$image)
                </div>
            @endforeach
            
        </div>

        


        

        

       
       

    
        
        </div>
        <div class="col-md-6">
            @if(!config('app.issd',false))
                @include('restorants.partials.ordering')
            @endif
            @include('restorants.partials.localisation')

            <!-- WHATS APP MODE -->
            @if (config('settings.is_whatsapp_ordering_mode'))
                @include('restorants.partials.social_info')  
            @endif

            @if (config('settings.whatsapp_ordering'))
                <!-- We have WP ordering -->
                @if (config('app.isft'))
                    <!-- FT -->
                    @if(auth()->user()->hasRole('admin'))
                        @include('restorants.partials.waphone')
                    @endif
                @else
                    <!-- QR -->
                    @include('restorants.partials.waphone')
                @endif
            @endif

        </div>

        </div>


        <div class="text-center">
            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
        </div>
        
    </form>
</div>
