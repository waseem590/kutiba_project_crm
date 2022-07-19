@foreach($visa_detail as $item)
<tr>
    <th scope="row" class="w-60">
        {{$loop->iteration}}
    </th>
    <td>
        <?php $case_officer = \App\Models\DropdownType::find($item->case_officer)?>
        {{$case_officer['name'] ?? ''}}
    </td>

    <td>
        <?php $case_officer = \App\Models\DropdownType::find($item->visa_type)?>
        {{$case_officer['name']}}
    </td>
    <td>
        {{$item->student->info['name'] ?? ''}}
    </td>
    <td class="complete_status_val">{{$item->status ?? ''}}</td>
    <td class="custem-text-center std-list-icon">
        @can('add visa')
        <a href="{{ route('edit_visa',$item->id)}}" class="edit-list-icons"><img
                src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std" class="img-fluid" /></a>
        @endcan
        <a href="{{ route('view.visa',$item->id)}}" class="edit-list-icons"><img
                src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std" class="img-fluid" /></a>
        @can('add visa')
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons"
            onclick="deleteRecord({{$item->id}},'/delete_visa/')"><img
                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std" class="img-fluid" /></a>
        @endcan
        <div style="display: inline-block;margin-left: 15px;" class="edit-list-icons">
            <input class="complete_status" type="checkbox" data-id="{{$item->id}}">
            <input type="hidden" value="{{$item->id}}" class="edit_id">
            <input type="hidden" value="{{$item->id}}" class="visa_row_id">
        </div>
    </td>
</tr>

@endforeach
