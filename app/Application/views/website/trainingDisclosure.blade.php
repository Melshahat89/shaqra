@extends(layoutExtend('website'))
 
@section('title')
    {{ trans('home.training-disclosure') }}
@endsection
 
@section('content')


@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('home.training-disclosure')])




<section>
    <div class="bg_gradient joininstructor-bg" style="background-image: url(/website/images/tw.webp)">
        <div class=" parallax-section">
            <div class="parallax-image" data-parallax="parallax" data-parallax-bg-image="/website/images/tw.webp" data-parallax-speed="0.6" data-parallax-direction="up"></div>
            <div class="parallax-content parallax-xpad">
                <div class="wrapper" style="padding-top: 80px;">
                    <div class="col-md-8 float-left">
                        <div class="card joininstructor-card ">
                            <div class="card-body ">
                                <p class="card-text joininstructor-card-text">{{ trans('website.Medical training and rehabilitation') }}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<hr style="width: 50%;">





<section class="wrapper pt-4">

    <div class="row">
        <div class="col-md-12">
            <div class="pt-4 pb-4">
                <h2 class="text-center" style="color: #244092">{{ trans('home.IGTS Innovations') }}</h2>
                <p>{{trans('home.At IGTS, we offer a comprehensive suite')}}</p>
            </div>
        </div>
    <div class="col-md-12">
        <div class="section_about mtxlg ">
            <div>
                <section class="title mxlg">
                    <h2 class="text_primary text_capitalize">{{ trans('home.Continuous support and effective partnership') }}</h2>
                </section>
                <p>{{ trans('home.We understand that compliance') }}</p>
            </div>
            <div>
                <section class="title mxlg">
                    <h2 class="text_primary text_capitalize">{{ trans('home.Interactive reports and accurate assessments') }}</h2>
                </section>
                <p>{{ trans('home.We provide comprehensive, regularly') }}</p>
            </div>
        </div>
        <div class="section_about mtxlg ">
            <div>
                <section class="title mxlg">
                    <h2 class="text_primary text_capitalize">{{ trans('home.Training supported by the latest technologies') }}</h2>
                </section>
                <p>{{ trans('home.We revolutionize the learning experience') }}</p>
            </div>

        </div>

    </div>




        <hr style="width: 50%;">

            <div class="col-md-12">
                <div class="pt-4 pb-4">
                    <h2 class="text-center" style="color: #244092">{{ trans('home.Services') }}</h2>
                    <p>{{trans('home.At IGTS, we offer integrated solutions')}}</p>
                </div>
            </div>


        <div class="col-md-6">
            <ul class="list-group list-group-flush pb-4 {{ getDir() == 'ltr' ?  'text-right' : 'text-left' }}">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h3>{{trans('home.Training Needs Analysis (TNA)')}}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a>

                        <i class="fas fa-certificate"></i>
                        <p>{{trans('home.We help you accurately identify your employees')}} </p>

                    </li>
                    <li class="list-group-item">

                        <h3>{{ trans('home.Develop training policies') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a>
                        <i class="fas fa-trophy"></i>
                        <p>{{ trans('home.We formulate training policies that align with') }}</p>
                    </li>
                    <li class="list-group-item">

                        <h3>{{ trans('home.Managing training budgets') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a>
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>{{ trans('home.We provide specialized tools for preparing') }}</p>
                    </li>
                    <li class="list-group-item">

                        <h3>{{ trans('home.Designing Individual Development Plans (IDPs)') }}</h3>
                        <a class="text-white btn-floating btn-fb btn-sm"></a>
                        <i class="fas fa-spinner"></i>
                        <p>{{ trans('home.Convert array to traditional syntax') }}</p>
                    </li>

                </ul>
            </ul>
        </div>

        <div class="col-md-6 pb-4">
            <ul class="list-group list-group-flush {{ getDir() == 'ltr' ? 'text-left' : 'text-right' }}">
                <ul class="list-group">
                    <li class="list-group-item">
                        <i class="fas fa-laptop"></i>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('home.Integrated training programs') }}</h3>
                        <p>{{ trans('home.We offer training programs covering various fields') }}</p>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-align-justify"></i>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('home.Documentation and performance reporting') }}</h3>
                        <p>{{ trans('home.We prepare accurate reports documenting employee') }}</p>
                    </li>
                    <li class="list-group-item">
                        <i class="far fa-life-ring"></i>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('home.Integrated Training Management System') }}</h3>
                        <p>{{ trans('home.We offer a comprehensive system for managing and documenting') }}</p>
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-chalkboard"></i>
                        <a class="text-white btn-floating btn-fb btn-sm"></a> <h3>{{ trans('home.Continuous support and assistance') }}</h3>
                        <p>{{ trans('home.Our team is always available to provide') }}</p>
                    </li>

                </ul>
            </ul>
        </div>
    </div>
</section>

<hr style="width: 50%;">




<div class="container p-4">
 
   
<section class="about-content">

    <div class="col-md-12">
        <div class="pt-4 pb-4">
            <h2 class="text-center" style="color: #244092">{{ trans('home.Frequently Asked Questions About the Training Data Disclosure Decision') }}</h2>
            <p>{{trans('home.At IGTS, we offer integrated solutions')}}</p>
        </div>
    </div>
        <div class="accordion course-accordion" id="accordionExample">

            <div class="card">
                <div class="card-header" id="headingOne_1">
                    <h2 class="mb-0">
                        <a type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse_1">
                            <i class="fa fa-plus mr-10 ml-10"></i>
                            <span>{{trans('home.Q1')}}</span>
                        </a>
                    </h2>
                </div>
                <div id="collapse_1" class="collapse" aria-labelledby="headingOne_1" data-parent="#accordionExample">

                        <div class="course-line watched">
                            <div class="flexLeft">
                                {{trans('home.A1')}}
                            </div>
                        </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingOne_2">
                    <h2 class="mb-0">
                        <a type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse_2">
                            <i class="fa fa-plus mr-10 ml-10"></i>
                            <span>{{trans('home.Q2')}}</span>
                        </a>
                    </h2>
                </div>
                <div id="collapse_2" class="collapse" aria-labelledby="headingOne_2" data-parent="#accordionExample">

                        <div class="course-line watched">
                            <div class="flexLeft">
                                {{trans('home.A2')}}
                            </div>
                        </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingOne_3">
                    <h2 class="mb-0">
                        <a type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse_3">
                            <i class="fa fa-plus mr-10 ml-10"></i>
                            <span>{{trans('home.Q3')}}</span>
                        </a>
                    </h2>
                </div>
                <div id="collapse_3" class="collapse" aria-labelledby="headingOne_3" data-parent="#accordionExample">

                        <div class="course-line watched">
                            <div class="flexLeft">
                                {{trans('home.A3')}}
                            </div>
                        </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingOne_4">
                    <h2 class="mb-0">
                        <a type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse_4">
                            <i class="fa fa-plus mr-10 ml-10"></i>
                            <span>{{trans('home.Q4')}}</span>
                        </a>
                    </h2>
                </div>
                <div id="collapse_4" class="collapse" aria-labelledby="headingOne_4" data-parent="#accordionExample">

                        <div class="course-line watched">
                            <div class="flexLeft">
                                {{trans('home.A4')}}
                            </div>
                        </div>
                </div>
            </div>

        </div>

    
</section>
 
</div>
 
 
 
 
 
@endsection
 