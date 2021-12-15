<!-- Start Category -->
<div class="list-box category mb-3">
    <div class="title">Category</div>
    <ul>
        @foreach($categories as $singlecat)
            <li class="">
                <div class="category">
                    <a href="/Shop/Category/{{$singlecat->category}}">{{$singlecat->category}}</a>
                    <i class="fas fa-plus ml-auto"></i>
                </div>
                <?php
                $sub[$singlecat->category] = App\Http\Models\sub_categories::where('category_id', $singlecat->id)->get();
                $testfinal =$sub[$singlecat->category];
                ?>
                @foreach($testfinal as $final)
                    <div class="sub-category">
                        <a href="/Shop/Sub_Category/{{$final->sub_category_name}}">{{$final->sub_category_name}}</a>
                    </div>
                @endforeach
            </li>
        @endforeach

    </ul>
</div>
<!-- End Category -->
