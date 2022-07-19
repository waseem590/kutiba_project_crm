<!DOCTYPE html>
<html lang="en">
    @include('admin.partials._head')
    <body>
        <div class="loader-wrapper">
            <img src="{{ asset('images/loader.svg') }}" alt="" />
        </div>
        {{-- header --}}
        @include('admin.partials._header')
        {{-- slider --}}
        <section>
            <div class="container-fluid">
                <div id="wrapper">
                    <!-- ===== sidebar-wrapper start ====== -->
                    @include('admin.partials._sidebar')
                    <!-- ====== sidebar-wrapper end ====== -->

                    <!-- ====== page-content-wrapper start ====== -->
                    <div id="page-content-wrapper" style="padding-bottom: 90px">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
        <!-- ====== footer ====== -->
        @include('admin.partials._footer')

    <!-- ====== script ====== -->
    @include('admin.partials._scripts')
    @stack('js')
    @yield('js')
    </body>
</html>
