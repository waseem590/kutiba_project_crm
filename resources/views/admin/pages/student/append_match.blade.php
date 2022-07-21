@foreach($student as $stu)
<tr>
    <td id="surname"><a href="/student/{{$stu->id}}">{{$stu->surname}}</a></td>
    <td>{{$stu->dob}}</td>
</tr>
@endforeach