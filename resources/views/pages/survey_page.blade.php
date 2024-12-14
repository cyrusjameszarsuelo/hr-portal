            <div class="d-flex align-items-center justify-content-between py-2 px-4" id="survey_page">
                <h2 class="position-relative font-26 semi-font fables-blog-category-head fables-main-text-color fables-second-before pl-3 mb-4">Survey</h2> 
                <a class="text-secondary font-weight-medium text-decoration-none" href="/view-all-surveys">View All</a>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                        <div class="card-header">Survey Results: {{ isset($survey) ?  $survey->question : ''}}</div>
                        <div class="card-body" >
                            <input type="hidden" value="{{$jsImplode}}" id="getResultsData">
                            <div id="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="card" style="box-shadow: 6px 4px 12px; border-radius: 3px;">
                        <div class="card-body">

                            <div class="d-flex justify-content-between ">
                                <h6 class="font-14">Question by: {{ isset($survey) ? $survey->created_by : ''}}</h6>
                                <a class="text-secondary font-14" href="/view-all-surveys">Survey Expiry: {{ isset($survey) ? Carbon\Carbon::parse($survey->end_date)->diffForHumans() : ''}}</a>
                            </div>
                            <br>
                            <h4> {{ isset($survey) ?  $survey->question : ''}}</h4>
                            <br>
                            <br>
                            <div class="container" style=" overflow:auto; height:315px;">
                            <form action="/submitSurvey" method="POST">
                                @csrf
                                <ul class="list-group">
                                    @if(isset($survey))
                                    @foreach($survey->choices as $choices)
                                    <li class="list-group-item">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="choices_id" value="{{$choices->id}}">
                                                {{$choices->choice}}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                                <input type="hidden" name="survey_id" value="{{isset($survey) ? $survey->id : ''}}">
                            <br>
                            @if(isset($surveyName))
                                <center><span class="font-18">Thank you for answering the Survey!</span></center>
                            @elseif (isset($survey))
                            <button type="submit" class="btn btn-primary btn-block fables-btn-rounded">
                                Vote
                            </button>
                            @endif
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>