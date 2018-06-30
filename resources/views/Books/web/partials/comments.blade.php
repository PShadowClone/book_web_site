<div class="tabs product-tabs">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="" style="display: none"><a href="#description" role="tab"
                                                                  data-toggle="tab"
                                                                  aria-controls="description"
                                                                  aria-expanded="false">Description</a></li>
        <li role="presentation" class="active reviews"><a href="#reviews" role="tab" data-toggle="tab"
                                                          aria-controls="reviews" aria-expanded="true">
                ({{$book->book_evaluations()->count()}}) @lang('lang.web.reviews')

            </a></li>
        <li role="presentation" class="" style="display: none"><a href="#video" role="tab" data-toggle="tab"
                                                                  aria-controls="video"
                                                                  aria-expanded="false">Responsive Video</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="description">
            <h4>Etiam posuere id nulla</h4>
            <p>Ut arcu ipsum, cursus vitae ligula id, semper sodales mauris. Etiam posuere id nulla lacinia
                convallis. Sed tortor nisi, semper a auctor id, aliquet et sem. Aliquam suscipit lectus ut
                arcu pretium, et malesuada tortor finibus. Pellentesque sed arcu nec lectus vulputate
                pharetra. Vestibulum lobortis dolor massa, et tristique ex tincidunt at. Donec imperdiet
                elit elit, sit amet posuere dui auctor id. Nullam vel augue varius, ornare purus a, mattis
                diam.</p>
            <ul>
                <li>Etiam posuere id nulla lacinia convallis</li>
                <li>Sed tortor nisi, semper a auctor id, aliquet</li>
                <li>Curabitur eros dui</li>
            </ul>
            <h5>Pellentesque vel felis pharetra</h5>
            <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur eros dui, viverra nec
                nisl quis, aliquet auctor nisi. Pellentesque vel felis pharetra, accumsan purus eu, mattis
                est. Aliquam tincidunt efficitur nibh nec volutpat. Vestibulum ante ipsum primis in faucibus
                orci luctus et ultrices posuere cubilia Curae; Nulla ut nisl eu nisi vestibulum consectetur.
                Quisque egestas dolor neque, at bibendum lorem convallis sed. Maecenas finibus metus ante,
                non tristique sapien sagittis id. Nam et iaculis massa. Nulla facilisi. Integer at nunc
                neque. Phasellus posuere et nunc ac blandit. Mauris sollicitudin, sapien vitae luctus
                pellentesque, risus nunc mattis purus, sed laoreet ante leo congue sem. Etiam eget nisi
                ipsum. Phasellus consectetur vel turpis vitae eleifend.</p>
            <h5>Phasellus et libero</h5>
            <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam erat volutpat.
                Phasellus et libero nec ligula imperdiet viverra quis et turpis. Aenean quis mattis nunc.
                Mauris consectetur sed eros sed convallis. Morbi non elit in est tempus scelerisque congue a
                purus. In eget ullamcorper magna. Nam libero turpis, ullamcorper sit amet molestie nec,
                cursus ac urna. Suspendisse blandit finibus est, quis pulvinar arcu pretium vel. Aenean et
                leo nisi. Donec at iaculis ligula. Proin condimentum lobortis ex, in congue nisi molestie
                eget.</p>
        </div>
        <div role="tabpanel" class="tab-pane active in" id="reviews">

            <div class="comments">

                <!-- REVIEW - START -->
                @foreach($book->book_evaluations as $evaluation)
                    <div class="media">
                        @if($evaluation->client && $evaluation->client->name)
                            <div class="media-right">
                                <img class="media-object" alt=""
                                     src="{{$evaluation->client->image ? \Illuminate\Support\Facades\URL::to('to').$evaluation->client->image : 'assets/images/default-avatar.png'}}">
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    {{$evaluation->client->name}}
                                </h3>
                                <p>{{$evaluation->note}}</p>
                            </div>
                        @endif
                    </div>
            @endforeach

            <!-- REVIEW - END -->

            </div>

            <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add-review"
               style="display: none">Add Review</a>

        </div>
        <div role="tabpanel" class="tab-pane" id="video">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe allowfullscreen=""
                        src="http://www.youtube.com/embed/M4z90wlwYs8?feature=player_detailpage"></iframe>
            </div>
        </div>
    </div>
</div>