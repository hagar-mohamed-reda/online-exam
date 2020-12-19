<div style="width: 120px" > 
    <i class="fa fa-laptop w3-text-green w3-button" onclick="confirmMessage(' {{ __("when the exam start you cant back") }}', function(){showPage('exam-room?exam_id={{ $exam->exam_id }}')});" > {{ __('start exam') }} </i>
  
</div>