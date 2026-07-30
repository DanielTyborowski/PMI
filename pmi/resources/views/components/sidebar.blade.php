<nav class="w3-sidebar w3-collapse w3-white " style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container">
        <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey"
            title="close menu">
            <i class="fa fa-remove"></i>
        </a>
        <img src="{{ asset('img/BlockundStift.png') }}" style="width:45%;" class="w3-round"><br><br>
        <h4><b>Personal Information Manager</b></h4>

    </div>
    <div class="w3-bar-block">
        <a href="{{ route('home.index') }}" onclick="w3_close()"
       class="w3-bar-item w3-button w3-padding {{ request()->routeIs('home.index') ? 'nav-active' : '' }}">
        Home
    </a>
    <a href="{{ route('notes.index') }}" onclick="w3_close()"
       class="w3-bar-item w3-button w3-padding {{ request()->routeIs('notes.index') ? 'nav-active' : '' }}">
        Things To Do
    </a>
    <a href="{{ route('meals.index') }}" onclick="w3_close()"
       class="w3-bar-item w3-button w3-padding {{ request()->routeIs('meals.index') ? 'nav-active' : '' }}">
        What can I eat
    </a>
    </div>

</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
    title="close side menu" id="myOverlay"></div>
