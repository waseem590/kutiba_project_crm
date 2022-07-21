
@foreach($clock_user->user_clock as $key=>$clock)
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="card custom-cards custom-card-3 text-white clock_card text-center">
                    <div class="card-body text-center">
                        <div class="container_clock">
                            <div class="box-clock">
                                <?php $time = $clock->timezone->timezone;
                                    //  $session = "PM";
                                     $current_time = \Carbon\Carbon::now();
                                     $covert_to_time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$current_time);

                                     $set_time=$covert_to_time->setTimezone($time);
                                     $h=$set_time->format('h');
                                     $m=$set_time->format('i');
                                     $s=$set_time->format('s');
                                     $mode=$set_time->format('A');
                                     $date=$set_time->format('d m Y');

                                    if ($h == 0) {
                                        $h = 12;
                                    }
                                    if ($h > 12) {
                                        $h = $h - 12;
                                        // $session = "AM";
                                    }
                                    $h = ($h < 10) ? $h : $h;
                                    $m = ($m < 10) ? $m : $m;
                                    $s = ($s < 10) ? $s : $s;
                            
                                    $time = $h . ":" . $m . ":" . $s . $mode;
                                ?>
                                <div id="MyClockDisplay" class="clock">{{$time}}</div>
                            </div>
                        </div>
                        <div class="clock-country">{{$clock->name}}</div>
                    </div>
                </div>
            </div>

            @endforeach