@extends('admin.master')
@push('css')
<style>
    .btn-primary-outline {
        width: 125px;
        height: 40px;
        font-size: 14px;
        font-weight: 400;
        background-color: white !important;
        border: none;
        border-radius: 50px;
        margin-bottom: 20px;

    }
    .btn-primary-outline:hover {
        background-color: #f5981f !important;
        border-color: #ffffff !important;
        padding-left:20px !important;
        padding-right:20px !important;
        color:white;

    }
    .contact_bg {
        background-color: #f5981f !important;
        border-color: #ffffff !important;
        padding-left:20px !important;
        padding-right:20px !important;
        color:white;
    }
</style>
@endpush
@section('content')
<div class="students-List-section">
    <h1 class="page-heading">Students List</h1>
    <div class="mm-stdlist-main">
        <table id="mm-std-List" class="table table-bordered">
            <thead class="s-list-thead">
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Country</th>
                        <th scope="col">Counsellor</th>
                        <th scope="col">Office</th>

                        <th scope="col" class="custem-text-center">Action</th>

                    </tr>
                </tr>
            </thead>
            <tbody>
                <?php $counter= 0?>
                <!-- condition for user which has role Finance -->
                @can('show students to finance manager')
                @if(auth()->user()->hasRole('Master User') == false)
                @foreach ($allUsers as $key=>$item)
                @foreach ($showStudentsToFinanceManager as $val)
                @if($val->add_student_id == $item->id)
                <tr>
                    <th scope="row" class="w-60">
                        {{++$counter}}
                    </th>
                    <td class="text-nowrap"><a href="{{ route('student.show',$item->id)}}">{{ $item->info->name ?? '' }}</a></td>
                    <td>{{ $item->contact->email ?? '' }}</td>
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
                    <td>
                        @foreach($counsellor as $val)
                            @if($val->id == $item->counsellor)
                                {{$val->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if(!empty($dropdown[0]->dropdownType))
                            @foreach($dropdown[0]->dropdownType as $val)
                                @if($val->id == $item->office)
                                    {{$val->name}}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td class="custem-text-center std-list-icon">
                        <a href="https://api.whatsapp.com/send?phone={{$item->contact->contact_number ?? '' }}" class="edit-list-icons" target="_blank" data-bs-toggle="" data-bs-target=""><img
                            src="{{ asset('admin/images/whatsapp.png') }}" alt="edit-std" class="img-fluid"></a>
                        <a href="{{$item->info->name ?? ''}}" class="edit-list-icons sms" data-bs-toggle="modal" data-bs-target="#sms-modal" data-id="{{$item->id}}"><img
                            src="{{ asset('admin/images/sms.png') }}" alt="edit-std" class="img-fluid">
                            <input type="hidden" class="first_contact_num" value="{{$item->contact->contact_number ?? ''}}">
                            <input type="hidden" class="second_contact_num" value="{{$item->contact->secondary_contact_number ?? ''}}">
                        </a>
                        <a href="mailto:{{$item->contact->email ?? ''}}?subject={{$item->id}}. {{$item->info->name ?? ''}}" class="edit-list-icons " data-bs-toggle="" data-bs-target=""><img
                            src="{{ asset('admin/images/mails.png') }}" alt="edit-std" class="img-fluid"></a>
                        <a href="{{ route('student.edit',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid std-list-edit-img"
                        /></a>
                        <a href="{{ route('student.show',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/list-icon-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @can('delete student')
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/student/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <!-- <a href="https://wa.me/923080411788" target="_blank">Link Text Here</a> -->
                        @endcan
                    </td>
                </tr>
                @endif
                @endforeach
                @endforeach
                @endif
                @endcan

                <!-- condition for user which has role Counselor -->
                @can('show students to counselor')
                @if(auth()->user()->hasRole('Master User') == false)
                @foreach ($allUsers as $key=>$item)
                @foreach ($showStudentsToCounsellor as $val)
                @if($val->add_student_id == $item->id)
                <tr>
                    <th scope="row" class="w-60">
                        {{++$counter}}
                    </th>
                    <td class="text-nowrap"><a href="{{ route('student.show',$item->id)}}">{{ $item->info->name ?? '' }}</a></td>
                    <td>{{ $item->contact->email ?? '' }}</td>
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
                    <td>
                        @foreach($counsellor as $val)
                            @if($val->id == $item->counsellor)
                                {{$val->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if(!empty($dropdown[0]->dropdownType))
                            @foreach($dropdown[0]->dropdownType as $val)
                                @if($val->id == $item->office)
                                    {{$val->name}}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td class="custem-text-center std-list-icon">
                        <a href="https://api.whatsapp.com/send?phone={{$item->contact->contact_number ?? '' }}" class="edit-list-icons" target="_blank" data-bs-toggle="" data-bs-target=""><img
                            src="{{ asset('admin/images/whatsapp.png') }}" alt="edit-std" class="img-fluid"></a>
                        <a href="{{$item->info->name ?? ''}}" class="edit-list-icons sms" data-bs-toggle="modal" data-bs-target="#sms-modal" data-id="{{$item->id}}"><img
                            src="{{ asset('admin/images/sms.png') }}" alt="edit-std" class="img-fluid">
                            <input type="hidden" class="first_contact_num" value="{{$item->contact->contact_number ?? ''}}">
                            <input type="hidden" class="second_contact_num" value="{{$item->contact->secondary_contact_number ?? ''}}">
                        </a>
                        <a href="mailto:{{$item->contact->email ?? ''}}?subject={{$item->id}}. {{$item->info->name ?? ''}}" class="edit-list-icons " data-bs-toggle="" data-bs-target=""><img
                            src="{{ asset('admin/images/mails.png') }}" alt="edit-std" class="img-fluid"></a>
                        <a href="{{ route('student.edit',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid std-list-edit-img"
                        /></a>
                        <a href="{{ route('student.show',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/list-icon-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @can('delete student')
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/student/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <!-- <a href="https://wa.me/923080411788" target="_blank">Link Text Here</a> -->
                        @endcan
                    </td>
                </tr>
                @endif
                @endforeach
                @endforeach
                @endif
                @endcan

                <!-- condition for user which has role Master User -->
                @if(auth()->user()->hasRole('Master User') == true)
                @foreach ($allUsers as $key=>$item)
                <tr>
                    <th scope="row" class="w-60">
                        {{++$counter}}
                    </th>
                    <td class="text-nowrap"><a href="{{ route('student.show',$item->id)}}">{{ $item->info->name ?? '' }}</a></td>
                    <td>{{ $item->contact->email ?? '' }}</td>
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
                    <td>
                        @foreach($counsellor as $val)
                            @if($val->id == $item->counsellor)
                                {{$val->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if(!empty($dropdown[0]->dropdownType))
                            @foreach($dropdown[0]->dropdownType as $val)
                                @if($val->id == $item->office)
                                    {{$val->name}}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td class="custem-text-center std-list-icon">
                        <a href="https://api.whatsapp.com/send?phone={{$item->contact->contact_number ?? '' }}" class="edit-list-icons" target="_blank" data-bs-toggle="" data-bs-target=""><img
                            src="{{ asset('admin/images/whatsapp.png') }}" alt="edit-std" class="img-fluid"></a>
                        <a href="{{$item->info->name ?? ''}}" class="edit-list-icons sms" data-bs-toggle="modal" data-bs-target="#sms-modal" data-id="{{$item->id}}"><img
                            src="{{ asset('admin/images/sms.png') }}" alt="edit-std" class="img-fluid">
                            <input type="hidden" class="first_contact_num" value="{{$item->contact->contact_number ?? ''}}">
                            <input type="hidden" class="second_contact_num" value="{{$item->contact->secondary_contact_number ?? ''}}">
                        </a>
                        <a href="mailto:{{$item->contact->email ?? ''}}?subject={{$item->id}}. {{$item->info->name ?? ''}}" class="edit-list-icons " data-bs-toggle="" data-bs-target=""><img
                            src="{{ asset('admin/images/mails.png') }}" alt="edit-std" class="img-fluid"></a>
                        <a href="{{ route('student.edit',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid std-list-edit-img"
                        /></a>
                        <a href="{{ route('student.show',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/list-icon-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @can('delete student')
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/student/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <!-- <a href="https://wa.me/923080411788" target="_blank">Link Text Here</a> -->
                        @endcan
                    </td>
                </tr>

                @endforeach
                @endif

            </tbody>
        </table>

    </div>
</div>
@include('admin.modals.emailModal')
@include('admin.modals.smsModal')
@include('admin.modals.whatsupModal')
@include('admin.modals.deleteModal')
@endsection
@section('scripts')
<!-- dataTable links -->
<!-- <script src="{{asset('admin/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/js/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/js/datatable/jquery-3.5.1.js')}}"></script> -->
<script>
    $('.sms').on('click',function(e){
        var current = $(this);
        e.preventDefault();
        var std_id = $(this).data('id');
        var std_name = $(this).attr('href');
        $('.id_name').text(std_id+'.'+std_name);
        var first_contact_num = current.children(".first_contact_num");
        var second_contact_num = current.children(".second_contact_num");
        var contact_first = $('.first_name_btn').text(first_contact_num.val());
        var contact_second = $('.second_name_btn').text(second_contact_num.val());

    });
    $('.first_name_btn').on('click',function(e){
        e.preventDefault();
        $(this).toggleClass('contact_bg');
        if($(this).hasClass('contact_bg')){
            $('#first_num').val($(this).text());
            console.log($('#first_num').val($(this).text()));
        }
        else{
            $('#first_num').val('');
            $(this).removeClass('contact_bg');
            console.log($('#first_num').val());
        }
    });
    $('.second_name_btn').on('click',function(e){
        e.preventDefault();
        $(this).toggleClass('contact_bg');
        if($(this).hasClass('contact_bg')){
            $('#second_num').val($(this).text());
            console.log($('#second_num').val($(this).text()));
        }
        else{
            $('#second_num').val('');
            $(this).removeClass('contact_bg');
            console.log($('#second_num').val());
        }
    });
    $(document).ready(function () {
                $('#mm-std-List').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            lengthChange: false,
                            extend: 'csv',
                            text: '<i class="fa fa-download" aria-hidden="true"></i>',
                            filename:'Students Record',
                            exportOptions: {
                                columns: [0,1,2,3]
                            },
                        }
                    ],
                    responsive: {
						details: {
							display:
								$.fn.dataTable.Responsive.display.childRowImmediate,
							type: "none",
							target: "",
						},
					},
                });
            });
</script>
@endsection
