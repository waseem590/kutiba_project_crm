<div class="container">
<div class="row-md-8">
    <div class="col-md-8 group-control" style="padding: 10%;">
    <label for="">Contact Numbers</label>
    <select class="form-select form-control" aria-label="Default select example">
                <option selected>Choose Contact No.</option>
                <option value="1">{{$student->contact_number}}</option>
                <option value="2">{{$student->secondary_contact_number}}</option>
                </select>
    </div>
    <div class="col-md-4">
        <button type="submit" style="background-color: green; color:white">Send Sms</button>
    </div>
</div>
<div class="col-md-4"></div>
</div>