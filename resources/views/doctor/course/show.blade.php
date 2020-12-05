<div>
    <div class="w3-large text-center" >{{ __('register student in ') }} - {{ $course->name }}</div>

    <br>
    <table class="table table-bordered" id="registerStudentTable" >
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('code') }}</th>
                <th>{{ __('student') }}</th>
                <th>{{ __('level') }}</th>
                <th>{{ __('department') }}</th> 
            </tr>
        </thead>

        <tbody>
            @foreach($course->studentCourses()->get() as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ optional($item->student)->code }}</td>
                <td>{{ optional($item->student)->name }}</td>
                <td>{{ optional(optional($item->student)->level)->name }}</td>
                <td>{{ optional(optional($item->student)->department)->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script> 
    $('#registerStudentTable').DataTable({ 
        "pageLength": 10,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
    });
</script>