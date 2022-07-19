   @foreach($resource_types as $resource_type)
    <tr>
        <td width="15%">{{$resource_type->id}}</td>
        <td class="resource_type_td" id="{{$resource_type->id}}" title="Edit name on double click" style="cursor: pointer;" width="50%">{{$resource_type->name}}</td>
        <td width="35%">
        <!-- <a href="javascript:void(0)" class="edit-list-icons" onclick="deleteRecord({{$resource_type->id}},'/delete_dropdowntype/')"> -->
        <a href="{{$dropdowns_id}}" class="edit-list-icons delete_resource_type" data-id="{{$resource_type->id}}">
        <img src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std" class="img-fluid"
                    data-bs-toggle="modal" data-bs-target="#alert_modal"></a>
        </td>

    </tr>
    @endforeach