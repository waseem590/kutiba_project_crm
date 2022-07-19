<?php $counter=1;?>

@foreach($dropdow_types as $key => $dropdown)
    <tr>
        <td>{{$counter}}</td>
        <td>{{$dropdown->name}}</td>
        <td>
            <a href="{{route('updateDropdownType',$dropdown->id)}}" data-id="{{$dropdown->name}}"
                class="edit-list-icons update"><img src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std"
                    class="img-fluid edit-icon" data-bs-toggle="modal" data-bs-target="#updateDropdown"></a>
            <a href="javascript:void(0)" class="edit-list-icons" onclick="deleteRecord({{$dropdown->id}},'/delete_dropdowntype/')"><img
                    src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std" class="img-fluid"
                    data-bs-toggle="modal" data-bs-target="#alert_modal"></a>
        </td>
    </tr>
    <?php $counter++?>
@endforeach
