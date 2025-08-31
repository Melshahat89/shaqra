@php
    $rating = $filtering['rating'];
    $duration = $filtering['duration'];
@endphp
<div class="col-md-3">
    <div class="ptmd pbmd prmd plmd b_all" style="border: none; width: 300px;" id="{{(isMobile() || (count($items) < 2)) ? '' : 'test1'}}">


        <div class="filters p-0">
            <div class="filter-title  d-flex justify-content-between">
                <span class="add-to-cart align-self-center">
                    {{ trans('website.Filter') }}
                </span>
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="true" aria-controls="multiCollapseExample1"><i class="fas fa-bars"></i></a>
            </div>
            <div class="collapse multi-collapse {{(isMobile()) ? '' : 'show'}}" id="multiCollapseExample1">
                <form action="" method="GET">
                <div class="filter-title">
                        <h6 class="mb-10"> {{ trans('website.Sort By') }} </h6>
                        <div class="rating-filter">
                            <div class="form-check">
                                <select class="form-control input-item user-login-ico" id="sort" name="sort">
                                    <option value="">{{ trans('website.Release Date') }}</option>
                                    <option value="0" {{ isset($_GET['sort']) && $_GET['sort'] == 0 ? 'selected' : '' }}> {{ trans('website.New to old') }} </option>
                                    <option value="1" {{ isset($_GET['sort']) && $_GET['sort'] == 1 ? 'selected' : '' }}> {{ trans('website.Old to new') }} </option>
                                </select>
                            </div>
                            </label>
                        </div>
                    </div>
                    <div class="filter-title">
                        <h6 class="mb-10"> {{ trans('website.Speciality') }}</h6>
                        <div class="rating-filter">
                            <div class="form-check">
                                <select class="form-control input-item user-login-ico" id="categories" name="categories">
                                    <option value="">{{trans('account.Select specialization')}}</option>
                                    @foreach(allCategories() as $category)
                                        <option value="{{$category->slug}}" {{ ($slug == $category->slug) ? 'selected' : '' }}> {{$category->name_lang}} </option>
                                    @endforeach
                                </select>
                            </div>
                            </label>
                        </div>
                    </div>
                    <div class="filter-title">
                        <h6 class="mb-10"> {{ trans('website.Ratings') }}</h6>
                        <div class="rating-filter">
                            <div class="form-check">
                                <input class="form-check-input" <?= ($rating == 5) ? 'checked' : '' ?> type="radio" name="rating" id="gridRadios1" value="5">
                                <label class="form-check-label" for="gridRadios1">
                                    <div class="card-rating {{ (getDir() == 'rtl') ? 'mr-4' : 'ml-4' }}">
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <span>5.0</span>
                                    </div>

                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" <?= ($rating == 4) ? 'checked' : '' ?> type="radio" name="rating" id="gridRadios2" value="4">
                                <label class="form-check-label" for="gridRadios2">
                                    <div class="card-rating {{ (getDir() == 'rtl') ? 'mr-4' : 'ml-4' }}">
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating "></i>
                                        <span>4.0</span>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" <?= ($rating == 3) ? 'checked' : '' ?> type="radio" name="rating" id="gridRadios3" value="3">
                                <label class="form-check-label" for="gridRadios3">
                                    <div class="card-rating {{ (getDir() == 'rtl') ? 'mr-4' : 'ml-4' }}">
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating "></i>
                                        <i class="star-rating "></i>
                                        <span>3.0</span>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" <?= ($rating == 2) ? 'checked' : '' ?> type="radio" name="rating" id="gridRadios4" value="2">
                                <label class="form-check-label" for="gridRadios4">
                                    <div class="card-rating {{ (getDir() == 'rtl') ? 'mr-4' : 'ml-4' }}">
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating checked"></i>
                                        <i class="star-rating "></i>
                                        <i class="star-rating "></i>
                                        <i class="star-rating "></i>
                                        <span>2.0</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    @if(!$talks && !$events)
                    <div class="filter-title">
                        <h6 class="mb-10"> {{ trans('website.Duration') }}</h6>
                        <div class="rating-filter">
                            <div class="form-check">
                                <input class="form-check-input" <?= ($duration == "0:2") ? 'checked' : '' ?> type="radio" name="duration" id="checkoption1" value="0:2">
                                <label class="form-check-label {{ (getDir() == 'rtl') ? 'mr-4' : 'ml-4' }}" for="checkoption1">
                                    <span>0-2 {{ trans('website.hours') }}</span>
                            </div>
                            </label>
                        </div>
                        <div class="rating-filter">
                            <div class="form-check">
                                <input class="form-check-input" <?= ($duration == "3:6") ? 'checked' : '' ?> type="radio" name="duration" id="checkoption2" value="3:6">
                                <label class="form-check-label {{ (getDir() == 'rtl') ? 'mr-4' : 'ml-4' }}" for="checkoption2">
                                    <span>3-6 {{ trans('website.hours') }}</span>
                            </div>
                            </label>
                        </div>
                        <div class="rating-filter">
                            <div class="form-check">
                                <input class="form-check-input" <?= ($duration == "7:16") ? 'checked' : '' ?> type="radio" name="duration" id="checkoption3" value="7:16">
                                <label class="form-check-label {{ (getDir() == 'rtl') ? 'mr-4' : 'ml-4' }}" for="checkoption3">
                                    <span>7-16 {{ trans('website.hours') }}</span>
                            </div>
                            </label>
                        </div>
                        <div class="rating-filter">
                            <div class="form-check">
                                <input class="form-check-input" <?= ($duration == "17:100") ? 'checked' : '' ?> type="radio" name="duration" id="checkoption4" value="17:100">
                                <label class="form-check-label {{ (getDir() == 'rtl') ? 'mr-4' : 'ml-4' }}" for="checkoption4">
                                    <span>17+ {{ trans('website.hours') }}</span>
                            </div>
                            </label>
                        </div>
                    </div>
                    @endif
                    <div class="d-flex">
                        <div class="filter-title">
                            <button type="submit" class="add-to-cart">
                                {{ trans('website.Search') }}
                            </button>
                        </div>
                </form>
                <div class="filter-title">
                    <form class="reset_filter" action="" method="GET">
                        <button type="submit" class="add-to-cart">
                            {{ trans('website.Reset Filter') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>



</div>



</div>