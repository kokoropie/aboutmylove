<!DOCTYPE html>
<html lang="vi" class="{{$theme}}-theme">
    <head>
        <x-layout::head :title="$title" />
        <x-layout::style :name-page="$namePage" />
        @routes()
    </head>
    @switch($namePage)
        @case('user.login')
        @case('user.register')
            <body class="form">
            @break

        @default
            <body class="sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="100">
    @endswitch
        <!-- BEGIN LOADER -->
        <div id="load_screen"> 
            <div class="loader"> 
                <div class="loader-content">
                    <div class="spinner-grow align-self-center"></div>
                </div>
            </div>
        </div>
        <!--  END LOADER -->

        @yield('body')
        @yield('modal')
    </body>
    <x-layout::script :name-page="$namePage" />
</html>