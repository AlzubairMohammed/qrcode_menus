<!-- ADD Category -->
<div class="modal fade" id="modal-items-category" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-notification">{{ __('Add new category') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('categories.store') }}">
                            @csrf
                            <input type="hidden" value="{{$restorant_id}}"  name="restaurant_id" />

                            @if(config('settings.enable_miltilanguage_menus'))
                                @php
                                    $languages = explode(",", config('settings.front_languages'));
                                @endphp
                                <div class="nav-wrapper">
                                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text-cat" role="tablist">
                                        @foreach($languages as $key => $language)
                                            @if($key % 2 == 0)
                                                <li class="nav-item">
                                                    <a class="nav-link mb-sm-3 mb-md-0 {{ $key == 0 ? 'active' : '' }}" id="tabs-icons-text-{{ $language }}-cat-tab" data-toggle="tab" href="#tabs-icons-text-cat-{{ $language }}" role="tab" aria-controls="tabs-icons-text-cat-{{ $language }}" aria-selected="true">{{ $languages[$key+1] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="tab-content" id="myTabContentCat">
                                            @foreach($languages as $key => $language)
                                                @if($key % 2 == 0)
                                                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabs-icons-text-cat-{{ $language }}" role="tabpanel" aria-labelledby="tabs-icons-text-cat-{{ $language }}-tab">
                                                        <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                                                            <input class="form-control" name="category_name[{{ $language }}]" id="category_name_{{ $language }}" placeholder="{{ __('Category name') }} ({{ $languages[$key+1] }}) ..." type="text" required>
                                                            @if ($errors->has('category_name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('category_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                                    <input class="form-control" name="category_name" id="category_name" placeholder="{{ __('Category name') }} ..." type="text" required>
                                    @if ($errors->has('category_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EDIT Category -->
<div class="modal fade" id="modal-edit-category" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-notification">{{ __('Edit category') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" id="form-edit-category" method="post" action="">
                            @csrf
                            @method('put')
                            <input name="cat_id" id="cat_id" type="hidden" required>
                            
                            @if(config('settings.enable_miltilanguage_menus'))
                                @php
                                    $languages = explode(",", config('settings.front_languages'));
                                @endphp
                                <div class="nav-wrapper">
                                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text-edit-cat" role="tablist">
                                        @foreach($languages as $key => $language)
                                            @if($key % 2 == 0)
                                                <li class="nav-item">
                                                    <a class="nav-link mb-sm-3 mb-md-0 {{ $key == 0 ? 'active' : '' }}" id="tabs-icons-text-edit-cat-{{ $language }}-tab" data-toggle="tab" href="#tabs-icons-text-edit-cat-{{ $language }}" role="tab" aria-controls="tabs-icons-text-edit-cat-{{ $language }}" aria-selected="true">{{ $languages[$key+1] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="tab-content" id="myTabContentEditCat">
                                            @foreach($languages as $key => $language)
                                                @if($key % 2 == 0)
                                                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabs-icons-text-edit-cat-{{ $language }}" role="tabpanel" aria-labelledby="tabs-icons-text-edit-cat-{{ $language }}-tab">
                                                        <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                                                            <input class="form-control category_name_edit" name="category_name[{{ $language }}]" id="cat_name_{{ $language }}" placeholder="{{ __('Category name') }} ({{ $languages[$key+1] }}) ..." type="text" required>
                                                            @if ($errors->has('category_name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('category_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
                                    <input class="form-control" name="category_name" id="cat_name" placeholder="{{ __('Category name') }} ..." type="text" required>
                                    @if ($errors->has('category_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- NEW Language -->
<div class="modal fade" id="modal-new-language" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-notification">{{ __('Add new language') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('admin.restaurant.storenewlanguage') }}">
                            @csrf
                            <input type="hidden" value="{{$restorant_id}}"  name="restaurant_id" />
                            @include('partials.select', ['class'=>"col-12", 'classselect'=>"noselecttwo",'name'=>"Language",'id'=>"locale",'placeholder'=>__("Select Language"),'data'=>config('config.env')[2]['fields'][0]['data'],'required'=>true])
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Add new language') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-new-item" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-new-item">{{ __('Add new item') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
                            @csrf
                            @php
                                $languages = explode(",", config('settings.front_languages'));
                            @endphp
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    @foreach($languages as $key => $language)
                                        @if($key % 2 == 0)
                                            <li class="nav-item">
                                                <a class="nav-link mb-sm-3 mb-md-0 {{ $key == 0 ? 'active' : '' }}" id="tabs-icons-text-{{ $language }}-tab" data-toggle="tab" href="#tabs-icons-text-{{ $language }}" role="tab" aria-controls="tabs-icons-text-{{ $language }}" aria-selected="true">{{ $languages[$key+1] }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        @foreach($languages as $key => $language)
                                            @if($key % 2 == 0)
                                                <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="tabs-icons-text-{{ $language }}" role="tabpanel" aria-labelledby="tabs-icons-text-{{ $language }}-tab">
                                                    <div class="form-group{{ $errors->has('item_name') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="item_name">{{ __('Item Name') }} ({{ $languages[$key+1] }})</label>
                                                        <input class="form-control" name="item_name[{{ $language }}]" id="item_name_{{ $language }}" placeholder="{{ __('Item name') }} ..." type="text" required>
                                                        @if ($errors->has('item_name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('item_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group{{ $errors->has('item_description') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="item_description">{{ __('Item Description') }} ({{ $languages[$key+1] }})</label>
                                                        <textarea class="form-control" id="item_description_{{ $language }}" name="item_description[{{ $language }}]" rows="3" placeholder="{{ __('Item description') }} ..." required></textarea>
                                                        @if ($errors->has('item_description'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('item_description') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('item_price') ? ' has-danger' : '' }}">
                                <input class="form-control" name="item_price" id="item_price" placeholder="{{ __('Item Price') }} ..." type="number" step="any" required>
                                @if ($errors->has('item_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('item_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group text-center{{ $errors->has('item_image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="item_image">{{ __('Item Image') }}</label>
                                <div class="text-center">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            <img src="{{ asset('images') }}/default/add_new_item_box.jpeg" width="200px" height="150px" alt="..."/>
                                        </div>
                                    <div>
                                    <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">{{ __('Select image') }}</span>
                                    <span class="fileinput-exists">{{ __('Change') }}</span>
                                        <input type="file" name="item_image" accept="image/x-png,image/png,image/gif,image/jpeg">
                                    </span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('Remove') }}</a>
                                </div>
                                </div>
                                </div>
                            </div>
                            <input name="category_id" id="category_id" type="hidden" required>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-import-items" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title-new-item">{{ __('Import items from CSV') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="col-md-10 offset-md-1">
                        <form role="form" method="post" action="{{ route('import.items') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-center{{ $errors->has('item_image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="items_excel">{{ __('Import your file') }}</label>
                                <div class="text-center">
                                    <input type="file" class="form-control form-control-file" name="items_excel" accept=".csv, .ods, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                </div>
                            </div>
                            <input name="res_id" id="res_id" type="hidden" value="{{ $restorant_id }}" required>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
