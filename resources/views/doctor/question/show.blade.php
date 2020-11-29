<ul class="w3-ul" >
    <li>
        <b>{{ __('text') }}</b> <br>
        <p>{{ $question->text }}</p>
    </li>
    <li>
        <b>{{ __('course') }}</b> <br>
        <p>{{ optional($question->course)->name }}</p>
    </li>
    <li>
        <b>{{ __('type') }}</b> <br>
        <p>{{  __(optional($question->questionType)->name) }}</p>
    </li>
    <li>
        <b>{{ __('active') }}</b> <br> 
        @if ($question->active)
        <span class="label label-success" >{{ __('on') }}</span>
        @else 
        <span class="label label-danger" >{{ __('off') }}</span>
        @endif 
    </li>
    <li>
        <b>{{ __('is_sharied') }}</b>  <br>
        @if ($question->is_sharied)
        <span class="label label-success" >{{ __('on') }}</span>
        @else 
        <span class="label label-danger" >{{ __('off') }}</span>
        @endif 
    </li>
    <li>
        <b>{{ __('question choices') }}</b>  <br>
        <table class="table table-bordered" >
            <tr> 
                <th class="text-right" >{{ __('text') }}</th> 
                <th class="text-right" >{{ __('is_answer') }}</th> 
            </tr> 
            @foreach($question->questionChoices()->get() as $item)
            <tr>
                <td>{{ $item->text }}</td>
                <td> 
                    @if ($item->is_answer)
                    <span class="w3-text-green fa fa-check" ></span>
                    @else 
                    <span class="w3-text-red fa fa-close" ></span>
                    @endif 
                </td> 
            </tr>
            @endforeach
        </table>
    </li>
</ul>