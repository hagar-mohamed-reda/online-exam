<div style="width: 250px" >
    <div class="dropdown">
        <button id="dLabel" type="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false" 
                class="w3-large w3-white shadow w3-circle btn" 
                style="width: 18px;height: 25px" >
            <i class="fa fa-ellipsis-v" ></i>
        </button>
        <ul class="dropdown-menu w3-ul shadow" aria-labelledby="dLabel" style="right: 0px;" >
            @if (Auth::user()->type == 'doctor')
            <li class="w3-hover-light-gray" style="cursor: pointer" onclick="showPage('exam/assign/{{ $exam->id }}')" >
                <span class="fa fa-address-book-o w3-text-teal" style="margin-left: 10px" ></span> {{ __('assign to students') }}
            </li>
            @if (App\Setting::getSetting(3)->value == '1')
            <li class="w3-hover-light-gray" style="cursor: pointer"  onclick="showPage('exam/recorrect/{{ $exam->id }}')" >
                <span class="fa fa-recycle w3-text-purple" style="margin-left: 10px" ></span> {{ __('recorrect grades') }}
            </li>
            @endif
            @if ($exam->hasBlankAnswer())
            <li class="w3-hover-light-gray" style="cursor: pointer"   onclick="showPage('exam/correct_blank/{{ $exam->id }}')" >
                <span class="fa fa-text-width w3-text-pink" style="margin-left: 10px" ></span> {{ __('correct blank answer') }}
            </li>
            @endif
            @endif
            
            <li class="w3-hover-light-gray" style="cursor: pointer"   onclick="edit('{{ url('/exam/show') . '/' . $exam->id }}', 'showModal', 'showModalPlace')" >
                <span class="fa fa-desktop w3-text-green" style="margin-left: 10px" ></span> {{ __('show') }}
            </li>
            @if (Auth::user()->type == 'doctor')
            <li class="w3-hover-light-gray" style="cursor: pointer"   onclick="showPage('exam/show2/{{ $exam->id }}')" >
                <span class="fa fa-area-chart w3-text-blue" style="margin-left: 10px" ></span> {{ __('show analysis') }}
            </li>
            <li class="w3-hover-light-gray" style="cursor: pointer"   onclick="showPage('exam/edit/{{ $exam->id }}')"  >
                <span class="fa fa-edit w3-text-orange" style="margin-left: 10px" ></span> {{ __('edit') }}
            </li> 
            @if ($exam->can_delete)
            <li class="w3-hover-light-gray" style="cursor: pointer" onclick="remove('', '{{ url('/exam/remove/') .'/' . $exam->id }}')"  >
                <span class="fa fa-trash w3-text-red" style="margin-left: 10px" ></span> {{ __('edit') }}
            </li> 
            @endif
            @endif
        </ul>
    </div> 

</div>