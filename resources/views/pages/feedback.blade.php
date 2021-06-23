@extends('layouts.app_main')

@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                       <h3>Feedback</h3>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li>Feedback</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <section class="feedback">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="feedback_details">
                        <h4>Please provide your feedback below:</h4>
                        <p>How do you rate your overall experience?</p>
                        <ul>
                            <li><input type="radio" name="radio_experience"><span>Bad</span></li>
                            <li><input type="radio" name="radio_experience"><span>Average </span></li>
                            <li><input type="radio" name="radio_experience"><span>Good</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="comments_form">
                        <h3>Leave Comments </h3>
                        <form action="#">
                            <div class="row">
                                <div class="col-12">
                                    <label for="review_comment">Comment </label>
                                    <textarea name="comment" id="review_comment"></textarea>
                                </div>
                            </div>
                            <button class="button" type="submit">Post Comment</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        </div>
    </section>

@endsection
