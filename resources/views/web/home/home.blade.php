@extends('web.layouts.app')
@section('content')



<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    <div class="item active banner_bg" style="background-image:url({{ asset('assets/images/img/banner_background.jpg') }});">
            <div class="banner_img">
                <img class="img-responsive" src="{{ config('constants.baseUrl').config('constants.bannerPic').$banner->image }}" alt="img" />
            </div>
            <div class="banner_text">
                {!! $banner->description !!}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>


<div class="about_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="about_left_content">
                    <h2>{{ $whoWeAre->heading }}</h2>
                    <h3>{{ $whoWeAre->sub_heading }}</h3>
                    <p><?php echo substr($whoWeAre->description, 0, 180).'...'; ?></p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <span class="work_experience">{{ $whoWeAre->year }}</span>
                        <span class="experience_ofyear">YEARS OF<br /><strong>EXPERIENCE</strong></span>
                    </div>
                    <div class="col-sm-6">
                        <span class="cmn_btn">
                            <a class="btn_style" href="{{ route('fontend.about.show') }}">Read More</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 about_img">
                <div>
                    <img class="img-responsive" src="{{ config('constants.baseUrl').config('constants.aboutPic').$whoWeAre->image }}" alt="img" />
                </div>
            </div>
        </div>
    </div>
</div>



<div class="autographs_home">
    <div class="container">
        <div class="row">
            <h2><img src="{{ $smallLogo }}" />Autograph</h2>
            <h3>
              It is more than the signing of a person’s name: thet is a signature. An autograph is anything that is written ina
              persons’ own handwriting, also called holograph. Autograph includes entire letters, treaties, legal documents,
              musical scores, illuminated manuscripts, as well as the artist’s singnature on a painting and other works of art.
            </h3>
        </div>
        <div class="row">
            @foreach ($galleryAutograph as $item)
            <div class="col-sm-4 autograph_boximage">
                <a href="javascript:void(0);"
                data-toggle="modal"
                data-target="#myModal"
                data-image="{{ config('constants.baseUrl') . config('constants.galleryPic') . $item->image }}"
                data-signature="{{ config('constants.baseUrl') . config('constants.galleryPic') . $item->signature }}"
                data-name="{{ $item->name }}"
                data-born="{{ date('F d, Y', strtotime($item->born)) }}"
                data-place="{{ $item->place }}"
                data-achivement="{{ $item->achivement }}"
                data-description="{{ $item->description }}">

                    <div class="autograph_img-box zoom-image">
                        <img class="img-responsive" src="{{ config('constants.baseUrl') . config('constants.galleryPic') . $item->image }}" alt="img" />
                    <div class="autograph_name">{{ $item->name }}</div>
                    </div>
                    <div class="autograph_text-box">
                    <h3>Born :  {{ date('F d, Y', strtotime($item->born)) }}</h3>
                    <h3>Birth Place :  {{ $item->place }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="view_all">
                <a href="{{ route('fontend.gallery.show') }}">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                    <p>View All</p>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
