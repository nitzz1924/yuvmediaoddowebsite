@extends('website.layout.websitemain')
@section('title', 'Web Development | ' . config('app.name'))
@section('content')
<section
    style="background-image: url('{{ asset('assets/websiteAssets/images/socialmediaback.png') }}'); background-repeat: no-repeat ; background-position: center; background-size:cover; background-position-y: -303px;"
    class="py-2" id="socialmediasection">
    <div class="container py-5">
        <div class="row">
            <div class="text-center socialmedheading">
                Grow Your Brand Image With <span class="socialmedheadingsub">Social Media</span>
            </div>
            <div class="text-center">
                <p class="text-wrap socialmedsecondhead">
                    From Instagram To Facebook To Twitter To Youtube, We’re The Superhero Behind The Success Of Hundreds
                    Of Industry-leading Social Accounts.
                </p>
            </div>
            <div class="text-center fs-6">
                <p class="text-wrap fw-bold">
                    Let Your Brand Shine
                </p>
            </div>
            <div class="d-flex justify-content-center flex-wrap">
                <div class="me-3">
                    <a href="#" class="btn btn-lg socialmedbtn">Contact Us <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="background-color: #ffffff;" class="py-5">
    <div class="container py-5 justify-content-center">
        <div class="row">
            <div class="text-center socialmedheadingsecthree">
                Focus <span class="socialmedheadingsubsecthree">Areas</span>
            </div>
            <div class="text-center py-2">
                <p class="text-wrap socialmedsecondheadsecthree">
                    When you partner with us, you gain more than just a video; you receive a captivating story that
                    aligns with your brand’s vision.
                </p>
            </div>
        </div>
        <div class="row gy-4 gx-4">
            <div class="col-md-4">
                <div class="socialmediacardsone">
                    <div class="card-body text-start">
                        <img src="{{ asset('assets/websiteAssets/images/packaging.png') }}" alt="service bg"
                            class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                        <p class="fw-bold text-start">A Perfectly Set Brand Image</p>
                        <p class="card-text text-start text-wrap">We prioritize maintaining your brand's image and
                            consumer trust above all else, ensuring they align with your brand values.</p>
                        <!-- <a href="#" class="btn whatcardbtn">Know More</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="socialmediacards">
                    <div class="card-body text-start">
                        <img src="{{ asset('assets/websiteAssets/images/talking.png') }}" alt="service bg"
                            class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                        <p class="fw-bold text-start">Get People Talking</p>
                        <p class="card-text text-start text-wrap">We can help you achieve your desired brand recognition
                            by precisely placing and highlighting your brand's unique products or qualities.</p>
                        <!-- <a href="#" class="btn whatcardbtn">Know More</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="socialmediacardsone">
                    <div class="card-body text-start">
                        <img src="{{ asset('assets/websiteAssets/images/target-audience.png') }}" alt="service bg"
                            class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                        <p class="fw-bold text-start">Target Audience</p>
                        <p class="card-text text-start text-wrap">Understanding your social media target audience is one
                            of the most important aspects of social media marketing.</p>
                        <!-- <a href="#" class="btn whatcardbtn">Know More</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2 gy-4">
            <div class="col-md-4">
                <div class="socialmediacards">
                    <div class="card-body text-start">
                        <img src="{{ asset('assets/websiteAssets/images/conversation.png') }}"
                            alt="service bg" class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                        <p class="fw-bold text-start">The Right Communication</p>
                        <p class="card-text text-start text-wrap">Tell us your brand story, and we'll bring it to life.
                            We'll take that knowledge and convey the same message as effectively as possible.</p>
                        <!-- <a href="#" class="btn whatcardbtn">Know More</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="socialmediacardsone">
                    <div class="card-body text-start">
                        <img src="{{ asset('assets/websiteAssets/images/socialmediamarting.png') }}" alt="service bg" class="mb-3"
                            style="width: 60px; height: 60px; object-fit: contain;">
                        <p class="fw-bold text-start">The Perfect Social Media Marketing Recipe</p>
                        <p class="card-text text-start text-wrap">We have the perfect ingredients to cook the ultimate
                            social media marketing dish with high-impact campaigns for your brand.</p>
                        <!-- <a href="#" class="btn whatcardbtn">Know More</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="socialmediacards">
                    <div class="card-body text-start">
                        <img src="{{ asset('assets/websiteAssets/images/template.png') }}" alt="service bg"
                            class="mb-3" style="width: 60px; height: 60px; object-fit: contain;">
                        <p class="fw-bold text-start">The Perfect Brand Template</p>
                        <p class="card-text text-start text-wrap">Bring your brand's vision to life with our custom
                            templates and designs. We'll capture your brand's unique personality carefully.</p>
                        <!-- <a href="#" class="btn whatcardbtn">Know More</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection