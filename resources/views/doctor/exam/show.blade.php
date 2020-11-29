<ul class="w3-ul" > 
    <li>
        <b>{{ __('name') }}</b> <br>
        <p>{{ $exam->name }}</p>
    </li>
    <li>
        <b>{{ __('start_time') }}</b> <br>
        <p>{{ $exam->start_time }}</p>
    </li>
    <li>
        <b>{{ __('end_time') }}</b> <br>
        <p>{{ $exam->end_time }}</p>
    </li>
    <li>
        <b>{{ __('course') }}</b> <br>
        <p>{{ optional($exam->course)->name }}</p>
    </li>
    <li>
        <b>{{ __('minutes') }}</b> <br>
        <p>{{ $exam->minutes }}</p>
    </li>
    <li>
        <b>{{ __('question_number') }}</b> <br>
        <p>{{ $exam->question_number }}</p>
    </li>
    <li>
        <b>{{ __('total') }}</b> <br>
        <p>{{ $exam->total }}</p>
    </li>
    <li>
        <b>{{ __('header_text') }}</b> <br>
        <p>{{ $exam->header_text }}</p>
    </li>
    <li>
        <b>{{ __('footer_text') }}</b> <br>
        <p>{{ $exam->footer_text }}</p>
    </li>
    <li>
        <b>{{ __('notes') }}</b> <br>
        <p>{{ $exam->notes }}</p>
    </li>
    <li>
        <b>{{ __('required_password') }}</b>  <br>
        @if ($exam->required_password)
        <span class="label label-success" >{{ __('on') }}</span>
        @else 
        <span class="label label-danger" >{{ __('off') }}</span>
        @endif 
    </li>
    <li>
        <b>{{ __('password') }}</b> <br>
        <p>{{ $exam->password }}</p>
    </li>
     
    
    <li>
        <b>{{ __('exam questions') }}</b>  <br>
        <table class="table table-bordered" >
            <tr> 
                <th class="text-right" >{{ __('question') }}</th> 
                <th class="text-right" >{{ __('type') }}</th> 
            </tr> 
            @foreach($exam->questions()->get() as $item)
            <tr>
                <td>{{ optional($item->question)->text }}</td>
                <td> 
                    {{ __(optional($item->question)->questionType->name) }}
                </td> 
            </tr>
            @endforeach
        </table>
    </li>
</ul>