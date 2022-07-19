@if($latest_students)
@foreach($latest_students as $student)
@if($student->mark == 'Incomplete')
@if($student->contact)
@php
if(!empty($student->info->name)){
$name = explode(" ",$student->info->name);
}
@endphp
<tr>
    <td class="text-nowrap"><a href="{{ route('student.show',$student->id)}}">{{$name[1] ?? ''}}
            {{$name[0] ?? ''}}</a></td>
    <td> {{$student->contact['email'] ?? ''}}</td>
    <!-- <td>{{$student->visa->first()->select_status ?? ''}}</td> -->
    <td>
        @if($student->mark == "Complete")
        <input type="checkbox" checked data-toggle="toggle" id="complete_stu" data-on="Complete" data-off="Incomplete"
            class="complete_status custom-switch-lg complete1" data-id="{{$student->id}}" data-onstyle="success"
            data-offstyle="danger">
        @else
        <input type="checkbox" checked data-toggle="toggle" id="complete_stu" data-on="Complete" data-off="Incomplete"
            class="complete_status custom-switch-lg complete" data-id="{{$student->id}}" data-onstyle="success"
            data-offstyle="danger">
        @endif
        <input type="hidden" value="{{$student->id}}" class="edit_id">
        <input type="hidden" value="{{$student->id}}" class="visa_row_id">
    </td>
    <td> <?php $country = \App\Models\Country::find($student->info['nationality']
                                                ?? ''); ?>
        {{ $country["name"] ?? "" }}
    </td>
    <td> @if($student->visa_stu == 1) Visa @else Normal @endif</td>
</tr>
@endif
@endif
@endforeach
@endif
