    <?php $counter= 0?>
    @foreach ($allUsers as $key=>$item)
    @php
    if(!empty($item->info->name)){
    $name = explode(" ",$item->info->name);
    }
    @endphp
    <tr>
        <th scope="row" class="w-60">
            {{++$counter}}
        </th>
        <td class="text-nowrap"><a href="{{ route('student.show',$item->id)}}">{{$name[1] ?? ''}}
                {{$name[0] ?? ''}}</a></td>
        <!-- <td>{{ $item->contact->email ?? '' }}</td> -->
        <td>{{ $item->contact->contact_number ?? '' }}</td>
        <td>
            @if(!empty($item->contact->country))
            @foreach($countries as $country)
            @if($country->id == $item->contact->country)
            {{$country->name}}
            @endif
            @endforeach
            @endif
        </td>
        <td>{{date('M d, Y', strtotime($item->created_at ?? ''))}}</td>
        <td class="custem-text-center std-list-icon">
            <a href="https://api.whatsapp.com/send?phone={{$item->contact->contact_number ?? '' }}"
                class="edit-list-icons" target="_blank" data-bs-toggle="" data-bs-target=""><img
                    src="{{ asset('admin/images/whatsapp.png') }}" alt="edit-std" class="img-fluid"></a>
            <a href="{{$item->info->name ?? ''}}" class="edit-list-icons sms" data-bs-toggle="modal"
                data-bs-target="#sms-modal" data-id="{{$item->id}}"><img src="{{ asset('admin/images/sms.png') }}"
                    alt="edit-std" class="img-fluid">
                <input type="hidden" class="first_contact_num" value="{{$item->contact->contact_number ?? ''}}">
                <input type="hidden" class="second_contact_num"
                    value="{{$item->contact->secondary_contact_number ?? ''}}">
            </a>
            <a href="mailto:{{$item->contact->email ?? ''}}?subject={{$item->info->name ?? ''}}-{{$item->id}}"
                class="edit-list-icons " data-bs-toggle="" data-bs-target=""><img
                    src="{{ asset('admin/images/mails.png') }}" alt="edit-std" class="img-fluid"></a>
            <a href="{{ route('student.edit',$item->id)}}" class="edit-list-icons"><img
                    src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std"
                    class="img-fluid std-list-edit-img" /></a>
            <a href="{{ route('student.show',$item->id)}}" class="edit-list-icons"><img
                    src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std" class="img-fluid" /></a>
            @can('delete student')
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons"
                onclick="deleteRecord({{$item->id}},'/student/')"><img
                    src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std" class="img-fluid" /></a>
            @endcan
        </td>
    </tr>
    @endforeach